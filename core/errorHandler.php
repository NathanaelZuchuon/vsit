<?php

class errorHandler {
	public function __construct ($error=null) {
		switch ( $error ) {
			case '404':
				include __DIR__ . '\..\views\404.php';
				break;
			case '403':
				include __DIR__ . '\..\views\403.php';
				break;
		}
	}
}
