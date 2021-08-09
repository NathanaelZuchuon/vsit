<?php

include_once __DIR__ . '\..\models\dashboardUsersModel.php';
include_once __DIR__ . '\..\models\dashboardPersonsModel.php';
include_once __DIR__ . '\..\models\dashboardReportsModel.php';
include_once __DIR__ . '\..\models\dashboardVisitorsModel.php';

$users = new dashboardUsersModel();
$persons = new dashboardPersonsModel();
$reports = new dashboardReportsModel();
$visitors = new dashboardVisitorsModel();

class dashboardController extends Controller {
	
	private function checkAccess () : bool {
		if ( count($_SESSION) == 0 ) {
			header("Location: http://127.0.0.1/bhent_prods/vsit/home");
			return false;
		}
		return true;
	}
	
	public function def () {
		if ( $this->checkAccess() ) {
			$this->addVisitorInStackView();
		}
	}
	
	public function addVisitorInStackView () {
		if ( $this->checkAccess() ) {
			include __DIR__ . '\..\views\addVisitorInStack.php';
		}
	}
	
	public function removeVisitorFromStackView () {
		if ( $this->checkAccess() ) {
			include __DIR__ . '\..\views\removeVisitorFromStack.php';
		}
	}
	
	public function showVisitorsView () {
		if ( $this->checkAccess() ) {
			include __DIR__ . '\..\views\showVisitors.php';
		}
	}
	
	public function makeReportView () {
		if ( $this->checkAccess() ) {
			include __DIR__ . '\..\views\makeReport.php';
		}
	}
	
	public function addVisitorInStack () {
		if ( $this->checkAccess() ) {
			
			global $users;
			global $persons;
			global $visitors;
			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$sex = $_POST['sex'];
			$cni = $_POST['cni'];
			$phone = $_POST['phone'];
			$observation = htmlspecialchars($_POST['observation']);
			$ok = true;
			
			if ( !$persons->existenceCheck(array('cni'), array("cni = '$cni'")) ) {
				$persons->add(array('firstname', 'lastname', 'sex', 'cni', 'phone'), array($firstname, $lastname, $sex, $cni, $phone));
			}
			
			$cni_user = $_SESSION['cni'];
			$personID = $persons->id(array("cni = $cni"));
			$userID = $users->id(array("cni = $cni_user"));
			
			if ( $visitors->existenceCheck(array('arrived_at', 'left_at'), array("personID = '$personID'")) ) {
				$ok = false;
				return die(json_encode(array('ok' => $ok)));
			}
			
			$visitors->add(array('personID', 'userID', 'observation'), array($personID, $userID, $observation));
			return die(json_encode(array('ok' => $ok)));
		}
		
	}
	
	public function removeVisitorFromStack () {
		if ( $this->checkAccess() ) {
			global $persons;
			global $visitors;
			
			$cni = $_POST['cni'];
			$ok = true;
			
			if ( $persons->existenceCheck(array('cni'), array("cni = '$cni'")) ) {
				$personID = $persons->id(array("cni = $cni"));
			} else {
				$ok = false;
				return die(json_encode(array('ok' => $ok)));
			}
			
			$visitors->updateInfos(array('left_at'), array(date("Y-m-d H-i-s")), array("personID = $personID", "arrived_at = left_at"));
			return die(json_encode(array('ok' => $ok)));
		}
		
	}
	
	public function showVisitors () {
		if ( $this->checkAccess() ) {
			global $persons;
			global $visitors;
			
			$curr_date = date('Y-m-d');
			
			$personsInfos = $persons->getInfos(array('id', 'firstname', 'lastname', 'sex', 'cni', 'phone'),
				null, array('order_by' => 'id', 'order' => 'ASC', 'limit' => null, 'offset' => null));
			
			$visitorsInfos = $visitors->getInfos(array('personID', 'arrived_at', 'left_at'),
				array("SUBSTR(arrived_at, 1, 10) = '$curr_date'"), array('order_by' => 'personID', 'order' => 'ASC', 'limit' => null, 'offset' => null));
			
			return die( json_encode( array('personsInfos' => $personsInfos, 'visitorsInfos' => $visitorsInfos) ) );
		}
	}
	
	public function logout () {
		if ( $this->checkAccess() ) {
			foreach ( $_SESSION as $key => $value ) {
				unset($_SESSION[$key]);
			}
		}
	}
	
	public function makeReport () {
		if ( $this->checkAccess() ) {
			global $persons;
			global $reports;
			global $visitors;
			
			$start = str_replace('T', ' ', $_POST['start_at']);
			$end = str_replace('T', ' ', $_POST['end_at']);
			
			$start_at = str_replace('-', '_', $_POST['start_at']);
			$start_at = str_replace('T', '_', $start_at);
			
			$end_at = str_replace('-', '_', $_POST['end_at']);
			$end_at = str_replace('T', '_', $end_at);
			
			$generated_at = date("Y-m-d H-i-s");
			
			$personsInfos = $persons->getInfos(array("*"));
			
			if ( $start_at == $end_at ) {
				$filename = 'rapport_du_' . substr($start_at, 0, 10) . '_à_' . substr($start_at, 11, 17) . '.xls';
			} else {
				$filename = 'rapport_allant_du_' . substr($start_at, 0, 10) . '_à_' . substr($start_at, 11, 17) . '_au_' . substr($end_at, 0, 10) . '_à_' . substr($end_at, 11, 17) . '.xls';
			}
			
			$output = '<table><tr><th>Name</th><th>Surname</th><th>Sex</th><th>CNI</th><th>Phone</th><th>Arrived at</th><th>Left at</th><th>Observation</th></tr>';
			
			foreach ( $personsInfos as $personValue ) {
				
				$id = $personValue['id'];
				$firstname = $personValue['firstname'];
				$lastname = $personValue['lastname'];
				$sex = $personValue['sex'];
				$cni = $personValue['cni'];
				$phone = $personValue['phone'];
				
				$sql = "SELECT personID, arrived_at, left_at, observation FROM visitors WHERE ( arrived_at BETWEEN '$start:00' AND '$end:00' ) AND personID = $id";
				$visitorsInfos = $visitors->exec($sql);
				
				foreach ( $visitorsInfos as $visitorValue ) {
					$output .= "<tr><td>$firstname</td><td>$lastname</td><td>$sex</td><td>$cni</td><td>$phone</td>";
					
					$arrived_at = $visitorValue['arrived_at'];
					$left_at = $visitorValue['left_at'];
					$observation = $visitorValue['observation'];
					
					$output .= "<td>$arrived_at</td><td>$left_at</td><td>$observation</td></tr>";
				}
			}
			
			$output .= '</table>';
			$reports->add(array('generated_at', 'access_path', 'start_at', 'end_at'), array($generated_at, 'download', $start, $end));
			
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			echo $output;
			
			exit();
		}
	}
}
