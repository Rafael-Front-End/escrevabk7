<?php
/**
Template Name: Blog
*/
 
get_header(); 
 
    echo '<header id="pagina_cabecalho"><div class="container"><div class="col-md-12">';
        the_title( '<h1 id="titulo_pagina">', '</h1>' );
    echo '</div></div></header>';
?> 
<main id="pagina_categoria" class="site-main container" role="main">
        <div class="tipo_3 destaque_categorias">
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
                $resumo     = resumo_txt(get_the_excerpt(),70,0);
                $data_post  = get_the_date('d M Y');
                $autor      = get_the_author();
                $autor_link      = get_site_url()."/author/".$autor;
                $id_post    = $post->ID;
              
              
                        $html_categoria_cultura .='
                        <a href="'.$url.'" class="bloco_categoria col-md-6" style="background-image: url('.$img.');">
                                <div class="content-post">
                                  <h3>'.$titulo.'</h3>
                                  <p>'.$resumo.'...</p>
                                  <p>'.$autor.' <span>- '.$data_post.'</span></p>
                                </div>
                            </a>
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
</main>
 
<?php get_footer(); ?>
