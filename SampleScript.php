<?php
/**
 * Copyright (C) 2012 incratec.com / Tobias Kluge - licensed under MIT license
 * Please credit https://www.geocoderpro.com e.g. using a link from your website.
 *
 * sample script for geocoding of an address (here: MOMA, NYC)
 *
 * @author Tobias Kluge, incratec.com
 */

require_once __DIR__.'/TomTomGeocoder.php';
$geocoder = new GeocoderPro\Geocoder\TomTom\TomTomGeocoder('YOUR API KEY'); 
echo "Geocoding MOMA, NYC...\n";
$result = $geocoder->geocodeAddress('New York', 'USA', 20, '11 West 53 Street', null, '10019', 'NY');

printf("formattedAddress: %s \n", $result->formattedAddress);
printf("type: %s \n", $result->type);
printf("latitude: %f \n", $result->latitude);
printf("longitude: %f \n", $result->longitude);
printf("geohash: %s \n", $result->geohash);
printf("score: %f \n", $result->score);
printf("confidence: %f \n", $result->confidence);
