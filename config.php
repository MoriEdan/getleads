<?php


header('content-type: text/html; charset: utf-8');

$dbhost = 'ministi.mysql.db.hostpoint.ch';

$dbuser = 'ministi_goqr';

//$dbpass = 'x12AJOpB';
$dbpass ='MU0FgnfC';

$conn 	= mysql_connect($dbhost, $dbuser, $dbpass);

if(! $conn ){
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('ministi_getleads');


mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);