<?php
/**
Single Post Template:  Usuarios de Depoimentos
*/
 

get_header();
while ( have_posts() ) : the_post();

   if ( has_post_thumbnail() ) {
        $the_post_thumbnail = get_the_post_thumbnail_url();
    } else { 
        $the_post_thumbnail = get_bloginfo('template_directory')."/imagens/default-image.png";
    } 
    $custom = get_post_custom();
    setPostViews(get_the_ID());
    $Categoria = get_the_category(); 
    $Nome_categoria = $Categoria[0] -> cat_name;
    $Id_categoria = $Categoria[0] -> cat_ID;
    $Id_categoria1 = $Categoria[1] -> cat_ID;
    $link_categoria = get_category_link($Id_categoria); 
    $autor   = get_the_author();
    $autor_link = get_author_posts_url(get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ));
    $contador_img_galeria = 0;
    $titulo     = get_the_title();
    $id_post = get_the_ID();
    $views = getPostViews($id_post);
    $img   = $the_post_thumbnail; 
    $tipo_media = get_post_meta($id_post, "meta-box-tipo-featured_media", true);
    $url_media = get_post_meta($id_post, "meta-box-url-featured_media", true);
    $data_post  = get_the_date('d M Y');
    $conteudo = get_the_content();

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
    <!-- blog -->
    <main id="pagina_blog" class="pagina_depoimento pagina_usuario_depoimento site-main" role="main">
        <div class="tipo_3 col-md-9">
            <?php 
                

                $nota_curso1 = $nota_curso2 = $nota_curso3 = $nota_enem = NULL;;
                if(isset($custom['nota_enem'])) {
                    $nota_enem = $custom['nota_enem'][0];
                }

                if(isset($custom['nota_curso1'])) {
                    $nota_curso1 = "<b>".$custom['nota_curso1'][0]."</b>";
                }

                if(isset($custom['nota_curso2'])) {
                    $nota_curso2 = "<b>".$custom['nota_curso2'][0]."</b>";
                }

                if(isset($custom['nota_curso3'])) {
                    $nota_curso3 = "<b>".$custom['nota_curso3'][0]."</b>";
                }

              
              
                echo '
                <div class="tipo_1   destaque_categorias">
                        <div class="bloco_post">
                          <a   class="thumbnail_post" style="background-image:url('.$img.');"></a>
                          <div class="notas">
                                <h4>Nota redação</h4>
                                <h3>'.$nota_enem.'</h3>
                                '.$nota_curso1.$nota_curso2.$nota_curso3 .'
                            </div> 

                            <div class="content_post">
                              <h5>Recomenda Escreva - Grupos para redação</h5>
                              <p>'.$conteudo.'</p>
                              <p class="data"><span>'.$data_post.' </span></p>
                            </div>
                            
                        </div>
                </div>
                    ';
            
            ?>
        </div>
        <?php get_sidebar(); ?>
    </main><!-- #main -->

<?php 
endwhile;
get_footer();
?>