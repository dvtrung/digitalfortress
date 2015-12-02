<?php
include 'base.php';
global $mysqli;

function returnString($str) {
	echo json_encode(array(array($str)));
	exit();
}
$fullcmd = trim($mysqli->escape_string($_POST['cmd']), ' ');
if (strpos(' ', $fullcmd) == NULL) $cmd = $fullcmd;
else $cmd = substr($fullcmd, 0, strpos(' ', $fullcmd));

if ($fullcmd == 'level') returnString("You are at level {$_SESSION['level']}");
if ($fullcmd == 'myid') returnString("Your ID: {$_SESSION['rid']}");
if ($fullcmd == 'reset') { unset($_SESSION['id']); returnString(""); }
if ($fullcmd == '') { returnString(""); }

$res = $mysqli->query("SELECT * FROM cmd WHERE cmd = '$fullcmd' AND ((level <= {$_SESSION['level']} AND (one_level = 0)) OR (level = {$_SESSION['level']})) ORDER BY level DESC");
if ($res->num_rows != 0) {
	$row = $res->fetch_array();
	if ($row['nextlevel'] == 1) {
		$_SESSION['level']++;
		$mysqli->query("UPDATE users SET level = level + 1 WHERE id={$_SESSION['id']}");
		echo ".";
	}
	$str_echo = str_replace("\\t", "\t", $row['echo']);
	$str_echo = str_replace("\\n", "\n", $str_echo);
	$a = explode('~', $str_echo);
	$b = array();
	foreach ($a as $i => $val) {
		$arr = explode('|', $val);
		$a[$i] = array($arr[0], isset($arr[1]) ? $arr[1] : 0);
	}
	echo json_encode($a);
}
else returnString("$cmd: command not found");
?>
