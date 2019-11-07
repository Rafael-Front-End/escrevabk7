<?php
/**
Template Name: Blog
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
    <!-- blog -->
    <main id="pagina_blog" class="site-main container" role="main">
        <div class="tipo_3 col-md-12">
            <?php 
            // Check if there are any posts to display
            $wpb_all_query = new WP_Query(array(
              'post_type'=>'post', 
              'post_status'=>'publish', 
              'posts_per_page'=>10,
              'paged' => get_query_var( 'paged' )
          ));
            
            if ( $wpb_all_query->have_posts() ) : 
      
            $contador = 0;
            // The Loop
            while ($wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); 
                $contador++;

                if ( has_post_thumbnail() ) {
                    $the_post_thumbnail = get_the_post_thumbnail_url();
                } else { 
                    $the_post_thumbnail = get_bloginfo('template_directory')."/imagens/default-image.png";
                } 

                
                $cat_inf    = get_the_category();
                $cat_inf    = $cat_inf[0];
                $url        = get_permalink();
                $img        = $the_post_thumbnail;
                $cat_name   = get_cat_name($cat_inf->cat_ID);
                $cat_link   = get_category_link($cat_inf->cat_ID);
                $titulo     = get_the_title();
                $resumo     = resumo_txt(get_the_excerpt(),120,0);
                $data_post  = get_the_date('d M Y');
                $autor      = get_the_author();
                $autor_link      = get_site_url()."/author/".$autor;
                $id_post    = $post->ID;
              
              
                        $html_categoria_cultura .='
                <div class="tipo_1   destaque_categorias">
                        <div class="bloco_post">
                          <a href="'.$url.'"  class="thumbnail_post" style="background-image:url('.$img.');"><img src="'.$img.'"></a>
                            <div class="content_post">
                              <p class="data"><span>'.$data_post.' </span></p>
                              <a href="'.$url.'" ><h4>'.$titulo.'</h4></a>
                              <p>'.$resumo.'</p>
                            </div>
                        </div>
                </div>
                    ';
             endwhile; 
             echo $html_categoria_cultura;

                if (function_exists("wp_bs_pagination")):
                    echo "<div class='clearfix'></div><div class='col-md-12'>";
                      wp_bs_pagination($wpb_all_query->max_num_pages);
                    echo "</div>";
                endif;
     
              wp_reset_postdata();

            else: ?>
                <p>Não existem posts para esta categoria!</p>
            <?php endif; ?>

        </div>
    </main><!-- #main -->

<?php 
endwhile;
get_footer();
?>