<?php
include 'base.php';
global $mysqli;

$id = $mysqli->escape_string($_GET['messid']); $id++;
$from = $mysqli->escape_string($_GET['from']);
$a = array();

$res = $mysqli->query("SELECT * FROM chat WHERE level = {$_SESSION['level']} AND id = $id AND chat.from = '$from'");

if ($res->num_rows != 0) {
	$mess = $res->fetch_array();
	$a['mess'] = $mess['mess'];
	$a['delay'] = $mess['delay'] == 0 ? 0 : $mess['delay'];
	$a['messid'] = $id;
} else {
	$a['mess'] = "";
	$a['delay'] = 0;
	$a['messid'] = 0;
}

echo json_encode($a);

?>