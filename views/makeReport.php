<?php
function userInfos () : string {
	$output = ucwords($_SESSION['firstname'] . ' ' . $_SESSION['lastname'] );
	$output .= ' - ';
	$output .= ( $_SESSION['role'] == 'manager') ? 'Manager' : 'Agent de sécurité';
	
	return $output;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '\..\views\head.php'; ?>
	<title>Dashboard | VSIT</title>
	<link rel="stylesheet" href=<?=$host . "public/assets/css/dashboard.css"?>>
	<link rel="stylesheet" href=<?=$host . "public/assets/css/makeReport.css"?>>
</head>

<body>
    <?php include __DIR__ . '\..\views\cursor.php'; ?>
    
    <main>
        <aside>
            <img src=<?=$host . "public/assets/icons/vsit-logo.svg"?>>
    
            <div id="wrapper">
    
                <div id="operations">
                    <div class="operations-box">
                        <div class="operations-box-icon">
                            <i class="fa fa-plus"></i>
                        </div>
                        <span id="addVisitor"><a href=<?=$host . "dashboard/addVisitorInStackView"?>>Ajouter un visiteur dans la file</a></span>
                    </div>
                    <div class="operations-box">
                        <div class="operations-box-icon">
                            <i class="fa fa-minus"></i>
                        </div>
                        <span id="removeVisitor"><a href=<?=$host . "dashboard/removeVisitorFromStackView"?>>Le retirer de la file</a></span>
                    </div>
                    <div class="operations-box">
                        <div class="operations-box-icon">
                            <i class="fa fa-calendar-day"></i>
                        </div>
                        <span id="showVisitors"><a href=<?=$host . "dashboard/showVisitorsView"?>>Voir les visites du jour</a></span>
                    </div>
                    <?php if ( $_SESSION['role'] == 'manager' ) { ?>
    
                        <div class="operations-box active">
                            <div class="operations-box-icon">
                                <i class="fa fa-file-excel"></i>
                            </div>
                            <span id="generate-report">Générer le rapport</span>
                        </div>
                    <?php } ?>
    
                </div>
    
                <div id="infos">
                    <div class="infos-box">
                        <div class="infos-box-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <span id="user-info"><?php echo userInfos(); ?></span>
                    </div>
                    <div class="infos-box">
                        <div class="infos-box-icon">
                            <i class="fa fa-door-open"></i>
                        </div>
                        <span id="logout">Déconnexion</span>
                    </div>
                </div>
    
            </div>
        </aside>
    
        <section id="content">
            <form id="form" autocomplete="off" method="post">
                <input type="datetime-local" id="start_at" name="start_at" required>
                <input type="datetime-local" id="end_at" name="end_at" required>
                <button id="btn" type="submit">Télécharger<i class="fa fa-file-download"></i></button>
            </form>
        </section>
    
    </main>

    <script src=<?=$host . "public/assets/js/makeReport.js"?>></script>
    <script src=<?=$host . "public/assets/js/dashboard.js"?>></script>
    <script src=<?=$host . "public/assets/js/cursor.js"?>></script>
	<?php include __DIR__ . '\..\views\footer.php'; ?>
</body>

</html>
