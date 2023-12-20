<?php
require_once('config.php');
require_once('functions.php');

$api  = isset($_POST['api']) ? $_POST['api'] : '';
$call = isset($_POST['call']) ? $_POST['call'] : '';
if( empty($api) === false && empty($call)  === false ) {
  echo execute_api($api,$call);
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Events</title>
  </head>
  <body>
    <?php require_once('navbar.php'); ?>