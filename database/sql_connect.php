<?php
/*$host = 'localhost';
$db = 'oneschooldb';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysqli:host=$host;dbname=$db;charset=$charset";
$opt = [
	PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES		=> false,
];

$pdo = new PDO($dsn, $user, $pass);
/*
$stmt = $pdo->prepare("SELECT * FROM student WHERE active = ?");
$stmt->execute([1]);
$user = $stmt->fetch();

echo $user;*/

$mysqli = mysqli_connect("localhost", "root", "", "oneschooldb");

if(!$mysqli) {
	header("location: db_error.php");
}