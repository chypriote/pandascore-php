# PandaScore PHP7 wrapper [![GitHub release](https://img.shields.io/github/release/chypriote/pandascore-php.svg)](https://github.com/chypriote/pandascore-php) [![Packagist](https://img.shields.io/packagist/v/chypriote/pandascore-php.svg)](https://packagist.org/packages/chypriote/pandascore-php)

> Version v1.0.0-rc.1

# Table of Contents
1. [Introduction](#introduction)
2. [Downloading](#downloading)
3. [League of Legends API](#league-of-legends-api)
	1. [Resource versions](#resource-versions)
	2. [Initializing the library](#initializing-the-library)
	3. [Usage example](#usage-example)
	4. [Cache providers](#cache-providers)
	5. [Rate limiting](#rate-limiting)
	6. [Call caching](#call-caching)
	7. [Asynchronous requests](#asynchronous-requests)
	8. [Extensions](#extensions)
	9. [Callback functions](#callback-functions)
	10. [CLI support](#cli-support)


# Introduction
Welcome to the PandaScore PHP7 library repo!
The goal of this library is to create easy-to-use library for anyone who might need one.
This is fully object oriented API wrapper for PandaScore' API.

Here are some handy features:

- **Rate limit caching** and limit exceeding prevention - fully automatic.
- **Call caching** - this enables the library to re-use already fetched data within short timespan - saving time and API rate limit.
- **Custom callbacks** - you can set custom function which will be called before or after the request is processed.
- **Object extensions** - you can implement own methods to the fetched API objects itself and enable yourself to use them later to ease of your work.
- **CLI supported**! You can use the library easily even in PHP CLI mode.
- **Objects everywhere**! API calls return data in special objects.


# Downloading
The easiest way to get this library is to use [Composer](https://getcomposer.org/).

While having Composer installed it takes only `composer require chypriote/pandascore-php` and `composer install` to get the library ready to roll!


# PandaScore API


## Resources
Below you can find table of implemented API resources. Endpoints without status are not planned to be implemented yet.

| Resource         | Status |
| ---------------- | ------ |
| All Videogames - Leagues | ![All Videogames - Leagues resource implemented version](https://img.shields.io/badge/implemented-yes-success.svg) |
| All Videogames - Series | ![All Videogames - Series resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| All Videogames - Tournaments | ![All Videogames - Tournaments resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| All Videogames - Matches | ![All Videogames - Matches resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| All Videogames - Teams | ![All Videogames - Teams resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| All Videogames - Players | ![All Videogames - Players resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Champions | ![LOL - Champions resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| LOL - Games | ![LOL - Games resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Items | ![LOL - Items resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| LOL - Leagues | ![LOL - Leagues resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Masteries | ![LOL - Masteries resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| LOL - Matches | ![LOL - Matches resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Players | ![LOL - Players resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Runes | ![LOL - Runes resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| LOL - Series | ![LOL - Series resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Spells | ![LOL - Spells resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| LOL - Stats | ![LOL - Stats resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Teams | ![LOL - Teams resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| LOL - Tournaments | ![LOL - Tournaments resource implemented version](https://img.shields.io/badge/implemented-no-critical.svg) |
| CSGO | ![CSGO resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| DOTA 2 | ![DOTA 2 resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |
| Overwatch | ![Overwatch resource implemented version](https://img.shields.io/badge/implemented----inactive.svg) |


## Initializing the library
How to begin?

```php
//  Include all required files
require_once __DIR__  . "/vendor/autoload.php";

use PandaScoreAPI\PandaScoreAPI;

//  Initialize the library
$api = new PandaScoreAPI([
	//  Your API key, you can get one at https://pandascore.co/settings
	PandaScoreAPI::SET_TOKEN    => 'YOUR_PANDASCORE_TOKEN',
]);

//  And now you are ready to rock!
$ch = $api->getLeague(61);
```

And there is a lot more what you can set when initializing the library - mainly to enable special features or to amend behaviour of the library.


## Usage example
Working with PandaScoreAPI can not be easier, just watch how to fetch a league information based on its id:

```php
//  ...initialization...

//  this fetches the summoner data and returns SummonerDto object
$league = $api->getLeague(4213);

echo $league->id;             //  4213
echo $league->name;           //  LVP SLO
echo $league->slug;           //  league-of-legends-lvp-slo

print_r($league->getData());  //  Or array of all the data
/* Array
 * (
 *     [id] => 4213
 *     [slug] => league-of-legends-lvp-slo
 *     [name] => LVP SLO
 * )
 */
```


## Cache providers
Cache providers are responsible for keeping data of [rate limiting](#rate-limiting) and [call caching](#call-caching) within instances of the library.
This feature is automatically enabled, when any of previously mentioned features is used.

When using this feature, you can set `PandaScoreAPI::SET_CACHE_PROVIDER` to any class, thought it has to implement `Objects\ICacheProvider` interface.
By using `PandaScoreAPI::SET_CACHE_PROVIDER_PARAMS` option, you can pass any variables to the cache provider.


## Rate limiting
This clever feature will easily prevent exceeding your per key call limits & method limits.
In order to enable this feature, you have to set `PandaScoreAPI::SET_CACHE_RATELIMIT` to `true`.
Everything is completly automatic, so all you need to do is to enable this feature.


## Call caching
This feature can prevent unnecessary calls to API within short timespan by temporarily saving fetched data from API and using them as the result data.
In order to enable this feature, you have to set `PandaScoreAPI::SET_CACHE_CALLS` to `true`.
You should also provide `PandaScoreAPI::SET_CACHE_CALLS_LENGTH` option or else default time interval of `60 seconds` will be used.


## Asynchronous requests
This feature allows request grouping and their asynchronous sending using [Guzzle](https://github.com/guzzle/guzzle).
After request is sent and its response received, user provided callbacks are invoked with received data.


## Extensions
Using extensions for ApiObjects is useful tool, allowing implementation of your own methods into the ApiObjects itself.
Extensions are enabled by using settings option `PandaScoreAPI::SET_EXTENSIONS` when initializing the library.


## Callback functions
Allows you to provide custom functions to be called before and after the actual API request is sent.

Before callbacks have ability to cancel upcomming request - when `false` is returned by _any callback_ function, exception `Exceptions\RequestException` is raised and request is cancelled.


## CLI support
You can easily get API results even in CLI:

```shell
root@localhost:~/src/PandaScoreAPI# php PandaScoreAPICLI.php getLeague 61 --config ~/PandaScoreAPI_Config.json
```
