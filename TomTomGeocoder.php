<?php
/**
 * Copyright (C) 2012 incratec.com / Tobias Kluge - licensed under MIT
 * Please credit https://www.geocoderpro.com e.g. using a link from your website.
 *
 * client class for TomTom geocoding API
 *
 * implements single geocoding request
 *
 * @author Tobias Kluge, incratec.com
 */
namespace GeocoderPro\Geocoder\TomTom;

class TomTomGeocoder {
    private $apiKey;
    private $language;
    const URL_SINGLE = "https://api.tomtom.com/lbs/geocoding/geocode?key=%s&language=%s";
    
    public function __construct($apiKey, $language = 'en') {
        $this->apiKey = $apiKey;
        $this->language = $language;
    }
    
    private function getBaseUrl()
    {
        return sprintf(TomTomGeocoder::URL_SINGLE, $this->apiKey, $this->language);
    }
    
    /**
     * geocode a single address
     *
     * @param string $city
     * @param string $countryIso3 country in iso3 format, e.g. USA or DEU
     * @param string $numberOfResult optional, 1 default; up to 20
     * @param string $street optional, can also contain house number
     * @param string $number
     * @param string $zip
     * @param string $state
     * @result misc false if error, 0 if no result, object array of geocoding result if succeeded
     */
    public function geocodeAddress($city, $countryIso3, $numberOfResult = 1, $street = null, $number = null, $zip = null, $state = null)
    {
        $queryUrl = $this->getBaseUrl();
        
        // optimize query if street and number are combined => use free-form query, returns better result
        if ($street != null && strlen($street)>0 && ($number == null || strlen($number)==0)) 
        {
            $queryUrl .= '&query='.urlencode(trim($street));
        }
        else
        {
            if ($street != null && strlen($street)>0) $queryUrl .= '&T='.urlencode(trim($street));
            if ($number != null && strlen($number)>0) $queryUrl .= '&ST='.urlencode(trim($number));
        }
        if ($zip != null && strlen($zip)>0) $queryUrl .= '&PC='.urlencode(trim($zip));
        if ($city != null && strlen($city)>0) $queryUrl .= '&L='.urlencode(trim($city));
        if ($state != null && strlen($state)>0) $queryUrl .= '&AA='.urlencode(trim($state));
        if ($countryIso3 != null && strlen($countryIso3)>0) $queryUrl .= '&CC='.urlencode(trim($countryIso3));
        
        $queryUrl .= '&maxResults='.$numberOfResult;

        $result = file_get_contents($queryUrl);
        $xmlParsed = simplexml_load_string($result);
    
        if ($xmlParsed == null) return false; // error
        if ($xmlParsed->attributes()->count[0] == 0) return 0; // no result
        return $xmlParsed->geoResult; // at least one match
    }
    
}