<?php
session_start();
require ("../database/sql_connect.php");

if(!isset($_SESSION['name']) || $_SESSION['id'][0] != 'T'){
  header("location: ../index.php");
}

$title =  $_POST["title"];
$summary = $_POST["summary"];
$author = $_POST["author"];

$book = "../ulib/book/";
$cover = "../ulib/bookCover/";

$book = $book.basename($_FILES["book"]["name"]);
$cover = $cover.basename($_FILES["bookCover"]["name"]);
if($_FILES["book"]["error"] == 0 && $_FILES["bookCover"]["error"] == 0) {
    move_uploaded_file($_FILES["book"]["tmp_name"], $book);
    move_uploaded_file($_FILES["bookCover"]["tmp_name"], $cover);

    $result = mysqli_query($mysqli, "INSERT INTO UNIV_LIBRARY (title, summary, author, book_path, book_cover) VALUES ('".$title."', '".$summary."', '".$author."', '".$book."', '".$cover."')");

    if ($result){
        header("location: library.php");
    } else {
        header("location: ../database/db_error.php");
    }
}
