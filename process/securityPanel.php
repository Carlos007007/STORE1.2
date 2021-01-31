<?php
session_start();
error_reporting(E_PARSE);
if ($_SESSION['nombreAdmin']=="") {
    header("Location: index.php");
}