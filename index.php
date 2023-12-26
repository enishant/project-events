<?php

require_once 'header.php';
$action = isset( $_GET['action'] ) ? $_GET['action'] : 'home';
if ( file_exists( 'templates/' . $action . '.php' ) ) {
	require_once 'templates/' . $action . '.php';
} else {
	echo '<div class="container"><h2>Requested page not found </h2></div>';
}
require_once 'footer.php';
