<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<!-- image -->
 <main id="main" class="site-main container" role="main">

			<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

				    if ( has_post_thumbnail() ) {
				        $the_post_thumbnail = get_the_post_thumbnail_url();
				    } else { 
				        $the_post_thumbnail = "";
				    } 

				    setPostViews(get_the_ID());
				    $Categoria = get_the_category();
				    $Nome_categoria = $Categoria[0] -> cat_name;
				    $Id_categoria = $Categoria[0] -> cat_ID;
				    $Id_categoria1 = $Categoria[1] -> cat_ID;
				    $link_categoria = get_category_link($Id_categoria);
				    $author = get_the_author();
				    $contador_img_galeria = 0;
				    $views = getPostViews(get_the_ID());
				    $img   = $the_post_thumbnail;
			?>

			<div class="col-md-8">
				<?php previous_image_link( false, __( 'Previous Image', 'twentyfifteen' ) ); ?>
				<?php next_image_link( false, __( 'Next Image', 'twentyfifteen' ) ); ?>
                <header id="pagina_cabecalho">
                    <div class="col-md-12">
                       
                        <?php  
                            the_title( '<h1>', '</h1>' );
                            echo '
                                <div class="col-md-12 entry-meta">
                                    <div class="meta-item date">
                                        <span class="updated">
                                            '.data_amigavel().'
                                        </span>
                                    </div>
                                    <div class="meta-item comments">
                                        <a href="#comments">
                                            '.get_comments_number().' Comentarios
                                        </a>
                                    </div>
                                    <div class="meta-item author">
                                        <span class="vcard author">
                                            <span class="fn">
                                                Por '.get_the_author_link().'
                                            </span>
                                        </span>
                                    </div>
                                    <div class="meta-item views">
                                        '.$views.' Visualizações
                                    </div>
                                </div>';
                        ?>


                    </div>
                </header>

                <section id="post_thumbnail" class="">
                        <img src="<?php echo $img; ?>" alt="" id="post_thumbnail">
                        <div id="topo_mostra_autor">
                            <img src="<?php echo get_avatar_url(get_the_author_ID());?>" alt="">
                            <div class="meta-author-wrapped">Postador por <span class="vcard author"><span class="fn"><?php echo get_the_author_link(); ?></span></span></div>
                        </div>
                </section>
                <section class="conteudo_post">


                    <div id="texto_post">
                    	<?php
							/**
							 * Filter the default Twenty Fifteen image attachment size.
							 *
							 * @since Twenty Fifteen 1.0
							 *
							 * @param string $image_size Image size. Default 'large'.
							 */
					
                        	the_content();
                        ?>
                    </div>
                    
                </section>
                <section id="comenarios">
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?> 
                </section>
            </div>
            <?php 
            	get_sidebar(); 
    		endwhile;

            ?>
</main><!-- #main -->
<?php get_footer(); ?>
