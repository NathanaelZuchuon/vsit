<aside id="side-bar">
        <div id="title">OPERATIONS</div>
        <div class="operations" id="add-visitor">
            <div class="operations-box">
                <i class="fa fa-plus"></i>
                <span>Ajouter un visiteur</span>
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>
        <div class="operations" id="show-visitors">
            <div class="operations-box">
                <i class="fa fa-user"></i>
                <span>Voir les visites du jour</span>
            </div>
            <i class="fa fa-chevron-right"></i>
        </div>
        <?php if ( $infos['role'] == 'manager' ) { ?>
            
            <form action="http://127.0.0.1/bhent_prods/vsit/dashboard/generateReport" method="post">
                <button class="operations" id="generate-report" type="submit">
                    <div class="operations-box">
                        <i class="fa fa-file-csv"></i>
                        <span>Générer le rapport</span>
                    </div>
                    <i class="fa fa-chevron-right"></i>
                </button>
            </form><?php } ?>
    
    </aside>
