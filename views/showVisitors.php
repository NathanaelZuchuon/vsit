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
	<?php include __DIR__ . '/../views/head.php'; ?>
    <title>Dashboard | VSIT</title>
    <link rel="stylesheet" href=<?=$host . "public/assets/css/dashboard.css"?>>
    <link rel="stylesheet" href=<?=$host . "public/assets/css/showVisitors.css"?>>
</head>

<body>
    <?php include __DIR__ . '/../views/cursor.php'; ?>

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
                    <div class="operations-box active">
                        <div class="operations-box-icon">
                            <i class="fa fa-calendar-day"></i>
                        </div>
                        <span id="showVisitors">Voir les visites du jour</span>
                    </div>
                    <?php if ( $_SESSION['role'] == 'manager' ) { ?>
    
                        <div class="operations-box">
                            <div class="operations-box-icon">
                                <i class="fa fa-file-excel"></i>
                            </div>
                            <span id="generate-report"><a href=<?=$host . "dashboard/makeReportView"?>>Générer le rapport</a></span>
                        </div>

                        <div class="operations-box">
                            <div class="operations-box-icon">
                                <i class="fa fa-user-shield"></i>
                            </div>
                            <span id="put-manager"><a href=<?=$host . "dashboard/putManagerView"?>>Mettre manager</a></span>
                        </div>
                    <?php } ?>
    
                </div>
    
                <div id="infos">
                    <div class="infos-box">
                        <div class="infos-box-icon">
                            <img src=<?=$host . "public/assets/icons/dashboard-icon.jpg"?>>
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
            <i class="fa fa-chevron-circle-left chevron" id="chevron-left"></i>
            
            <div id="slider"></div>
            
            <i class="fa fa-chevron-circle-right chevron" id="chevron-right"></i>
        </section>
    
    </main>

    <script src=<?=$host . "public/assets/js/showVisitors.js"?>></script>
    <script src=<?=$host . "public/assets/js/dashboard.js"?>></script>
    <?php include __DIR__ . '/../views/footer.php'; ?>
</body>

</html>
