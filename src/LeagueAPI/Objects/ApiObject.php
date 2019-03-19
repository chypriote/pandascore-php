<?php

/**
 * Copyright (C) 2016-2018  Daniel Dolejška.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace PandaScoreAPI\LeagueAPI\Objects;

use PandaScoreAPI\LeagueAPI\Exceptions\GeneralException;
use PandaScoreAPI\LeagueAPI\PandaScoreAPI;

/**
 *   Class ApiObject.
 */
abstract class ApiObject implements IApiObject
{
    /**
     *   ApiObject constructor.
     *
     * @param array         $data
     * @param PandaScoreAPI $api,
     */
    public function __construct(array $data, PandaScoreAPI $api = null)
    {
        // Tries to assigns data to class properties
        $selfRef = new \ReflectionClass($this);
        $namespace = $selfRef->getNamespaceName();
        $iterableProp = $selfRef->hasProperty('_iterable')
            ? self::getIterablePropertyName($selfRef->getDocComment())
            : false;
        $linkableProp = $selfRef->hasProperty('staticData')
            ? self::getLinkablePropertyData($selfRef->getDocComment())
            : ['function' => false, 'parameter' => false];

        foreach ($data as $property => $value) {
            try {
                if ($propRef = $selfRef->getProperty($property)) {
                    //  Object has required property, time to discover if it's
                    $dataType = self::getPropertyDataType($propRef->getDocComment());
                    if (false !== $dataType && is_array($value)) {
                        //  Property is special DataType
                        $newRef = new \ReflectionClass("$namespace\\$dataType->class");
                        if ($dataType->isArray) {
                            //  Property is array of special DataType (another API object)
                            foreach ($value as $identifier => $d) {
                                $this->$property[$identifier] = $newRef->newInstance($d, $api);
                            }
                        } else {
                            //  Property is special DataType (another API object)
                            $this->$property = $newRef->newInstance($value, $api);
                        }
                    } else {
                        //  Property is general value
                        $this->$property = $value;
                    }
                }

                if ($iterableProp == $property) {
                    $this->_iterable = $this->$property;
                }

                //  Is API reference passed?
                if ($api) {
                    //  Should this property be linked and is it allowed?
                    if ($linkableProp['parameter'] == $property && $api->getSetting(PandaScoreAPI::SET_STATICDATA_LINKING, false)) {
                        $apiRef = new \ReflectionClass(PandaScoreAPI::class);
                        $linkingFunctionRef = $apiRef->getMethod($linkableProp['function']);

                        $params = [$value];
                        foreach ($linkingFunctionRef->getParameters() as $parameter) {
                            switch ($parameter->getName()) {
                                // Extended data fetch?
                                case 'extended':
                                    $params[] = true;
                                    break;

                                // Data by key?
                                case 'data_by_key':
                                    $params[] = true;
                                    break;

                                // Request locale
                                case 'locale':
                                    $params[] = $api->getSetting(PandaScoreAPI::SET_STATICDATA_LOCALE, $parameter->getDefaultValue());
                                    break;

                                // Static data version
                                case 'version':
                                    $params[] = $api->getSetting(PandaScoreAPI::SET_STATICDATA_VERSION, $parameter->getDefaultValue());
                                    break;

                                default:
                                    break;
                            }
                        }

                        $this->staticData = $linkingFunctionRef->invokeArgs($api, $params);
                    }
                }
            }
            //  If property does not exist
            catch (\ReflectionException $ex) {
            }
        }

        $this->_data = $data;

        //  Is API reference passed?
        if ($api) {
            //  Gets declared extensions
            $objectExtensions = $api->getSetting(PandaScoreAPI::SET_EXTENSIONS);
            //  Is there extension for this class?
            if (isset($objectExtensions[$selfRef->getName()]) && $extension = $objectExtensions[$selfRef->getName()]) {
                $extension = new \ReflectionClass($extension);
                $this->_extension = @$extension->newInstanceArgs([&$this, &$api]);
            }
        }
    }

    /**
     *   Returns name of iterable property specified in PHPDoc comment.
     *
     * @param string $phpDocComment
     *
     * @return bool|string
     */
    public static function getIterablePropertyName(string $phpDocComment)
    {
        preg_match('/@iterable\s\$([\w]+)/', $phpDocComment, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        }

        return false;
    }

    /**
     *   Returns data of linkable property specified in PHPDoc comment.
     *
     * @param string $phpDocComment
     *
     * @return bool|array
     */
    public static function getLinkablePropertyData(string $phpDocComment)
    {
        preg_match('/@linkable\s(?<function>[\w]+)(?:\(\$(?<parameter>[\w]+)+?\))?/', $phpDocComment, $matches);

        // Filter only named capture groups
        $matches = array_filter($matches, function ($v, $k) {
            return is_string($k);
        }, ARRAY_FILTER_USE_BOTH);
        if (@$matches['function'] && @$matches['parameter']) {
            return $matches;
        }

        return false;
    }

    /**
     *   Returns DataType specified in PHPDoc comment.
     *
     * @param string $phpDocComment
     *
     * @return bool|\stdClass
     */
    public static function getPropertyDataType(string $phpDocComment)
    {
        $o = new \stdClass();

        preg_match('/@var\s+(\w+)(\[\])?/', $phpDocComment, $matches);

        $o->class = $matches[1];
        $o->isArray = isset($matches[2]);

        if (in_array($o->class, ['integer', 'int', 'string', 'bool', 'boolean', 'double', 'float', 'array'])) {
            return false;
        }

        return $o;
    }

    /**
     *   This variable contains all the data in an array.
     *
     * @var array
     */
    protected $_data = [];

    /**
     *   Gets all the original data fetched from LeagueAPI.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->_data;
    }

    /**
     *   Object extender.
     *
     * @var IApiObjectExtension
     */
    protected $_extension;

    /**
     *   Magic call method used for calling ObjectExtender methods.
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     *
     * @throws GeneralException
     */
    public function __call($name, $arguments)
    {
        if (!$this->_extension) {
            throw new GeneralException("Method '$name' not found, no extension exists for this ApiObject.");
        }
        try {
            $r = new \ReflectionClass($this->_extension);

            return $r->getMethod($name)->invokeArgs($this->_extension, $arguments);
        } catch (\Exception $ex) {
            throw new GeneralException("Method '$name' failed to be executed: ".$ex->getMessage(), 0, $ex);
        }
    }
}
