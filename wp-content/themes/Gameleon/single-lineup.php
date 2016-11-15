<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
PAGE TEMPLATE- WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

get_header();
?>
<link rel='stylesheet' id='gaming-css'  href='<?php echo get_bloginfo('template_directory').'/css/gaming.css'; ?>' type='text/css' media='all' />
<?php
$post = get_post();

/***********************
GET THE SINGLE PAGE lineup
*************************/
$pods_lineup_params = array(
    'limit' => 1,
    'where' => 'ID="'.$post->ID.'"',
);

$pods_lineups = pods('lineup',$pods_lineup_params);

if ($pods_lineups->total() > 0) {
    $lineups = $pods_lineups->export_data();
    foreach ($lineups as $key => $lineup){

    }
}

//If no lineup find, no way to go further, just die there
if (!isset($lineup) || empty($lineup)){
    die();
}

/***********************
GET ALL joueur RELATED TO THE PAGE lineup
*************************/
$pods_joueurs_params = array(
    'limit' => -1,
    'where' => 'line_up.id="'.$post->ID.'"',
);

$pods_joueurs = pods('joueur',$pods_joueurs_params);

if ($pods_joueurs->total() > 0) {
    $joueurs = $pods_joueurs->export_data();
}

/***********************
GET ALL resultat RELATED TO THE PAGE lineup
*************************/
$pods_resultats_params = array(
    'limit' => -1,
    'where' => 'line_up.id="'.$post->ID.'"',
);

$pods_resultats = pods('resultat',$pods_resultats_params);

if ($pods_resultats->total() > 0) {
    $resultats = $pods_resultats->export_data();
}

?>

<div id="content" class="grid col-1060">

    <div class="td-content-inner">

        <div class="widget-title">
            <h1><?php the_title(); ?></h1>
        </div>


        <div class="td-wrap-content">
            <?php get_gameleon_breadcrumb_lists(); ?>

                <?php if (isset($lineup['description']) && !empty($lineup['description']) ){?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="post-entry">
                            <div class="td-fly-in">
                                <div class="saboxplugin-wrap" style="padding:10px">
                                    <?php echo $lineup['description']; ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div><?php // end of td-fly-in ?>
                        </div><?php // end of post-entry ?>
                    </div><?php // end of #post id ?>
                <?php } ?>

                <!-- Displaying Line-up related game -->
                <?php if (isset($lineup['jeux']) && !empty($lineup['jeux']) ){?>
                    <div id="line_up_jeu" class="gaming-section">
                        <div class="gaming-title">
                            <h2>Jeu</h2>
                        </div>
                        <div class="gaming-content">
                            <?php
                            foreach ($lineup['jeux'] as $id_jeux => $jeu){
                                ?>
                                <div class="saboxplugin-wrap">
                                    <div class="saboxplugin-gravatar">
                                        <img src="<?php echo $jeu['logo']['guid']; ?>" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="">
                                        <div class="post-meta">
                                            <span class="cat-links"><a href="<?php echo $jeu['guid']; ?>" rel="category tag"><?php echo $jeu['nom']; ?></a></span>
                                        </div>
                                    </div>
                                    <div class="saboxplugin-authorname">
                                        <a href="<?php echo $jeu['guid']; ?>"><?php echo $jeu['nom']; ?></a>
                                    </div>
                                    <div class="saboxplugin-desc">

                                        <?php echo $jeu['description']; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="saboxplugin-socials "></div>
                                </div>
                                <?php
                            }

                             ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- End of displaying Line-up related game -->

                <!-- Displaying Line-up related players -->
                <?php if (isset($joueurs) && !empty($joueurs) ){?>
                    <div id="composition_line_up" class="gaming-section">
                        <div class="gaming-title">
                            <h2>Composition de la line-up</h2>
                        </div>
                        <div class="gaming-content">
                            <?php
                            foreach ($joueurs as $id_joueur => $joueur){
                                //var_dump($joueur);

                                ?>

                                <div class="saboxplugin-wrap player-desc" style="cursor:pointer" >
                                    <div class="saboxplugin-gravatar">
                                        <?php if (isset($joueur['avatar']) && !empty($joueur['avatar']) ){?>
                                            <img src="<?php echo $joueur['avatar']['guid']; ?>" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="">
                                        <?php } else {?>
                                            <img src="http://alpha-project.fr/wp-content/uploads/2016/10/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="defaut">
                                        <?php } ?>

                                    </div>
                                    <div class="saboxplugin-authorname">
                                        <div class="player-name"><?php echo $joueur['pseudonyme']; ?>
                                            <?php if (isset($joueur['pays'])){
                                                switch($joueur['pays']){
                                                    case 'France':
                                                        echo '<img src="'.get_bloginfo('template_directory').'/images/flags/France.png'.'" width="20px" height="15px" alt="France">';
                                                        break;
                                                    case 'Suisse':
                                                        echo '<img src="'.get_bloginfo('template_directory').'/images/flags/Suisse.png'.'" width="20px" height="15px" alt="Suisse">';
                                                        break;
                                                    case 'Belgique':
                                                        echo '<img src="'.get_bloginfo('template_directory').'/images/flags/Belgique.png'.'" width="20px" height="15px" alt="Belgique">';
                                                        break;
                                                    case 'Canada':
                                                        echo '<img src="'.get_bloginfo('template_directory').'/images/flags/Canada.png'.'" width="20px" height="15px" alt="Canada">';
                                                        break;
                                                    default :
                                                        //do nothing
                                                        break;
                                                }

                                             } ?>
                                             <span style="font-size:8px">Voir plus</span>
                                        </div>
                                    </div>
                                    <div class="saboxplugin-desc" style="display:none;">
                                        <table class="player-details" style="max-width:80%">
                                            <tr>
                                              <th>Prénom</th>
                                              <th>Age</th>
                                              <th>Ville</th>
                                              <th>Map préférée</th>
                                              <th>Personnage préféré</th>
                                              <th>Poste</th>
                                              <th>Biographie</th>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <?php if (isset($joueur['prenom']) && !empty($joueur['prenom']) ){?>
                                                            <?php echo $joueur['prenom']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['age']) && !empty($joueur['age']) ){?>
                                                            <?php echo $joueur['age']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['ville']) && !empty($joueur['ville']) ){?>
                                                        <?php echo $joueur['ville']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['carte_favorite']) && !empty($joueur['carte_favorite']) ){?>
                                                        <?php echo $joueur['carte_favorite']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['personnage_favori']) && !empty($joueur['personnage_favori']) ){?>
                                                        <?php echo $joueur['personnage_favori']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['position']) && !empty($joueur['position']) ){?>
                                                        <?php echo $joueur['position']; ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($joueur['bio']) && !empty($joueur['bio']) ){?>
                                                            <?php echo $joueur['bio']; ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="saboxplugin-socials "></div>
                                </div>
                                <?php
                            }

                             ?>
                        </div>
                    </div>
                <?php } ?>
                <!-- End of displaying Line-up related players -->

                <!-- Displaying Line-up related results -->
                <?php if (isset($resultats) && !empty($resultats) ){?>
                    <div id="resultats_line_up" class="gaming-section">
                        <div class="gaming-title">
                            <h2>Resultats de la lineup</h2>
                        </div>
                        <div class="gaming-content">
                            <div class="saboxplugin-wrap" style="cursor:pointer; padding:20px;" >
                                <table class="team-results">
                                  <tr>
                                    <th>Nom du tournois</th>
                                    <th>Jeu concerné</th>
                                    <th>Résultat</th>
                                    <th>Date</th>
                                  </tr>

                                  <?php
                                  foreach ($resultats as $id_resultat => $resultat){
                                      ?>
                                      <tr>
                                        <td>
                                            <?php
                                            if (isset($resultat['url_tournois']) && !empty($resultat['url_tournois'])){
                                                echo '<a href="'.$resultat['url_tournois'].'">'.$resultat['nom_du_tournois'].'</a>';
                                            }
                                            else {
                                                echo $resultat['nom_du_tournois'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($resultat['jeu']) && !empty($resultat['jeu'])){
                                                foreach ($resultat['jeu'] as $key => $jeu){
                                                    echo '<div class="post-meta">
                                                        <span class="cat-links"><a href="'.$jeu['guid'].'" rel="category tag">'.$jeu['nom'].'</a></span>
                                                    </div>';
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $resultat['resultat'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($resultat['date_tournois']) && !empty($resultat['date_tournois'])){
                                                echo $resultat['date_tournois'];
                                            }
                                            ?>
                                        </td>
                                      </tr>
                                  <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- End of displaying Line-up related results -->

            </div><?php // end of td-wrap-content / ?>
        </div><?php // end of td-content-inner / ?>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('.player-desc').click(function(){
                    if (jQuery(this).find('.saboxplugin-desc').is(':visible')){
                        jQuery(this).find('.saboxplugin-desc').toggle( "slow" );
                    }
                    else {
                        jQuery(this).find('.saboxplugin-desc').toggle( "slow" );
                    }
                });
            });
        </script>

        <div class="td-single-page-wrap clearfix">
            <?php comments_template( '', true ); ?>
        </div>

        <?php
        // ----------- pagination
        // ---------------------------------------------------------------------------
        ?>

        <?php get_template_part( 'loop-nav' ); ?>

    </div><?php // end of main-wrapper ?>

    <?php get_footer(); ?>
