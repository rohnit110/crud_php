<?php
session_start();
include 'Database/database.php';
session_unset();
session_destroy();
header("location: index.php");
