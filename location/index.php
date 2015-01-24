<?php
require_once("./userip/ip.codehelper.io.php");
require_once("./userip/php_fast_cache.php");

$_ip = new ip_codehelper();

$real_client_ip_address = $_ip->getRealIP();
$visitor_location       = $_ip->getLocation($real_client_ip_address);

$guest_ip   = $visitor_location['IP'];
$guest_country = $visitor_location['CountryName'];
$guest_city  = $visitor_location['CityName'];
$guest_state = $visitor_location['RegionName'];

echo "IP Address: ". $guest_ip. "<br/>";
echo "Country: ". $guest_country. "<br/>";
echo "State: ". $guest_state. "<br/>";
echo "City: ". $guest_city. "<br/>";


$ip 				= $visitor_location['IP'];
$Continent_Code 	= $visitor_location['ContinentCode'];
$Continent_Name 	= $visitor_location['ContinentName'];
$Country_Code2 		= $visitor_location['CountryCode2'];
$Country_Code3 		= $visitor_location['CountryCode3'];
$Country 			= $visitor_location['Country'];
$Country_Name 		= $visitor_location['CountryName'];
$State_Name 		= $visitor_location['RegionName'];
$City_Name 			= $visitor_location['CityName'];
$City_Latitude 		= $visitor_location['CityLatitude'];
$City_Longitude 	= $visitor_location['CityLongitude'];
$Country_Latitude 	= $visitor_location['CountryLatitude'];
$Country_Longitude	= $visitor_location['CountryLongitude'];
$Country_Longitude	= $visitor_location['CountryLongitude'];
$LocalTimeZone 		= $visitor_location['LocalTimeZone'];
$Calling_Code		= $visitor_location['CallingCode'];
$Population			= $visitor_location['Population'];
$Area_SqKm			= $visitor_location['AreaSqKm'];
$Capital			= $visitor_location['Capital'];
$Electrical			= $visitor_location['Electrical'];
$Languages			= $visitor_location['Languages'];
$Currency			= $visitor_location['Currency'];
$Flag 				= $visitor_location['Currency'];




?>