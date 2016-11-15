<?php

// If this file is called directly, busted!
if( !defined( 'ABSPATH' ) ) {
    exit;
}

/*----------------------------------------------------------------------------------------------------------
PAGE TEMPLATE- WE USE PHP COMMENTS INSTEAD OF HTML, TO REDUCE THE PAGE SIZE.
-----------------------------------------------------------------------------------------------------------*/

get_header();
$post = get_post();
$pods_jeu_params = array(
    'limit' => 1,
    'where' => 'ID="'.$post->ID.'"',
);

$pods_jeux = pods('jeu', $pods_jeu_params);

if ($pods_jeux->total() > 0) {
    $jeux = $pods_jeux->export_data();
    foreach ($jeux as $key => $jeu){
        ?>
        <div id="content" class="grid col-1060">

            <div class="td-content-inner">
                <?php if (isset($jeu['header']) && !empty($jeu['header'])){
                    ?>
                    <div class="featured-image">
                        <a class="td-popup-image" title="<?php echo $jeu['nom']; ?>" rel="bookmark">
                            <img width="664" height="445" src="<?php echo $jeu['header']['guid']; ?>" class="aligncenter wp-post-image" alt="<?php echo $jeu['nom']; ?>" >
                        </a>
                    </div>
                    <?php
                }
                ?>
                <div class="widget-title">
                    <h1><?php the_title(); ?></h1>
                </div>

                <div class="td-wrap-content">
                    <?php get_gameleon_breadcrumb_lists(); ?>

                    <?php if (isset($jeu['description']) && !empty($jeu['description']) ){?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="post-entry">
                                <div class="td-fly-in">
                                    <div class="saboxplugin-wrap" style="padding:10px">
                                        <?php echo $jeu['description']; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><?php // end of td-fly-in ?>
                            </div><?php // end of post-entry ?>
                        </div><?php // end of #post id ?>
                        <?php
                    }
                    ?>

                </div>

                <style>
                /* A METTRE DANS UN FICHIER CSS A PART QUAND CE SERA COMPLET */
                .gaming-section {
                    margin-top:20px;
                }

                .gaming-section .gaming-title {
                    background-color:#FF3C1F;
                    color:white;
                    padding:10px 0px 10px 10px;
                }

                .gaming-section .gaming-title h2 {
                    color:white;
                }
                </style>


                <div id="related_articles" class="gaming-section">
                    <div class="gaming-title">
                        <h2>Articles</h2>
                    </div>
                    <div class="gaming-content" style="margin:10px;">
                        <?php
                        // get "orderby" option
                        $post_orderby_filter = gameleon_get_option( 'td_blog_orderby' );
                        // get "order" option
                        $post_order_filter = gameleon_get_option( 'td_blog_order' );
                        // meta_key
                        $td_metakey = 'post_views_count';


                        global $wp_query, $paged;
                        if( get_query_var( 'paged' ) ) {
                            $paged = get_query_var( 'paged' );
                        } elseif( get_query_var( 'page' ) ) {
                            $paged = get_query_var( 'page' );
                        } else {
                            $paged = 1;
                        }

                        // exclude posts option
                        $exclude_from_all_posts = gameleon_get_option( 'td_blog_exclude' );
                        $exclude_from_all_posts = explode(',',$exclude_from_all_posts); //break the string into array keys
                        $args = array(
                            'posts_per_page'   => 5,
                            'offset'           => 0,
                            'category_name'    => $jeu['categorie']['slug'],
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'post_status'      => 'publish',
                            'suppress_filters' => true
                        );
                        $blog_query = new WP_Query( $args );
                        $temp_query = $wp_query;
                        $wp_query = null;
                        $wp_query = $blog_query;

                        $td_trimmed_title_blog = 20;

                        ?>

                        <div class="td-wrap-content">

                            <?php if( $blog_query->have_posts() ) : while( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="post-entry" style="padding-top:30px;">
                                        <div class="td-fly-in">


                                            <h3 class="entry-title">
                                                <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                                    <?php echo wp_trim_words( get_the_title(), $td_trimmed_title_blog ); ?>
                                                </a>
                                            </h3>

                                            <?php get_template_part( 'post-single-meta' ); ?>

                                            <?php get_template_part( 'post-img-blog-index' ); // post image ?>

                                            <div class="td-post-excerpt">
                                                <?php echo display_excerpt_properly(apply_filters( 'the_excerpt',  get_the_excerpt() )); ?>
                                            </div>
                                        </div><?php // end of td-fly-in ?>
                                    </div><?php // end of post-entry ?>
                                </div><?php // end of #post id ?>

                            <?php endwhile; endif; ?>

                        </div><?php // end of td-wrap-content / ?>
                    </div><?php // end of td-content-inner / ?>
                    <div style="margin-left:20%;">
                        <a class="blog-excerpt button" href="<?php echo get_category_link($jeu['categorie']['term_id']); ?>" style="color: white;width: 50%;">
                            <h3 style="text-align: center;color: white;">Voir tous les articles de <br><?php echo $jeu['nom']; ?></h3>
                        </a>
                    </div>
                    <?php
                    // ----------- pagination
                    // ---------------------------------------------------------------------------
                    ?>

                </div>
                <?php
                //*****************************************************************************************************************
                //******************************************************* LINE UP *************************************************
                //*****************************************************************************************************************

                $pods_lineup_params = array(
                    'limit' => -1,
                    'where' => 'jeux.categorie.term_id="'.$jeu['categorie']['term_id'].'"',
                    'orderby' => 'nom ASC'
                );

                $pods_lineups = pods('lineup',$pods_lineup_params);

                if ($pods_lineups->total() > 0) {
                    $lineups = $pods_lineups->export_data();
                }
                if (isset($lineups) && !empty($lineups)){
                    ?>
                    <div id="lineup" class="gaming-section">
                        <div class="gaming-title">
                            <h2>Les Line-ups <?php echo $jeu['nom']; ?></h2>
                        </div>
                        <div class="gaming-content">
                            <?php
                            foreach($lineups as $key => $lineup){
                                ?>
                                <div class="saboxplugin-wrap">
                                    <div class="saboxplugin-gravatar">
                                        <img src="<?php echo $lineup['logo']['guid']; ?>" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="">
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
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
                //*****************************************************************************************************************
                //***************************************************** STREAMEUR *************************************************
                //*****************************************************************************************************************

                $pods_streameur_params = array(
                    'limit' => -1,
                    'where' => 'jeux.categorie.term_id="'.$jeu['categorie']['term_id'].'"',
                    'orderby' => 'nom ASC'
                );

                $pods_streameurs = pods('streameur',$pods_streameur_params);

                if ($pods_streameurs->total() > 0) {
                    $streameurs = $pods_streameurs->export_data();
                }
                if (isset($streameurs) && !empty($streameurs)){
                    ?>
                    <div id="streameur" class="gaming-section">
                        <div class="gaming-title">
                            <h2>Les Streameurs <?php echo $jeu['nom']; ?></h2>
                        </div>
                        <div class="gaming-content">
                            <?php
                            foreach($streameurs as $key => $streameur){
                                ?>
                                <div class="saboxplugin-wrap">
                                    <div class="saboxplugin-gravatar">
                                        <img src="<?php echo $streameur['avatar']['guid']; ?>" class="avatar user-5-avatar avatar-100 photo" width="100" height="100" alt="">
                                    </div>
                                    <div class="saboxplugin-authorname">
                                        <a href="<?php echo $streameur['guid']; ?>"><?php echo $streameur['nom']; ?></a>
                                    </div>
                                    <div class="saboxplugin-desc">
                                        <?php echo $streameur['description']; ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="saboxplugin-socials "></div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div><?php // end of td-wrap-content / ?>
        </div><?php // end of td-content-inner / ?>

        <?php
        // ----------- pagination
        // ---------------------------------------------------------------------------
        ?>


    </div><?php // end of main-wrapper ?>
    <?php
}
}
else {
    header("Location: http://alpha-project.fr");
}
?>


<?php get_footer(); ?>
