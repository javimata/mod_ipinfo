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

if ( $ip_address ) {

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

    ?>
    <div class="ipinfo">
        IP: <?php echo $info["ip"]; ?><br>
        Hostname: <?php echo $info["hostname"]; ?><br>
        City: <?php echo $info["city"]; ?><br>
        Region: <?php echo $info["region"]; ?><br>
        Country: <?php echo $info["country"]; ?><br>
        Loc: <?php echo $info["loc"]; ?><br>
        Org: <?php echo $info["org"]; ?><br>
        Postal: <?php echo $info["postal"]; ?><br>
        Timezone: <?php echo $info["timezone"]; ?>
    </div>

    <?php

}