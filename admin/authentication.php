<?php
session_start();
include('config/dbcon.php');

if (!isset($_SESSION['auth'])) {

    header("location: ../login.php");
    exit(0);
} else {
}
