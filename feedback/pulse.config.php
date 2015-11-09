<?php

session_start();
ob_start();
error_reporting(E_ALL-E_NOTICE);

define('PULSE_DIR', 'http://getleads.ch/feedback'); // absolute path of the dir where PulsePro is; WITHOUT trailing slash

/** DATABASE CONNECTION CONFIGURATION **/
define('HOSTNAME', 'ministi.mysql.db.hostpoint.ch'); // hostname of your database; it is localhost in most cases
define('USERNAME', 'ministi_arthur'); // username of the database
define('PASSWORD', 'minimini8'); // password for the database
define('DATABASE', 'ministi_getleadsvoting'); // name of the database

@mysql_connect(HOSTNAME, USERNAME, PASSWORD) or die("Cannot connect to database!");
@mysql_select_db(DATABASE) or die("Cannot select database!");
?>
