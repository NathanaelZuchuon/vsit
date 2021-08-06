<nav id="nav-bar">
        <div id="logo">
            <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/vsit-logo.svg">
        </div>
        <div></div>
        <div id="profile">
            <img src="http://127.0.0.1/bhent_prods/vsit/public/assets/icons/dashboard-icon.jpg">
            <div id="infos">
                <span><b><?php echo ucwords($infos['firstname'] . ' ' . $infos['lastname']);?></b></span>
                <span><?php if ( $infos['role'] == 'guard') echo 'Agent de sécurité'; else echo 'Manager'; ?></span>
            </div>
        </div>
    </nav>
