<?php
require_once 'DbP.php';
require_once 'DbH.php';
$dbh = DbH::getDbH();
$sql = "select name, population, capital, population/surfacearea, headofstate";
$sql .= " from country";
$res = $dbh->query($sql);

$a = array();
while ($out = $res->fetch(PDO::FETCH_ASSOC)) {
    array_push($a, $out);
}

$jdata = json_encode($a, JSON_PRETTY_PRINT);
file_put_contents('test.json', $jdata);

$json = file_get_contents('test.json'); // file 2 string
$jdata = json_decode($json); // string to json
?>
