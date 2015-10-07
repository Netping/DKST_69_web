<html>
<body>

<a href="/test/index.php?test=1">test1</a>: simple html page</br>
<a href="/test/index.php?test=2">test2</a>: simple html page + it's pictures</br>
<a href="/test/index.php?test=3">test3</a>: simple PHP-page</br>
<a href="/test/index.php?test=4">test4</a>: simple PHP + Read from SQLITE</br>
<a href="/test/index.php?test=5">test5</a>: simple PHP + Write to SQLITE<br>

<?php

$output = "Nothing";
if (isset($_GET["test"]))
{
if ($_GET["test"] === "1")        $output = shell_exec ("./test.sh http://np.tst.netping.ru:8090/test/page1.html 2>&1");
else if ($_GET["test"] === "2")   $output = shell_exec ("./test.sh http://np.tst.netping.ru:8090/test/page2.html 2>&1");
else if ($_GET["test"] === "3")   $output = shell_exec ("./test.sh http://np.tst.netping.ru:8090/test/page3.php 2>&1");
else if ($_GET["test"] === "4")   $output = shell_exec ("./test.sh http://np.tst.netping.ru:8090/test/page4.php 2>&1");
else if ($_GET["test"] === "5")   $output = shell_exec ("./test.sh http://np.tst.netping.ru:8090/test/page5.php 2>&1");
else  $output = "Invalid param 'test' ";

echo "</br></br>";
echo "Test Result:</br>";
echo "<pre>$output</pre>";
}

?>

</body>
