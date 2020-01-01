<?php


session_start();
require_once('vendor/autoload.php');

#for error reporting
//error_reporting(0);

#database
include_once 'config/db_config.php';

#include helper.php
include_once "config/helper.php";

#PHP Mailer
$GLOBALS['smtp_username'] = '';
$GLOBALS['smtp_password'] = '';
$GLOBALS['smtp_host'] = 'smtp.gmail.com';
$GLOBALS['admin_email'] = '';

$GLOBALS['xampp_macos'] = true;
$GLOBALS['send_email'] = true;

?>