<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use ipinfo\ipinfo\IPinfo;

require "vendor/autoload.php";
require "functions.php";

$ip_address = getUIP();

$db    = JFactory::getDBO();
$query = 'SELECT ip FROM #__ipinfo WHERE ip = "' . $ip_address . '"';
$db->setQuery($query);  
$ip = $db->loadResult();

if ( $ip ) {
    
    echo "<div class='text-muted d-none'>".$ip_address."</div>";

    /*
    $client = new IPinfo();
    $details = $client->getDetails($ip_address);
    
    $info = [
        "ip" => $details->ip,
        "hostname" => $details->hostname,
        "city" => $details->city,
        "region" => $details->region,
        "country" => $details->country,
        "loc" => $details->loc,
        "org" => $details->org,
        "postal" => $details->postal,
        "timezone" => $details->timezone
    ];

    $query = 'UPDATE #__ipinfo SET info = "' . implode("|",$info) . '" WHERE ip = "' . $ip_address . '"';
    $db->setQuery($query);
    $db->execute();
    */

} else {

    if ( !preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT']) ) {

        $client = new IPinfo();
        $details = $client->getDetails($ip_address);

        $info = [
            "ip" => $details->ip,
            "hostname" => $details->hostname,
            "city" => $details->city,
            "region" => $details->region,
            "country" => $details->country,
            "loc" => $details->loc,
            "org" => $details->org,
            "postal" => $details->postal,
            "timezone" => $details->timezone
        ];

        $db->setQuery('INSERT INTO #__ipinfo (ip, info) VALUES ("'.$ip_address.'","' . implode("|",$info) . '")');
        $db->execute();

    }

}