<?php
$mysqli = new mysqli("localhost", "root", "", "oneschooldb");

if(!$mysqli) {
	header("location: db_error.php");
}