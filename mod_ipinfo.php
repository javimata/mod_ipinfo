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

$div_class  = $params->get("div_class");
$ip_address = getUIP();

if ( $ip_address ) {

    $client = new IPinfo();
    $details = $client->getDetails($ip_address);

    ?>
    <div class="ipinfo <?php echo $div_class; ?>">
        IP: <?php echo $details->ip; ?><br>
        Hostname: <?php echo $details->hostname; ?><br>
        City: <?php echo $details->city; ?><br>
        Region: <?php echo $details->region; ?><br>
        Country: <?php echo $details->country; ?><br>
        Loc: <?php echo $details->loc; ?><br>
        Org: <?php echo $details->org; ?><br>
        Postal: <?php echo $details->postal; ?><br>
        Timezone: <?php echo $details->timezone; ?>
    </div>

    <?php

}