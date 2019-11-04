         <?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */ 

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
        <div class="tipo_1	 destaque_categorias">
            '.($contador == 1 ? '' : '<h3></h3>').'
            <div class="bloco_post">
            	<a href="'.$url.'"  class="thumbnail_post" style="background-image:url('.$img.');"></a>
                <div class="content_post">
                  <h4>'.$titulo.'</h4>
                  <p>'.$resumo.'...</p>
                  <p>
              		'.$autor.' - <span>'.$data_post.' </span>
                  	<a href="'.$url.'" class="btn pull-right btn-default bloco_post">Leia mais</a></a>
                  </p>
                </div>
            </div>
        </div> 
  	';
  	echo $html_categoria_cultura;
?>






	


