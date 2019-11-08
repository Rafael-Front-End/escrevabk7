<?php
/**
Template Name: Ensino Fundamental
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
    <header id="pagina_cabecalho" style="background-color: #20cceb;" class="page_width">
        <div class="col-md-12">
            <?php  
                the_title( '<h1 id="titulo_pagina">', '</h1>' );               
            ?>
        </div>

    </header>
    <div class="clearfix"></div>
    <main id="main" class="site-main container" role="main">
        <div class="col-md-8">
           

            <section id="post_thumbnail" class="">
            <?php 
                if($featured_video){
                    echo $featured_video;
                    
                }else{
                    echo "<img src=\"{$img}\" alt=\"\" id=\"post_thumbnail\">";
                }
            ?>

            </section>
            <?php echo $featured_audio;?>
            <section class="conteudo_post">

                <div id="texto_post">
                    <?php  the_content(); ?>
                   
                    <div style='float:left; width:100%;'>
                        <div id="svgContainer"></div>
                        <div id='inner_post_widget'> <?php dynamic_sidebar('inner_post_widget'); ?></div>
                        

                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_1" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico1.jpg')" class="ibagem">
                            </div>
                            <p>
                                Aulas com técnicas de redação para vestibulares;
                            </p>
                        </div>
                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_2" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico2.jpg')" class="ibagem">
                            </div>
                            <p>
                                aulas interdisciplinares, com Geografia, História, Psicologia, Direito, Sociologia, Filosofia, entre outros;
                            </p>
                        </div>
                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_3" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico3.jpg')" class="ibagem">
                            </div>
                            <p>
                                debates sobre temas atuais;
                            </p>
                        </div>
                    </div>
                    <div style='float:left; width:100%;'>
                        <div id="svgContainer2"></div>
                        <div id='inner_post_widget'> <?php dynamic_sidebar('inner_post_widget'); ?></div>
                        

                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_4" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico4.jpg')" class="ibagem">
                            </div>
                            <p>
                                atendimento individual mediante agendamento;
                            </p>
                        </div>
                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_5" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico5.jpg')" class="ibagem">
                            </div>
                            <p>
                                simulados corrigidos por profissionais capacitados segundo os critérios de avaliação dos principais vestibulares;
                            </p>
                        </div>
                        <div  class="diagrama_metodologia">
                            <div id="diagrama_metodologia_6" style="background-image: url('<?php bloginfo( 'template_directory' ); ?>/imagens/icons/ico6.jpg')" class="ibagem">
                            </div>
                            <p>
                                material para as aulas.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php get_sidebar(); ?>
    </main><!-- #main -->

<?php 
endwhile;
get_footer();
?>