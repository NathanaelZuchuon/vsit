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
    <link rel="stylesheet" href=<?="http://vsit.bhent.org/" . "public/assets/css/dashboard.css"?>>
    <link rel="stylesheet" href=<?="http://vsit.bhent.org/" . "public/assets/css/removeVisitorFromStack.css"?>>
</head>

<body>
    <?php include __DIR__ . '/../views/cursor.php'; ?>
    
    <main>
        <aside>
            <img src=<?="http://vsit.bhent.org/" . "public/assets/icons/vsit-logo.svg"?>>
    
            <div id="wrapper">
    
                <div id="operations">
                    <div class="operations-box">
                        <div class="operations-box-icon">
                            <i class="fa fa-plus"></i>
                        </div>
                        <span id="addVisitor"><a href=<?="http://vsit.bhent.org/" . "dashboard/addVisitorInStackView"?>>Ajouter un visiteur dans la file</a></span>
                    </div>
                    <div class="operations-box active">
                        <div class="operations-box-icon">
                            <i class="fa fa-minus"></i>
                        </div>
                        <span id="removeVisitor">Le retirer de la file</span>
                    </div>
                    <div class="operations-box">
                        <div class="operations-box-icon">
                            <i class="fa fa-calendar-day"></i>
                        </div>
                        <span id="showVisitors"><a href=<?="http://vsit.bhent.org/" . "dashboard/showVisitorsView"?>>Voir les visites du jour</a></span>
                    </div>
                    <?php if ( $_SESSION['role'] == 'manager' ) { ?>
    
                        <div class="operations-box">
                            <div class="operations-box-icon">
                                <i class="fa fa-file-excel"></i>
                            </div>
                            <span id="generate-report"><a href=<?="http://vsit.bhent.org/" . "dashboard/makeReportView"?>>Générer le rapport</a></span>
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
            <form id="form" method="post" autocomplete="off">
                <input type="number" id="cni" name="cni" required placeholder="Entrer le n° de sa CNI">
                <button type="submit" id="btn">Retirer<i class="fa fa-minus"></i></button>
            </form>
        </section>
    
    </main>

    <script src=<?="http://vsit.bhent.org/" . "public/assets/js/removeVisitorFromStack.js"?>></script>
    <script src=<?="http://vsit.bhent.org/" . "public/assets/js/dashboard.js"?>></script>
    <script src=<?="http://vsit.bhent.org/" . "public/assets/js/cursor.js"?>></script>
    <?php include __DIR__ . '/../views/footer.php'; ?>
</body>

</html>
