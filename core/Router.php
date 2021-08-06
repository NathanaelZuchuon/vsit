<?php

class Router {
	
	private $_uri = array();
	private $_controllers = array();
	
	public function add($uri, $controller=null) {
		$this->_uri[] = $uri;
		
		if ( !is_null($controller) ) {
			$this->_controllers[] = $controller;
		}
	}
	
	public function submit() {
		try {
			$uriParam = '/' . explode('/', $_GET['uri'])[0] ?? '/home';
			$uriParam = ( $uriParam == '/' ) ? '/home' : $uriParam;
			
			$controllerFunc = explode('/', $_GET['uri'])[1] ?? null;
			
			if ( in_array($uriParam, $this->_uri) ) {
				foreach ($this->_uri as $key => $value) {
					if ( preg_match("#^$value$#", $uriParam) ) {
						$controller = $this->_controllers[$key];
						if ( !is_null($controllerFunc) && !empty(trim($controllerFunc)) && method_exists($controller, $controllerFunc) && in_array($controllerFunc, get_class_methods($controller)) ) {
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
