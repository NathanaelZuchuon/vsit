<?php
$infos = $_SESSION;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include __DIR__ . '\..\views\head.php'; ?>
    <title>Dashboard | VSIT</title>
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/dashboard-navbar.css">
    <link rel="stylesheet" href="http://127.0.0.1/bhent_prods/vsit/public/assets/css/dashboard-sidebar.css">
</head>

<body>

    <span id="cni-user"><?=$infos['cni'];?></span>
    
    <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/loader.gif" id="loader">

    <?php include __DIR__ . '\..\views\cursor.php'; ?>
    
    <?php include __DIR__ . '\..\views\dashboard-navbar.php'; ?>

    <?php include __DIR__ . '\..\views\dashboard-sidebar.php'; ?>
    
    <main id="main">
        <form autocomplete="off" autofocus method="post" id="form">
            <input type="text" name="firstname" id="firstname" required placeholder="Entrer son nom">
            <input type="text" name="lastname" id="lastname" required placeholder="Entrer son prénom">
            <select name="sex" id="sex">
                <option value="male">Homme</option>
                <option value="female">Femme</option>
            </select>
            <input type="text" name="cni" id="cni" required placeholder="Entrer le n° de sa CNI">
            <input type="number" name="phone" id="phone" required placeholder="Entrer son numéro">
            <input type="datetime-local" name="arrived_at" id="arrived_at" required placeholder="Heure d'arrivée">
            <input type="datetime-local" name="left_at" id="left_at" required placeholder="Heure de départ">
            <textarea type="text" name="observation" id="observation" required placeholder="Différentes observations"></textarea>
            <button type="submit" id="btn">Ajouter <i class="fa fa-plus"></i></button>
        </form>
        <div id="board">
            <?php include __DIR__ . '\..\views\showVisitors.php';?>
        
        </div>
    </main>

    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/dashboard.js"></script>
    <script src="http://127.0.0.1/bhent_prods/vsit/public/assets/js/cursor.js"></script>
    <?php include __DIR__ . '\..\views\footer.php'; ?>
</body>

</html>
