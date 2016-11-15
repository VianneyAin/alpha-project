<?php
/*
Template Name: Gaming Template
*/

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
?>

<div id="content" class="grid col-1060">

    <div class="td-content-inner">

        <div class="widget-title">
            <h1><?php the_title(); ?></h1>
        </div>


        <div class="td-wrap-content">
            <?php get_gameleon_breadcrumb_lists(); ?>

            <?php if( have_posts() ) : ?>
                <?php while( have_posts() ) : the_post(); ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="post-entry">
                            <div class="td-fly-in">
                                <div class="saboxplugin-wrap" style="padding:10px">
                                    <?php the_content( __( 'Read More...', 'gameleon' ) ); ?>
                                    <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'gameleon' ), 'after' => '</div>' ) ); ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div><?php // end of td-fly-in ?>
                        </div><?php // end of post-entry ?>
                    </div><?php // end of #post id ?>
                <?php endwhile; endif; ?>

                <div id="lineup" class="gaming-section">
                    <div class="gaming-title">
                        <h2>Nos Line ups</h2>
                    </div>
                    <div class="gaming-content">

                        <?php
                        $pods_lineup_params = array(
                            'limit' => -1,
                            'orderby' => 'nom ASC'
                        );

                        $pods_lineups = pods('lineup',$pods_lineup_params);

                        if ($pods_lineups->total() > 0) {
                            $lineups = $pods_lineups->export_data();
                        }


                        if (isset($lineups) && !empty($lineups)){
                            foreach($lineups as $key => $lineup){
                                ?>
                                <div class="saboxplugin-wrap">
                                    <div class="saboxplugin-gravatar">
                                        <img src="<?php echo $lineup['logo']['guid']; ?>" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="">
                                        <div class="post-meta">
                                            <?php
                                            foreach($lineup['jeux'] as $jeu_id => $jeu){
                                                ?>
                                                <span class="cat-links"><a href="<?php echo $jeu['guid']; ?>" rel="category tag"><?php echo $jeu['nom']; ?></a></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="saboxplugin-authorname">
                                        <a href="<?php echo $lineup['guid']; ?>"><?php echo $lineup['nom']; ?></a>
                                    </div>
                                    <div class="saboxplugin-desc">

                                        <?php echo $lineup['description']; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="saboxplugin-socials "></div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div id="resultats" class="gaming-section">
                    <div class="gaming-title">
                        <h2>Résultats</h2>
                    </div>
                    <div class="gaming-content" style="padding:20px;">
                        <?php
                        /***********************
                        GET ALL resultat RELATED TO THE PAGE lineup
                        *************************/
                        $pods_resultats_params = array(
                            'limit' => -1,
                        );

                        $pods_resultats = pods('resultat',$pods_resultats_params);

                        if ($pods_resultats->total() > 0) {
                            $resultats = $pods_resultats->export_data();
                        }

                        if (isset($resultats) && !empty($resultats)){
                            ?>
                            <table class="teams-results">
                              <tr>
                                <th>Nom de la line-up</th>
                                <th>Nom du tournois</th>
                                <th>Jeu</th>
                                <th>Résultat</th>
                                <th>Date</th>
                              </tr>

                            <?php
                            foreach($resultats as $key => $resultat){
                                ?>


                                      <tr>
                                      <td>
                                          <?php
                                            foreach ($resultat['line_up'] as $key => $line_up) {
                                                echo '<a href="'.$lineup['guid'].'">'.$lineup['nom'].'</a>';
                                            }
                                          ?>
                                      </td>
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
                                <?php
                            }
                            ?>
                          </table>
                          <?php
                        }
                        ?>
                    </div>
                </div>

                <div id="demande_de_match" class="gaming-section">
                    <div class="gaming-title">
                        <h2>Demande de match</h2>
                    </div>
                    <div class="gaming-content">
                        <?php
                        $demande_de_match = get_field( "demande_de_match", $post->ID);
                        echo $demande_de_match;
                        ?>
                    </div>
                </div>

                <div id="nous_rejoindre" class="gaming-section">
                    <div class="gaming-title">
                        <h2>Nous rejoindre</h2>
                    </div>
                    <div class="gaming-content">
                        <?php
                        $nous_rejoindre = get_field( "nous_rejoindre", $post->ID);
                        echo $nous_rejoindre;
                        ?>
                    </div>
                </div>

            </div><?php // end of td-wrap-content / ?>
        </div><?php // end of td-content-inner / ?>

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
