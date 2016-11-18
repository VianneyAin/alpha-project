<?php
class Home_Articles_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('home_articles', '[ALPHA PROJECT] Home Articles', array('description' => 'Affiche les listes des derniers articles sur la homepage'));
    }

    /*----------------------------------------------------------------------------------------------------------
    Front-end display of widget
    -----------------------------------------------------------------------------------------------------------*/
    public function widget( $args, $instance ) {
    	extract( $args );
    	$title            		= apply_filters( 'widget_title', $instance['title'] );
    	$orderby 				= apply_filters ( 'orderby', isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '' );
        $number_of_posts        = $instance['number_of_posts'];
    	$readmore          		= $instance['readmore'];
    	$bigexcerpt 			= $instance['bigexcerpt'];
    	$smallexcerpt       	= $instance['smallexcerpt'];
    	$td_trim_title_small	= $instance['td_trim_title_small'];
    	$td_trim_title_big		= $instance['td_trim_title_big'];
    	$post_type          	= 'all';
    	$categories 			= $instance['categories'];
    	$show_post_meta			= ! empty( $instance['show_post_meta'] ) ? '1' : '0';
    	$show_footer_box 		= ! empty( $instance['show_footer_box'] ) ? '1' : '0';
    	echo $before_widget;
    	?>
    	<?php
    	$post_types = get_post_types();
    	unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
    	if( $post_type == 'all' ) {
    		$post_type_array = $post_types;
    	} else {
    		$post_type_array = $post_type;
    	}
    	?>
    	<?php // =============================== LEFT BLOCK =============================== ?>
    	<div class="td-content-inner">
    		<div class="widget-title">
    			<h3>
    				<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>"><?php echo $title; ?>
    				</a>
    			</h3>
    		</div>
    		<div class="td-wrap-content">
    			<?php
    			global $wp_query, $paged;
    			$metakey = 'post_views_count';
    			$recent_posts = new WP_Query( array( 'cat' => $categories, 'orderby' => $orderby, 'meta_key' => $metakey, 'posts_per_page' => $number_of_posts ) );
    			$temp_query = $wp_query;
    			$wp_query = null;
    			$wp_query = $recent_posts;
    			?>
    			<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
					<?php
					// ----------- SMALL MODULE
					// ---------------------------------------------------------------------------
					?>
					<div class="td-small-module grid col-970 fit">
						<div class="td-fly-in">
							<div class="td-post-details-2"><?php // td-post-details ?>
								<?php
								// ----------- thumbnails
								// ---------------------------------------------------------------------------
								?>
								<?php //get_template_part( 'post-img-home-modules' ); // big featured image ?>
                                <?php if( has_post_thumbnail() ) {
                                    ?>
                                    <div class="grid-image big-wrap">
                                        <a href="<?php echo get_permalink(); ?>" >
                                            <?php the_post_thumbnail( 'medium' );  ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
								<?php
								// ----------- small title
								// ---------------------------------------------------------------------------
								?>
								<h2 class="td-big-title">
									<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
										<?php echo wp_trim_words( get_the_title(), $td_trim_title_small ); ?>
									</a>
								</h2>
								<?php
								// ----------- small excerpt
								// ---------------------------------------------------------------------------
								?>
								<p>
									<?php echo td_global_excerpt( $smallexcerpt ); ?>
								</p>
								<?php if( $show_post_meta == 1 ): ?>
									<?php get_template_part( 'post-meta' ); // date, views, likes comments?>
								<?php endif; ?>
							</div><?php // end of td-post-details ?>
							<?php
							// -----------  meta
							// ---------------------------------------------------------------------------
							?>
						</div><?php // end of fly-in?>
					</div><?php // end of grid col-340 ?>
    				<?php $counter++; endwhile; ?>
    			</div><?php // end of td-wrap-content ?>
    			<?php
    			// ----------- footer box
    			// ---------------------------------------------------------------------------
    			?>
    			<?php if( $show_footer_box == 1 ): ?>
    				<div class="moregames">
    					<div class="gamesnumber tooltip" title="<?php echo $recent_posts->found_posts; ?> <?php _e( 'articles in this category', 'gameleon' ); ?>">
    						<?php echo $recent_posts->found_posts; ?>
    					</div>
    					<a href="<?php echo esc_url( get_category_link( $categories ) ); ?>">
    						<div class="moregames-link">
    							<?php echo $readmore; ?>
    						</div>
    					</a>
    				</div>
    			<?php endif; ?>
    		</div><?php // end of td-content-inner ?>
            <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('.td-wrap-content').find('.clearfix').each(function(){
                    jQuery(this).remove();
                });
            });
            </script>
    		<?php echo $after_widget;
    	}
    	/*----------------------------------------------------------------------------------------------------------
    	Sanitize widget form values as they are saved
    	-----------------------------------------------------------------------------------------------------------*/
    	public function update( $new_instance, $old_instance ) {
    		$instance = array();
    		$instance 							= $old_instance;
    		$instance['title']                 	= strip_tags( $new_instance['title'] );
    		$instance['orderby'] 				= strip_tags( $new_instance['orderby'] );
            $instance['number_of_posts']        = $new_instance['number_of_posts'];
    		$instance['readmore']             	= $new_instance['readmore'];
    		$instance['bigexcerpt']            	= $new_instance['bigexcerpt'];
    		$instance['smallexcerpt']          	= $new_instance['smallexcerpt'];
    		$instance['td_trim_title_small']	= $new_instance['td_trim_title_small'];
    		$instance['td_trim_title_big']		= $new_instance['td_trim_title_big'];
    		$instance['post_type']             	= 'all';
    		$instance['categories']            	= $new_instance['categories'];
    		$instance['show_post_meta']     	= $new_instance['show_post_meta'];
    		$instance['show_footer_box']       	= $new_instance['show_footer_box'];
    		return $instance;
    	}
    	/*----------------------------------------------------------------------------------------------------------
    	Back-end widget form
    	-----------------------------------------------------------------------------------------------------------*/
    	public function form( $instance ) {
    		$defaults = array(
    			'title'             	=> 'Recent Posts',
    			'readmore'         		=> 'Read More',
    			'orderby'				=> 'date',
    			'bigexcerpt' 			=> '20',
    			'smallexcerpt' 			=> '8',
    			'td_trim_title_small'	=> '2',
    			'td_trim_title_big'		=> '3',
    			'post_type'         	=> 'all',
    			'categories' 			=> 'all',
    			'show_post_meta'		=> 'on',
    			'show_footer_box' 		=> 'on'
    		);
    		$orderby 	= isset ( $instance ['orderby'] ) ? $instance ['orderby'] : '';
    		$instance 	= wp_parse_args( (array) $instance, $defaults );
    		/*----------------------------------------------------------------------------------------------------------
    		Widget Options
    		-----------------------------------------------------------------------------------------------------------*/
    		?>
    		<h4 style="line-height: 20px;"><div class="dashicons dashicons-editor-alignleft" style="padding-right:5px"></div><?php _e( 'Options du module', 'gameleon' ); ?></h4>
    		<p>
    			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titre du module:', 'gameleon' ); ?></label>
    			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
    		</p>
    		<p>
    			<label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Filtre de categorie:', 'gameleon' ); ?></label>
    			<select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>" class="widefat categories">
    				<option value='all' <?php if ( 'all' == $instance['categories']) echo 'selected="selected"'; ?>><?php _e( 'All Categories', 'gameleon' ); ?></option>
    				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
    				<?php foreach( $categories as $category ) { ?>
    					<option value='<?php echo $category->term_id; ?>' <?php if ( $category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
    					<?php } ?>
    				</select>
    			</p>
    			<p>
    				<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Trier par:', 'gameleon' ); ?></label>
    				<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
    					<option value="date"<?php if( $orderby=="date" ) echo ' selected="selected"';?>><?php _e( 'Date', 'gameleon' );?></option>
    					<option value="rand"<?php if( $orderby=="rand" ) echo ' selected="selected"';?>><?php _e( 'Random', 'gameleon' );?></option>
    					<option value="name"<?php if( $orderby=="name" ) echo ' selected="selected"';?>><?php _e( 'Alphabetiquement', 'gameleon' );?></option>
    					<option value="comment_count"<?php if( $orderby=="comment_count" ) echo ' selected="selected"';?>><?php _e( 'Plus populaire', 'gameleon' );?></option>
    					<option value="meta_value_num"<?php if( $orderby=="meta_value_num" ) echo ' selected="selected"';?>><?php _e( 'Plus vus', 'gameleon' );?></option>
    				</select>
    			</p>
                <p>
    				<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( "Nombre d'article à afficher:", 'gameleon' ); ?></label>
    				<input class="widefat" type="number" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo $instance['number_of_posts']; ?>" />
    			</p>
                <p class="description"><?php _e( 'Mettre -1 pour tous les afficher', 'gameleon' ); ?></p>
    			<p>
    				<label for="<?php echo $this->get_field_id( 'readmore' ); ?>"><?php _e( 'En savoir plus texte:', 'gameleon' ); ?></label>
    				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'readmore' ); ?>" name="<?php echo $this->get_field_name( 'readmore' ); ?>" value="<?php echo $instance['readmore']; ?>" />
    			</p>
    			<p class="description"><?php _e( 'Exemple: En savoir plus', 'gameleon' ); ?></p>

    			<h4 style="line-height: 20px;"><div class="dashicons dashicons-admin-generic" style="padding-right:5px"></div><?php _e( 'Other Options', 'gameleon' ); ?></h4>

    			<p>
    				<label for="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>"><?php _e( 'Longueur du titre:', 'gameleon' ); ?></label>
    				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'td_trim_title_small' ); ?>" name="<?php echo $this->get_field_name( 'td_trim_title_small' ); ?>" value="<?php echo $instance['td_trim_title_small']; ?>" />
    			</p>
    			<p>
    				<label for="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>"><?php _e( "Longueur de l'extrait de l'article", 'gameleon' ); ?></label>
    				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'smallexcerpt' ); ?>" name="<?php echo $this->get_field_name( 'smallexcerpt' ); ?>" value="<?php echo $instance['smallexcerpt']; ?>" />
    			</p>
    			<p>
    				<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_meta'], 'on' ); ?> id="<?php echo $this->get_field_id('show_post_meta'); ?>" name="<?php echo $this->get_field_name( 'show_post_meta' ); ?>" />
    				<label for="<?php echo $this->get_field_id('show_post_meta'); ?>"><?php _e( "Montrer les informations de l'article", 'gameleon' ); ?></label>
    			</p>
    			<p>
    				<input class="checkbox" type="checkbox" <?php checked( $instance['show_footer_box'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_footer_box' ); ?>" name="<?php echo $this->get_field_name( 'show_footer_box' ); ?>" />
    				<label for="<?php echo $this->get_field_id( 'show_footer_box' ); ?>"><?php _e( 'Montrer le footer', 'gameleon' ); ?></label>
    			</p>
    			<?php
    		}
    }
