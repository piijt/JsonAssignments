<?php
require_once 'DbP.php';
require_once 'DbH.php';
$dbh = DbH::getDbH();
$sql = "select name, population, capital, population/surfacearea, headofstate";
$sql .= " from country";
$sql .= " where code = 'DNK';";
$res = $dbh->query($sql);

$arr = array();
while ($out = $res->fetch(PDO::FETCH_ASSOC)) {
    array_push($arr, $out);
}
// var_dump($a); // connection established

// encode $arr to json
$data = json_encode($arr, JSON_PRETTY_PRINT);
file_put_contents('test.json', $data);

// get content in $jsondata and decode as $json for later output
$jsondata = file_get_contents("test.json");
$json = json_decode($jsondata, true);

$output = "<ul>";

foreach ($json as $jsondata => $co) {
  $output .= "<h4>".$co['name']."</h4>";
  $output .= "<li> Population: ".$co['population']."</li>";
  $output .= "<li> Capital:".$co['capital']."</li>";
  $output .= "<li> Head of State: ".$co['headofstate']."</li>";
  $output .= "<li> Population Density: ".$co['population/surfacearea']."</li>";
}
$output .= "</ul>";
echo $output;
?>

<!-- remaining issue
data is not parsed correctly to php when
more than one country -> some sql issues there..
output with javascript recieve each country with ajax from dropdown
 -->
