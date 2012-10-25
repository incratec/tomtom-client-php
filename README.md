tomtom-client-php
=================

PHP client for TomTom Geocoding API

files
-----
* TomTomGeocoder.php: encapsulates the communication with TomTom geocoding server
* SampleScript.php: sample file showing the usage

usage
-----
1. instantiate the TomTom geocoding client
```php
require_once __DIR__.'/TomTomGeocoder.php';
$geocoder = new GeocoderPro\Geocoder\TomTom\TomTomGeocoder('YOUR_API_KEY'); 
```
You can obtain your API key at TomTom's developer portal.

2. geocode the address
```php
$result = $geocoder->geocodeAddress('New York', 'USA', 20, '11 West 53 Street', null, '10019', 'NY');
```
Depending on the geocoding result, you will receive one address or a a list of addresses, with latitude and longitue, along with additional data provided by TomTom.
```
php SampleScript.php 
Geocoding MOMA, NYC...
formattedAddress: 53 W 53rd St, Midtown, New York, New York 1001954, US
type: addresspoint
latitude: 40.761540
longitude: -73.978480
geohash: dr5rus6t0mz1
score: 1.000000
confidence: 0.201106
```
See <a href="SampleScript.php">SampleScript.php</a> for a working sample.

license
-------
Licensed under MIT license (refer to <a href="LICENSE">LICENSE</a> for the license text and more information).
Please credit http://www.geocoderpro.com e.g. using a link from your website.

help + support
--------------
Please contact us at http://www.geocoderpro.com/ if you need help.
