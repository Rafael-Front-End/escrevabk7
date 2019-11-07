<?php
/**
Template Name: Contato
*/

get_header();
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
    $autor   = get_the_author();
    $autor_link = get_author_posts_url(get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ));
    $contador_img_galeria = 0;
    $id_post = get_the_ID();
    $views = getPostViews($id_post);
    $img   = $the_post_thumbnail; 
    $tipo_media = get_post_meta($id_post, "meta-box-tipo-featured_media", true);
    $url_media = get_post_meta($id_post, "meta-box-url-featured_media", true);

    if($url_media != NULL){
        if($tipo_media == 1){
            $featured_video = "<iframe src=\"{$url_media}\" allowfullscreen width=\"100%\" height=\"380\" frameborder=\"0\"></iframe>";
        }else if($tipo_media == 2){
            $featured_audio = "
                <audio id='media_post' controls>
                    <source src=\"{$url_media}\" type=\"audio/mpeg\">
                </audio>
            ";
        }
    }
 
?>
    <header id="pagina_cabecalho" style="background-color: #f47d3a;"  class="page_width">
        <div class="col-md-12">
            <?php  
                the_title( '<h1 id="titulo_pagina">', '</h1>' );
               
            ?>
        </div>

    </header>
    <div class="clearfix"></div>
    <!-- contato  -->
    <main id="main" class="site-main container" role="main">
        <div id="pagina_contato" class="col-md-12">
           
            <section class="conteudo_post">

                <div id="texto_post">
                    <div style="margin-bottom:40px;" class="col-md-6">
                        <h3>Fale conosco</h3>
                        <div class="socialicons">
                            <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/icons/phone.png'>
                            <div class="txt">
                                <b>Telefone</b><br>
                                <span>21 99698-5031</span>
                            </div>
                        </div>
                        <div class="socialicons">
                            <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/icons/envelop.png'>
                            <div class="txt">
                                <b>Email</b><br>
                                <a href="mailto:contato@cursoescreva.com.br" target="_top">contato@cursoescreva.com.br</a>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom:40px;" class="col-md-6">
                        <h3>Redes sociais</h3>
                        <div class="socialicons">
                            <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/icons/facebook.png'>
                            <div class="txt">
                                <b>Facebook</b><br>
                                <a href="mailto:contato@cursoescreva.com.br" target="_top">@cursoescreva</a>
                            </div>
                        </div>
                        <div class="socialicons">
                            <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/icons/insta.png'>
                            <div class="txt">
                                <b>Instagram</b><br>
                                <a href="mailto:@cursoescreva" target="_top">@cursoescreva</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php  
                        the_content();
                    ?>
                </div>
                
                <div id='inner_post_widget'> <?php dynamic_sidebar('inner_post_widget'); ?></div>
 
            </section>
            
        </div>
    </main><!-- #main -->

<?php 
endwhile;
get_footer();
?>