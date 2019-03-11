

<?php
$json = file_get_contents('http://api.statbank.dk/v1/subjects?recursive=true&omitSubjectsWithoutTables=true&format=JSON');
// api key 9edb73d5d23103305e740943d3262926

                                    // received as a one line json string
$obj = json_decode($json);          // unserialize to json obj
prettyPrintForDebug($obj);          // comment out after debugging
?>
<!doctype html>
<html>
    <head>
        <style>
            table, th, td { border: 1px solid red; }
        </style>
    </head>
    <body>
<?php
  $tab = "<table>
            <tr>
                <th colspan='2'>%s</th>
            </tr>
            <tr>
                <td colspan='2'>%s</td>
            </tr>
            <tr>
                <td>Low</td><td>High</td>
            </tr>
            <tr>
                <td>%s&deg;C</td><td>%s&deg;C</td>
            </tr>
        </table>";
    printf($tab."\n", $obj->name, strftime("%A", $obj->dt),
                                  round(K2C($obj->main->temp_min), 0),
                                  round(K2C($obj->main->temp_max), 0));
?>
    </body>
</html>
<?php
function prettyPrintForDebug($obj) {
    $str = json_encode($obj, JSON_PRETTY_PRINT);
    print("<pre>".$str."</pre>");
}
function K2C($x) { return $x - 273.15; }
