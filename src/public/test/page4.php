<?php

$dbh = new PDO ('sqlite:production.sqlite');
$STH = $dbh->query ('SELECT * FROM migrations');
while($row = $STH->fetch()) {  
    echo $row[0] . "\n";  
    echo $row[1] . "\n";  
    echo "</br>\n";
}

echo "</br></br>Sqlite SELECT test complete.";
?>

