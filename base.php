<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

// xLuFqMSTyJ

$mysqli = new mysqli("127.0.0.1", "root", "", "digitalfortress");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysqli_error());
//mysql_select_db($dbname) or die("MySQL Error: " . mysqli_error());

$mysqli->query("set character_set_results='utf8'"); 
$mysqli->query("set collation_connection='utf8_general_ci'"); 
$mysqli->query("SET NAMES utf8");

define("ROOT_PATH", 'http://local/digitalfortress/');

function initUser($createNew = false) {
	global $mysqli;
	if (!isset($_SESSION['id'])) {
		if (isset($_POST['id'])) {
			$res = $mysqli->query("SELECT * FROM users WHERE randid={$_POST['id']}");
			if ($res->num_rows == 0) if ($createNew) newId();
			$row = $res->fetch_array();
			$_SESSION['rid'] = $_POST['id'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['level'] = $row['level'];
		} else if ($createNew) newId();
	}
}

function newId() {
	$r = rand() % 100000;
	global $mysqli;
	$mysqli->query("INSERT INTO users (ip, randid, start, level) VALUES ('{$_SERVER['REMOTE_ADDR']}', '$r', now(), 1)");
	$_SESSION['id'] = $mysqli->insert_id;
	$_SESSION['rid'] = $r;
	setcookie('rid', $r, time()+60*60*24*30);
	$_SESSION['level'] = 1;
}

?>
