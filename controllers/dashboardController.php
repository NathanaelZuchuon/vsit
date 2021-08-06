<?php

include_once __DIR__ . '\..\models\dashboardUsersModel.php';
include_once __DIR__ . '\..\models\dashboardPersonsModel.php';
include_once __DIR__ . '\..\models\dashboardVisitorsModel.php';

$users = new dashboardUsersModel();
$persons = new dashboardPersonsModel();
$visitors = new dashboardVisitorsModel();

class dashboardController extends Controller {
	
	public function def () {
		if ( count($_SESSION) == 0 ) {
			header("Location: http://127.0.0.1/bhent_prods/vsit/home");
		} else {
			$this->dashboardView();
		}
	}
	
	private function dashboardView () {
		include __DIR__ . '\..\views\dashboard.php';
	}
	
	public function generateReport () {
		global $persons;
		global $visitors;
		
		$personsInfos = $persons->infos(array("*"));
		
		$filename = 'rapport_du_' . date("Y_m_d") . '.xls';
		
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		$output = '<table>
			<tr>
					<th>Name</th>
					<th>Surname</th>
					<th>Sex</th>
					<th>CNI</th>
					<th>Phone</th>
					<th>Arrived at</th>
					<th>Left at</th>
					<th>Observation</th>
			</tr>';
		
		foreach ( $personsInfos as $personValue ) {
			
			$firstname = $personValue['firstname'];
			$lastname = $personValue['lastname'];
			$sex = $personValue['sex'];
			$cni = $personValue['cni'];
			$phone = $personValue['phone'];
			
			$output .= "<tr>
					<td>$firstname</td>
					<td>$lastname</td>
					<td>$sex</td>
					<td>$cni</td>
					<td>$phone</td>";

			$visitorsInfos = $visitors->infos(array("arrived_at", "left_at", "observation"), array("personID = '" . $personValue['id'] . "'"));

			foreach ( $visitorsInfos as $visitorValue) {
				$arrived_at = $visitorValue['arrived_at'];
				$left_at = $visitorValue['left_at'];
				$observation = $visitorValue['observation'];
				
				$output .= "
					<td>$arrived_at</td>
					<td>$left_at</td>
					<td>$observation</td>
				</tr>";
				
				$output .= "<tr>
					<td>$firstname</td>
					<td>$lastname</td>
					<td>$sex</td>
					<td>$cni</td>
					<td>$phone</td>";
			}
		}
		
		$output .= '</table>';
		echo $output;
		
		exit();
	}
	
	public function addVisitor () {
		global $users;
		global $persons;
		global $visitors;
		
		$firstname = $_POST['firstname'];
	    $lastname = $_POST['lastname'];
	    $sex = $_POST['sex'];
	    $cni = $_POST['cni'];
		$phone = $_POST['phone'];
		$left_at = $_POST['left_at'];
		$arrived_at = $_POST['arrived_at'];
		$observation = $_POST['observation'];
		
		if ( !$persons->existenceCheck(array('cni'), array("cni = '$cni'")) ) {
			$persons->add(array('firstname', 'lastname', 'sex', 'cni', 'phone', 'timestamp'), array($firstname, $lastname, $sex, $cni, $phone, $arrived_at));
		}
		
		$cni_user = $_POST['cni_user'];
		$personID = $persons->id(array("cni = '$cni'"));
		$userID = $users->id(array("cni = '$cni_user'"));
		
		$visitors->add(array('personID', 'userID', 'arrived_at', 'left_at', 'observation'), array($personID, $userID, $arrived_at, $left_at, $observation));
		
	}
	
	public function showVisitors () {
		global $persons;
		global $visitors;
		
		$personsInfos = $persons->infos(array('id', 'firstname', 'lastname', 'sex', 'cni', 'phone'));
		
		foreach ( $personsInfos as $values ) {
			$firstname = $values['firstname'];
			$lastname = $values['lastname'];
			$sex = $values['sex'] == 'male' ? 'Homme' : 'Femme';
			$cni = $values['cni'];
			$phone = $values['phone'];
			$id = $values['id'];
			
			$visitorsInfos = $visitors->infos(array('arrived_at', 'left_at'), array("personID = $id"));
			
			echo "
			<div class='board-box'>
			    <div class='field''>
			        <span>Nom:</span>
			        <span>$firstname</span>
			    </div>
			    <div class='field'>
			        <span>Prénom:</span>
			        <span>$lastname</span>
			    </div>
			    <div class='field'>
			        <span>Sexe:</span>
			        <span>$sex</span>
			    </div>
			    <div class='field'>
			        <span>N° de la CNI:</span>
			        <span>$cni</span>
			    </div>
			    <div class='field'>
			        <span>Numéro:</span>
			        <span>$phone</span>
			    </div>
";
			foreach ( $visitorsInfos as $values ) {
				$arrived_at = $values['arrived_at'];
				$left_at = $values['left_at'];
				
				echo "
				<div class='field datetime'>
			        <span>Heure d'arrivée:</span>
			        <span>$arrived_at</span>
			    </div>
			    <div class='field datetime'>
			        <span>Heure de départ:</span>
			        <span>$left_at</span>
			    </div>
			";
			}
			
			echo "</div>";
		}
		
	}
}
