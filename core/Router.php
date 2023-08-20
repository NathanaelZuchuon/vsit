<?php

namespace vsit\core;

use Exception;
use vsit\controllers\{dashboardController, homeController, loginController};

class Router {
	
	private array $_url = array();
	private array $_controllers = array();
	
	public function add ($url, $controller) : void {
		$this->_url[] = $url;
		$this->_controllers[] = $controller;
	}
	
	private function getClass ($controller) {
		switch ($controller) {
			case 'homeController':
				return homeController::class;
			case 'dashboardController':
				return dashboardController::class;
			case 'loginController':
				return loginController::class;
		}
	}
	
	public function submit() {
		try {
			$urlParam = '/' . explode('/', $_GET['url'])[0] ?? '/home';
			$urlParam = ( $urlParam == '/' ) ? '/home' : $urlParam;
			
			$controllerFunc = explode('/', $_GET['url'])[1] ?? null;
			
			if ( in_array($urlParam, $this->_url) ) {
				foreach ($this->_url as $key => $value) {
					if ( preg_match("#^$value$#", $urlParam) ) {
						$controller = '\\' . $this->getClass($this->_controllers[$key]);
						
						if ( !is_null($controllerFunc) && !empty(trim($controllerFunc))
							&& method_exists($controller, $controllerFunc)
							&& in_array($controllerFunc, get_class_methods($controller)) ) {
							(new $controller())->{$controllerFunc}();
						} elseif ( $controllerFunc == '' ) {
							(new $controller())->{'def'}();
						} elseif ( !method_exists($controller, $controllerFunc) ) {
							new errorHandler('404');
						} elseif ( !in_array($controllerFunc, get_class_methods($controller)) ) {
							new errorHandler('403');
						}
					}
				}
			} else {
				new errorHandler('404');
			}
		} catch (Exception $e) {
			new errorHandler($e);
		}
	}
}