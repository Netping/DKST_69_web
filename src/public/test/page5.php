<?php

$dbh = new PDO ('sqlite:production.sqlite');
$rnd = rand (1, 9999);
$count = $dbh->exec ("INSERT INTO migrations (migration, batch) VALUES ('random_string_$rnd', $rnd);");

/*** echo the number of affected rows ***/
echo $count;

$dbh = null;

echo "</br></br>Sqlite INSERT test complete.";
?>

