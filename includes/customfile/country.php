<?php

require_once(TP_PATH . "includes/geo/SxGeo.php");
$SxGeo = new SxGeo(TP_PATH . "includes/geo/SxGeoCity.dat");

$date = date('Y-m-d');

$ipAddress = $_SERVER['REMOTE_ADDR'];

$country = $SxGeo->getCountry($ipAddress);

if ($country == '') {
    $country = 'US';
}

$country_stats = get_post_meta($this->poll->id(), 'country', true);
if (!is_array($country_stats)) {
    $country_stats = array();
}
if (isset($country_stats[$country])) {
    $country_stats[$country] = $country_stats[$country] + 1;
} else {
    $country_stats[$country] = 1;
}
update_post_meta($this->poll->id(), 'country', $country_stats);

$country_by_date_stats = get_post_meta($this->poll->id(), 'country_by_date', true);
if (!is_array($country_by_date_stats)) {
    $country_by_date_stats = array();
}
if (!isset($country_by_date_stats[$date])) {
    $country_by_date_stats[$date] = [];
}
if (isset($country_by_date_stats[$date][$country])) {
    $country_by_date_stats[$date][$country] = $country_by_date_stats[$date][$country] + 1;
} else {
    $country_by_date_stats[$date][$country] = 1;
}
update_post_meta($this->poll->id(), 'country_by_date', $country_by_date_stats);

$country_continents = ["MZ" => "Africa", "SI" => "Europe", "TH" => "Asia", "RU" => "Europe", "CO" => "America", "MA" => "Africa", "MY" => "Asia", "TT" => "America", "MG" => "Indian", "MX" => "NAmerica", "FR" => "Europe", "US" => "NAmerica", "NC" => "Pacific", "PT" => "Europe", "TR" => "Europe", "LB" => "Asia", "PH" => "Asia", "NA" => "Africa", "MT" => "Europe", "GR" => "Europe", "YT" => "Indian", "IQ" => "Asia", "NG" => "Africa", "NI" => "America", "AR" => "America", "LS" => "Africa", "UA" => "Europe", "IS" => "Atlantic", "EE" => "Europe", "LT" => "Europe", "RO" => "Europe", "GB" => "Europe", "KZ" => "Asia", "JP" => "Asia", "BD" => "Asia", "PR" => "America", "VI" => "America", "VE" => "America", "AO" => "Africa", "KE" => "Africa", "UY" => "America", "LR" => "Africa", "IN" => "Asia", "IR" => "Asia", "KM" => "Indian", "PA" => "NAmerica", "LY" => "Africa", "BG" => "Europe", "CA" => "NAmerica", "ES" => "Europe", "NO" => "Europe", "CY" => "Asia", "AE" => "Asia", "PL" => "Europe", "CZ" => "Europe", "TZ" => "Africa", "MK" => "Europe", "GE" => "Asia", "CH" => "Europe", "KG" => "Asia", "BS" => "America", "PE" => "America", "ID" => "Asia", "BR" => "America", "SL" => "Africa", "JM" => "America", "AU" => "Australia", "ZA" => "Africa", "EG" => "Africa", "IT" => "Europe", "HU" => "Europe", "ME" => "Europe", "FO" => "Atlantic", "LV" => "Europe", "SD" => "Africa", "BO" => "America", "CL" => "America", "SE" => "Europe", "CR" => "NAmerica", "BE" => "Europe", "CI" => "Africa", "KP" => "Asia", "HR" => "Europe", "FI" => "Europe", "DE" => "Europe", "EC" => "America", "MU" => "Indian", "KR" => "Asia", "AL" => "Europe", "TN" => "Africa", "MD" => "Europe", "MQ" => "America", "UG" => "Africa", "VN" => "Asia", "ML" => "Africa", "AT" => "Europe", "SV" => "NAmerica", "PY" => "America", "CN" => "Asia", "GT" => "NAmerica", "ZM" => "Africa", "MW" => "Africa", "CM" => "Africa", "HN" => "NAmerica", "TW" => "Asia", "SK" => "Europe", "LI" => "Europe", "AX" => "Europe", "SZ" => "Africa", "PK" => "Asia", "BH" => "Asia", "DZ" => "Africa", "WS" => "Pacific", "AD" => "Europe", "OM" => "Asia", "GN" => "Africa", "NZ" => "Pacific", "AS" => "Pacific", "PF" => "Pacific", "SN" => "Africa", "CU" => "America", "GY" => "America", "BM" => "Atlantic", "TF" => "Indian", "XK" => "Europe", "SH" => "Atlantic", "GU" => "Pacific", "BZ" => "America", "ET" => "Africa", "KN" => "America", "BT" => "Asia", "CD" => "Africa", "AZ" => "Asia", "SA" => "Asia", "MN" => "Asia", "IL" => "Asia", "AM" => "Asia", "MR" => "Africa", "GG" => "Europe", "BB" => "America", "TD" => "Africa", "BW" => "Africa", "KH" => "Asia", "MP" => "Pacific", "KW" => "Asia", "SR" => "America", "GA" => "Africa", "RE" => "Indian", "CF" => "Africa", "DO" => "America", "HT" => "America", "BY" => "Europe", "VU" => "Pacific", "UZ" => "Asia", "YE" => "Asia", "NL" => "Europe", "BN" => "Asia", "LK" => "Asia", "LC" => "America", "AF" => "Asia", "NE" => "Africa", "DK" => "Europe", "GL" => "America", "MS" => "America", "VC" => "America", "RS" => "Europe", "ZW" => "Africa", "TL" => "Asia", "FJ" => "Pacific", "BQ" => "America", "GH" => "Africa", "GD" => "America", "HK" => "Asia", "BI" => "Africa", "DM" => "America", "CG" => "Africa", "BJ" => "Africa", "KI" => "Pacific", "JE" => "Europe", "PG" => "Pacific", "SY" => "Asia", "LU" => "Europe", "MM" => "Asia", "AG" => "America", "MV" => "Indian", "GM" => "Africa", "IE" => "Europe", "SM" => "Europe", "SS" => "Africa", "GQ" => "Africa", "MO" => "Asia", "PS" => "Asia", "GW" => "Africa", "JO" => "Asia", "SB" => "Pacific", "NP" => "Asia", "RW" => "Africa", "BF" => "Africa", "TJ" => "Asia", "CV" => "Atlantic", "QA" => "Asia", "SO" => "Africa", "BA" => "Europe", "WF" => "Pacific", "GP" => "America", "TG" => "Africa", "GF" => "America", "LA" => "Asia", "MC" => "Europe", "ST" => "Africa", "SJ" => "Arctic", "TM" => "Asia", "SC" => "Indian",];
$region = $country_continents[$country];

$region_stats = get_post_meta($this->poll->id(), 'continent', true);
if (!is_array($region_stats)) {
    $region_stats = array();
}
if (isset($region_stats[$region])) {
    $region_stats[$region] = $region_stats[$region] + 1;
} else {
    $region_stats[$region] = 1;
}
update_post_meta($this->poll->id(), 'continent', $region_stats);

$continent_by_date_stats = get_post_meta($this->poll->id(), 'continent_by_date', true);
if (!is_array($continent_by_date_stats)) {
    $continent_by_date_stats = array();
}
if (!isset($continent_by_date_stats[$date])) {
    $continent_by_date_stats[$date] = [];
}
if (isset($continent_by_date_stats[$date][$country])) {
    $continent_by_date_stats[$date][$country] = $continent_by_date_stats[$date][$country] + 1;
} else {
    $continent_by_date_stats[$date][$country] = 1;
}
update_post_meta($this->poll->id(), 'continent_by_date', $continent_by_date_stats);