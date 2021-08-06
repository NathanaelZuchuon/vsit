<?php

function encrypt_decrypt ($string, $action='encrypt') : string {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$secret_iv = 'This is my secret iv';
	$secret_key = 'This is my secret key';
	$key = hash('sha256', $secret_key);
	
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	switch ( $action ) {
		case 'encrypt':
			$output = openssl_encrypt( $string, $encrypt_method, $key, 0, $iv );
			$output = base64_encode( $output );
			break;
		case 'decrypt':
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
			break;
	}
	
	return $output;
}
