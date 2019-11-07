<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

<!-- category -->
<main id="pagina_categoria" class="site-main container" role="main">
	<div class="col-md-8">
		<div class="tipo_<?php echo TEMA_CATEGORIA;?> destaque_categorias">
			<?php 
			// Check if there are any posts to display
			if ( have_posts() ) : 
	 

			echo '<h3><span>'.single_cat_title( '', false ).'</span><div class="theme-border-color"></div></h3>';  
			
			if ( category_description() ) : 
				echo "<p class='txt_descricao'>".strip_tags(category_description())."</p><h3></h3>"; 
			endif; 
			$contador = 0;
			// The Loop
			while ( have_posts() ) : the_post(); 
				$contador++;

              	if ( has_post_thumbnail() ) {
               		$the_post_thumbnail = get_the_post_thumbnail_url();
              	} else { 
	            	$the_post_thumbnail = get_bloginfo('template_directory')."/imagens/default-image.png";
	            } 

	            
				$cat_inf    = get_the_category();
				$url        = get_permalink();
				$img        = $the_post_thumbnail;
				$cat_name   = get_cat_name($cat_inf->cat_ID);
				$titulo     = resumo_txt(get_the_title(),45,0);
				$resumo     = resumo_txt(get_the_excerpt(),70,0);
				$data_post  = get_the_date('d M Y');
				$autor      = get_the_author();
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
				
				         //wp_bs_pagination($the_query->max_num_pages);
					echo "<div class='col-md-12'>";
				         wp_bs_pagination();
		         	echo "</div>";
				endif;
	 

			else: ?>
				<p>Não existem posts para esta categoria!</p>
			<?php endif; ?>

		</div>
	</div>
	<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
