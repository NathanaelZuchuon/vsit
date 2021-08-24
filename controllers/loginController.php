<?php

namespace vsit\controllers;

use vsit\core\{Controller};
use vsit\helpers\{passwordEncryption};
use vsit\models\{loginModel, loginRegistrationModel};

class loginController extends Controller {
	
	public function def () {
		include __DIR__ . '/../views/login.php';
	}
	
	private function passHacker ($password, $action='encrypt') : string {
		return (new passwordEncryption())->{'encrypt_decrypt'}($password, $action);
	}
	
	public function checkLogin () {
		include_once __DIR__ . '/../models/loginModel.php';
		
		$pseudo = $_POST['pseudo'];
		
		$password = $_POST['password'];
		$pass_hack = $this->passHacker($password);
		
		$ok = true;
		
		$model = new loginModel();
		$userInfos = $model->getUserInfo(array('pseudo', 'password'), array("pseudo = '$pseudo'", "password = '$pass_hack'"));
		
		if ( count($userInfos) == 0 ) {
			$ok = false;
		} else {
			$infos = $model->getUserInfo(array("*"), array("pseudo = '$pseudo'"));
			/* Set session's infos */
			foreach ($infos[0] as $key => $value) {
				if ( gettype($key) == "string" ) {
					$_SESSION[$key] = $value;
				}
			}
			/* ------------------- */
		}
		
		return die(json_encode(array('ok' => $ok)));
	}
	
	public function registration () {
		include __DIR__ . '/../views/loginRegistration.php';
	}
	
	public function checkLoginRegistration () {
		include_once __DIR__ . '/../models/loginRegistrationModel.php';
		
		$firstname = strtolower($_POST['firstname']);
		$lastname = strtolower($_POST['lastname']);
		$cni = $_POST['cni'];
		$role = $_POST['role'] ?? 'guard';
		$pseudo = $_POST['pseudo'];
		
		$password = $_POST['password'];
		$pass_hack = $this->passHacker($password);

		$ok = true;
		$cni_errors = array();
		$pseudo_errors = array();

		$model = new loginRegistrationModel();
		$usersCNI = $model->getUserInfo(array('cni'), array("cni = '$cni'"));
		$usersPseudos = $model->getUserInfo(array('pseudo'), array("pseudo = '$pseudo'"));

		if ( count($usersCNI) != 0 ) {
			$ok = false;
			$cni_errors[] = "Déjà existant";
		}
		
		if ( count($usersPseudos) != 0 ) {
			$ok = false;
			$pseudo_errors[] = "Déjà existant";
		}
		
		if ($ok) {
			$model->setUserInfo(array('firstname', 'lastname', 'cni', 'pseudo', 'password', 'role', 'timestamp'),
				array($firstname, $lastname, $cni, $pseudo, $pass_hack, $role, date("Y-m-d H:i:s")),
			);
		}
		
		return die(json_encode(array('ok' => $ok, 'cni_errors' => $cni_errors, 'pseudo_errors' => $pseudo_errors)));
		
	}
}
