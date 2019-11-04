<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
 <main id="main" class="site-main container" role="main">
    <div id="tema2" class="col-md-12">
        <section id="post_thumbnail">
                <img src="<?php echo $img; ?>" alt="" id="post_thumbnail">
        </section>
        <header id="pagina_cabecalho">
                <?php  
                    the_title( '<h1>', '</h1>' );
                    echo '
                        <div class="col-md-12 entry-meta">
                            <div class="meta-item author">
                                <img src="'.get_avatar_url(get_the_author_ID()).'" alt="">
                                <span class="vcard author">
                                    <span class="fn">
                                        Por '.get_the_author_link().'
                                    </span>
                                </span>
                            </div>
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
                            <div class="meta-item views">
                                '.$views.' Visualizações
                            </div>
                        </div>';
                ?>
        </header>

        <section class="conteudo_post">


            <div id="texto_post">
                <?php  the_content(); ?>
            </div>
            
            <?php 
                // If comments are open or we have at least one comment, load up the comment template.
                // if ( comments_open() || get_comments_number() ) :
                //     comments_template();
                // endif;
            ?> 
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
</main><!-- #main -->
