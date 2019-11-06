<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
    <header id="pagina_cabecalho" style="background-color: #f47d3a;" class="page_width">
        <div class="col-md-12">
            <span class="meta-category"><a href="<?php echo $link_categoria;?>" class="category-2"><?php echo ($Id_categoria != 1 ? strtolower($Nome_categoria) : ''); ?></a></span>
            <?php  
                the_title( '<h1 id="titulo_pagina">', '</h1>' );
                echo '<h4>'.get_nskw_subtitle().'</h4>';
               
            ?>
        </div>
    </header>
    <div class="clearfix"></div>
    <!-- content-page -->
 <main id="main" class="site-main container" role="main">
    <div id="tema2" class="col-md-12">
        <section id="post_thumbnail">
                <img src="<?php echo $img; ?>" alt="" id="post_thumbnail">
        </section>

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
