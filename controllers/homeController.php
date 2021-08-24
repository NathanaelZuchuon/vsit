<?php

namespace vsit\controllers;

use vsit\core\{Controller};

class homeController extends Controller {
	public function def () {
		include __DIR__ . '/../views/home.php';
	}
}
