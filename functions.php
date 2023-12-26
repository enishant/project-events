<?php

function db_connection() {
	global $db_server;
	global $db_user;
	global $db_password;
	global $db_name;

	$conn = mysqli_connect( $db_server, $db_user, $db_password, $db_name );
	if ( $conn->connect_error ) {
		die( 'Connection failed: ' . $conn->connect_error );
	}

	return $conn;
}

function db_close( $conn ) {
	if ( $conn ) {
		$conn->close();
	}
}

function execute_api( $api, $call ) {
	$response = array(
		'status'  => null,
		'message' => null,
		'data'    => array(),
	);
	$method   = $api . '_' . $call;
	$response = $method();
	header( 'Content-Type: Application/json' );
	return json_encode( $response );
}

function format_insert_data( $data ) {
	if ( ! empty( $data ) && is_array( $data ) ) {
		$keys          = array_keys( $data );
		$values        = array_values( $data );
		$keys          = implode( ',', $keys );
		$count         = count( $values );
		$insert_values = '';
		for ( $i = 0; $i < $count; $i++ ) {
			if ( $i > 0 ) {
				$insert_values .= ',';
			}
			$val = $values[ $i ];
			if ( is_string( $val ) ) {
				$insert_values .= "'" . $val . "'";
			} else {
				$insert_values .= '' . $val;
			}
		}
		return array(
			'keys'   => $keys,
			'values' => $insert_values,
		);
	}
	return false;
}

function insert( $table, $data ) {
	if ( ! empty( $data ) && is_array( $data ) ) {
		$data         = format_insert_data( $data );
		$conn         = db_connection();
		$insert_query = "INSERT INTO $table (" . $data['keys'] . ') VALUES (' . $data['values'] . ');';
		if ( $conn->query( $insert_query ) === true ) {
			return array(
				'status' => 'success',
				'id'     => $conn->insert_id,
			);
		} else {
			return array(
				'status' => 'error',
			);
		}
		db_close( $conn );
	}
	return false;
}

function fetch( $table = '', $select = '*', $where = ' 1 ', $limit = '', $offset = '' ) {
	if ( ! empty( $table ) && ! empty( $select ) ) {
		$select_query = "SELECT $select FROM $table WHERE $where";
		$conn         = db_connection();
		$result       = $conn->query( $select_query );
		if ( $result->num_rows > 0 ) {
			$rows = $result->fetch_all( MYSQLI_ASSOC );
			db_close( $conn );
			return $rows;
		} else {
			db_close( $conn );
			return array();
		}
	}
	return false;
}

function user_signup() {
	$conn      = db_connection();
	$email     = $conn->real_escape_string( $_POST['email'] );
	$password  = $conn->real_escape_string( $_POST['password'] );
	$firstname = $conn->real_escape_string( $_POST['firstname'] );
	$lastname  = $conn->real_escape_string( $_POST['lastname'] );
	$phone     = $conn->real_escape_string( $_POST['phone'] );

	$data = array(
		'email'     => $email,
		'password'  => $password,
		'firstname' => $firstname,
		'lastname'  => $lastname,
		'phone'     => $phone,
	);

	$response = insert( 'users', $data );

	if ( $response['status'] == 'success' ) {
		$response['message'] = 'User created successfully.';
	} elseif ( $response['status'] == 'error' ) {
		$response['message'] = 'Unable to create new user.';
	}
	return $response;
}

function user_auth() {
	$conn     = db_connection();
	$email    = $conn->real_escape_string( $_POST['email'] );
	$password = $conn->real_escape_string( $_POST['password'] );
	$data     = array(
		'email'    => $email,
		'password' => $password,
	);
	$result   = fetch( 'users', '*', " email='" . $email . "' AND password='" . $password . "' " );
	if ( count( $result ) > 0 && isset( $result[0] ) ) {
		unset( $result[0]['password'] );
		$_SESSION['userdata'] = $result[0];
		$response['data']     = $result[0];
		$response['status']   = 'success';
		$response['message']  = 'User Authentication successfully.';
	} else {
		$response['status']  = 'error';
		$response['message'] = 'Authentication failed.';
	}
	return $response;
}

function is_user_logged_in() {
	if ( isset( $_SESSION['userdata'] ) === true ) {
		return true;
	}
	return false;
}
