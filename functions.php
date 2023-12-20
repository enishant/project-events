<?php
function db_connection() {
    global $db_server;
    global $db_user;
    global $db_password;
    global $db_name;
    return mysqli_connect($db_server, $db_user, $db_password,$db_name );
}

function signup($data) {
    $conn = db_connection();
    return $conn;
}

function execute_api($api,$call) {
    $response = [
        'status' => null,
        'message' => null,
        'data' => [],
    ];
    return json_encode($response);
}
