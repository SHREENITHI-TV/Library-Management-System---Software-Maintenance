<!DOCTYPE html>
<?php
require_once __DIR__ . '/../dbconnect.php';

$username  = $_SESSION['username']  ?? '';
$full_name = $_SESSION['full_name'] ?? '';
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Library Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">
    <link href="../../assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<script src="../../assets/js/vendor.min.js"></script>
<script src="../../assets/js/app.min.js"></script>

<script src="../../assets/js/vendor/apexcharts.min.js"></script>
<script src="../../assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>

<script src="../../assets/js/pages/demo.dashboard.js"></script>
    <div class="wrapper">
        <div class="navbar-custom">
            <ul class="list-unstyled">
                <li>
                    <h2 class=" display-4">Library Management System</h2>
                </li>
            </ul>
        </div>
        <div class="leftside-menu">
            <!-- <a href="home.php" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="../../assets/images/logo.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="../../assets/images/logo_sm.png" alt="" height="16">
                </span>
            </a> -->
            


            <div class="h-100" id="leftside-menu-container" data-simplebar="">