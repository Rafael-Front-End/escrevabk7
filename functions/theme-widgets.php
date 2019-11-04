<?php

$do_not_duplicate = array();
// http://g1.globo.com/sao-paulo/sao-jose-do-rio-preto-aracatuba/noticia/2016/11/equipe-da-tv-tem-sofre-ameaca-em-reportagem-sobre-morte-em-motel.html
function remove_text_widget() {//remove o widget padrão text para ser adicionar o novo
  unregister_widget('WP_Widget_Text');
  unregister_widget('WP_Widget_Tag_Cloud'); 
}  
    
add_action( 'widgets_init', 'remove_text_widget' );
    
    
// load css into the admin pages
function mytheme_enqueue_options_style() {   
    wp_enqueue_script( 'jquery' ); 
    wp_enqueue_script('jquerytools');
    wp_enqueue_script('jquery-ui-person');
    wp_enqueue_script('jqueryform'); 
    wp_enqueue_script('sprinkle');
    wp_enqueue_script('custom');
    // wp_enqueue_script( 'custom_js_script', get_template_directory_uri().'/js/jquery.js', array('jquery')); 
    // wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/css/style_admin.css' ); 
}
add_action( 'admin_enqueue_scripts', 'mytheme_enqueue_options_style' );


/* Widgetable Functions  */
 
function under_widgets_init() {


  register_sidebar(array(
    'id' => 'campo_depoimento',
    'name'=>_('Área de Depoimentos'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => ''
  ));


  register_sidebar(array(
    'id' => 'pagina_inicial',
    'name'=>_('Página Inicial'),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => ''
  ));


  register_sidebar(array(
    'id' => 'sidebar_blog',
    'name'=>_('SideBar do blog'),
    'before_widget' => '',
    'after_widget' => '', 
    'before_title' => '',
    'after_title' => ''
  ));

  register_sidebar(array(
    'id' => 'topo_pagina_inicial',
    'name'=>_('Topo da página inicial'),
    'before_widget' => '',
    'after_widget' => '', 
    'before_title' => '',
    'after_title' => ''
  ));

  register_sidebar(array(
    'name' => _('Barra lateral'),
    'id' => 'barra_lateral',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '', 
    'after_title' => ''
  ));   
  register_sidebar(array(
    'id' => 'rodape',
    'name'=>'Rodapé',
    'before_widget' => '<li id="%1$s" class="%2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));

  register_sidebar(array(
    'id' => 'rodape2',
    'name'=>'Rodapé marcas',
    'before_widget' => '<li id="%1$s" class="%2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h2>',
    'after_title' => '</h2>'
  ));

}
add_action( 'widgets_init', 'under_widgets_init' );
require('category_widget.php');


/* More About Us Widget */
class banner extends WP_Widget
{
    function __construct()
    {
        parent::__construct("banner", "Banner/Imagem", array('description' => "Adicione uma imagem ou um texto com link",'customize_selective_refresh' => true));
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
    }

    /**
    * Upload the Javascripts for the media uploader
    */
    public function upload_scripts()
    {
      wp_enqueue_script('media-new');
      wp_enqueue_script('thickbox');
      wp_enqueue_script('upload_media_widget',get_template_directory_uri().'/js/upload-media.js',array('jquery'));
      wp_enqueue_style('thickbox');
      wp_enqueue_script( 'media-upload' );
      wp_enqueue_media();

    }


    public function widget($args, $instance)
    {
      if(isset($instance['title'])){
          $title = apply_filters('widget_title', $instance["title"]);
      }
          if(!empty($instance['link']))
          {
              echo '<a href="'.$instance['link'].'" target="_blank" class="banner imagem">';
          }
          else if(!empty($instance['image'])) 
          {
              echo '<a href="'.$instance['image'].'" rel="lightbox-0" class="banner imagem">';
          }
          if(!empty($instance['title'])){
              echo "<h3>".$args['before_title'] . $title . $args["after_title"]."</h3>";
          } 

          if(!empty($instance['image'])){
              $largura  = ((!empty($instance['largura'])) ? "width:{$instance['largura']};" : "");
              $altura   = ((!empty($instance['altura'])) ? "height:{$instance['altura']};" : "");
              echo '<img style="'.$largura.' '.$altura.'" class="img-responsive" src="'.$instance['image'].'" />';
          }
          if(!empty($instance['link']) || !empty($instance['image']))
          {
              echo '</a>';
          }

    }
   
    public function form($instance)
    {
      if(isset($instance['link']))
      {
        $link = $instance['link'];
      }

      if(isset($instance['largura']))
      {
        $largura = $instance['largura'];
      }

      if(isset($instance['altura']))
      {
        $altura = $instance['altura'];
      }

      if(isset($instance['title']))
      {
        $title = $instance['title'];
      }

      $image = '';
      if(isset($instance['image']))
      {
          $image = $instance['image'];
      }

      ?>

          <p>
              <label for="<?php echo $this->get_field_id('link'); ?>" ><b> <?php _e("Link:"); ?></b></label>
              <input type='text' class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo esc_attr($link); ?>">
              <div style="font:12px; color:#666;"> Caso não tenha um link deixe em branco </div>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>" ><b> <?php _e("Titulo:"); ?></b></label>
              <input type='text' id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
              <div style="font:12px; color:#666;"> Este título será exibido no banner!<br/>Caso não queira exibir o título deixo o campo em branco.</div>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('image'); ?>"><b><?php _e( 'Imagem:' ); ?></b></label>
              <input name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" class="widefat image-uploaded-x" type="text" size="36"  value="<?php echo esc_url($image); ?>" placeholder="" />
              <!--input class="upload_image_button widefat button button-primary" type="button" value="Adicionar imagem" /-->
              <div style="font:12px; color:#666;"> Adicione a url da imagem ou faça o upload da imagem no botão abaixo.</div>
          </p>
          <p>
              <label style='width:50%; float:left;' for="<?php echo $this->get_field_id('largura'); ?>"><b><?php _e( 'Largura:' ); ?></b></label>
              <label style='width:50%; float:left;' for="<?php echo $this->get_field_id('altura'); ?>"><b><?php _e( 'Altura:' ); ?></b></label>
              <input style='width:48%; float:left;' name="<?php echo $this->get_field_name('largura'); ?>" id="<?php echo $this->get_field_id('largura'); ?>" type="text" size="36"  value="<?php echo esc_attr($largura); ?>" placeholder="" />
              <input style='width:48%; float:left;'name="<?php echo $this->get_field_name('altura'); ?>" id="<?php echo $this->get_field_id('altura'); ?>" type="text" size="36"  value="<?php echo esc_attr($altura); ?>" placeholder="" />
          </p>
          <p style="font:12px; color:#666;">Deixe o campo vazio para manter a altura ou largura real da imagem.<br> Para definir o tamanho use pixels exemplo '250px' com 'px' no final ou porcentagem '100%' com % no final do valor.</p>
      <?php

    }

    public function update($new_instance, $old_instance)
    {
      $instance = array();
      $instance['link']     = (!empty($new_instance['link'])    ?   strip_tags($new_instance['link'])  : '');
      $instance['title']    = (!empty($new_instance['title'])   ?   strip_tags($new_instance['title']) : '');
      $instance['image']    = (!empty($new_instance['image'])   ?   strip_tags($new_instance['image']) : '');
      $instance['largura']  = (!empty($new_instance['largura'])   ?   strip_tags($new_instance['largura']) : '');
      $instance['altura']   = (!empty($new_instance['altura'])   ?   strip_tags($new_instance['altura']) : '');
      return $instance;
    }

}

add_action("widgets_init",function(){register_widget("banner"); });





/* Widget para posts recentes */

class tag_template extends WP_Widget
{
    function __construct()
    {
        parent::__construct("tag_template", "Temas para Tags", array('description' => "(Widget de configurações) Escolha um tema para a pagina de tag"));
    }

    public function widget($args, $instance)
    {
      echo $args[" "];
      define(TEMA_TAG, $instance['design']); 
                   
      echo $args["after_widget"];
    }
   
    public function form($instance)
    {

      if(isset($instance['design']))
      {
        $design = $instance['design'];
      }

      ?> 
      <p>
        <label for="<?php echo $this->get_field_id('design'); ?>" > <?php _e("Layout do Widget:"); ?></label> 
        <select name="<?php echo $this->get_field_name('design'); ?>" id="<?php echo $this->get_field_id('design'); ?>" class="postform">
            <option <?php echo (esc_attr($design) == 1 ? 'selected="selected"' : ''); ?> class="level-0" value="1">Padrão</option>
            <option <?php echo (esc_attr($design) == 2 ? 'selected="selected"' : ''); ?> class="level-1" value="2">Tema 2</option>
            <option <?php echo (esc_attr($design) == 3 ? 'selected="selected"' : ''); ?> class="level-2" value="3">Tema 3</option>
            <option <?php echo (esc_attr($design) == 4 ? 'selected="selected"' : ''); ?> class="level-3" value="4">Tema 4</option>
            <option <?php echo (esc_attr($design) == 5 ? 'selected="selected"' : ''); ?> class="level-5" value="5">Tema 5</option>
        </select>
      </p>
      <?php
    }

    public function update($new_instance, $old_instance)
    {
      $instance = array();
      $instance['design']    = (!empty($new_instance['design'])    ?   strip_tags($new_instance['design'])  : '');
      return $instance;
    }

}

add_action("widgets_init",function(){register_widget("tag_template"); });




/* Widget para posts recentes */

class listar_tags_post extends WP_Widget
{
    function __construct()
    {
        parent::__construct("listar_tags_post", "Listar Tags ou Categorias", array('description' => "Exibe os posts recentes"));
    }

  public function widget($args, $instance)
  {
        if(isset($instance['title'])){
            $title = apply_filters('widget_title', $instance["title"]);
        }
        echo $args[" "];
        
        $taxonomia =$instance['taxonomia'];
        $design = $instance['design'];
        $titulo_plugin = $instance['title'];

        switch($design):
          case 1: 
            if($taxonomia == 'category'){
              $tag_ids = wp_get_post_categories(get_the_ID(), array( 'fields' => 'ids' ) );
            }else{
               $tag_ids = wp_get_post_tags(get_the_ID(), array( 'fields' => 'ids' ) );
            }


            $titulo_plugin_html = !empty($titulo_plugin) ? "<h3><span>".$titulo_plugin."</span></h3>" : '';
            if(is_single()){
              if(count($tag_ids) > 0){
                $html_widget = wp_tag_cloud( apply_filters( 'listar_tags_post', array(
                          'taxonomy' => $taxonomia,
                          'echo' => false,
                          'include'  => $tag_ids
                )));
              }else{
                if($taxonomia == 'category'){
                  $html_widget = '&nbsp;&nbsp;Sem Categorias';
                }else{
                  $html_widget = '&nbsp;&nbsp;Sem Tags';
                }
              }
            }else{
              $html_widget = wp_tag_cloud( apply_filters( 'listar_tags_post', array(
                        'taxonomy' => $taxonomia,
                        'echo' => false
              )));
            }
            echo "
              <div class=\"tagcloud\">
                  $titulo_plugin_html
                  $html_widget
              </div>
              "; 
          break;
          case 2:            
            if($taxonomia == 'category'){
              $tag_ids = wp_get_post_categories(get_the_ID(), array( 'fields' => 'ids' ) );
            }else{
               $tag_ids = wp_get_post_tags(get_the_ID(), array( 'fields' => 'ids' ) );
            }

            $titulo_plugin_html = !empty($titulo_plugin) ? "<span>".$titulo_plugin."</span>" : '';
            
            if(is_single()){
              if(count($tag_ids) > 0){
                $html_widget = wp_tag_cloud( apply_filters( 'listar_tags_post', array(
                          'taxonomy' => $taxonomia,
                          'echo' => false,
                          'include'  => $tag_ids
                )));
              }else{
                if($taxonomia == 'category'){
                  $html_widget = '&nbsp;&nbsp;Sem Categorias';
                }else{
                  $html_widget = '&nbsp;&nbsp;Sem Tags';
                }
              }
            }else{
              $html_widget = wp_tag_cloud( apply_filters( 'listar_tags_post', array(
                        'taxonomy' => $taxonomia,
                        'echo' => false
              )));
            }
            $html_widget = preg_replace("/style='font-size: [0-9.]*pt;'/i", "", $html_widget);
            echo "
              <div class=\"bt_tags\">
                  $titulo_plugin_html
                  $html_widget
              </div>
              "; 
          break;
        endswitch;                

    echo $args["after_widget"];
  }
 
  public function form($instance)
  {

    if(isset($instance['design']))
    {
      $design = $instance['design'];
    }

    if(isset($instance['taxonomia']))
    {
      $taxonomia = $instance['taxonomia'];
    }

    if(isset($instance['title']))
    {
      $title = $instance['title'];
    }
    else
    {
      $title = "";
    }

    if(isset($instance['quantidade']))
    {
        $quantidade = $instance['quantidade'];
    }

    ?>      

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" > <?php _e("Titulo:"); ?></label>
            <input type='text' id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
            <div style="font:12px; color:#666;"> </div>
        </p>


        <p>
            <label for="<?php echo $this->get_field_id('taxonomia'); ?>" > <?php _e("Taxonomia:"); ?></label>
            
            <select name="<?php echo $this->get_field_name('taxonomia'); ?>" id="<?php echo $this->get_field_id('taxonomia'); ?>" class="postform">
              <option <?php echo (esc_attr($taxonomia) == 'post_tag' ? 'selected="selected"' : ''); ?> class="level-0" value="post_tag">Tags</option>
              <option <?php echo (esc_attr($taxonomia) == 'category' ? 'selected="selected"' : ''); ?> class="level-1" value="category">Categorias</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('design'); ?>" > <?php _e("Design:"); ?></label>
            
            <select name="<?php echo $this->get_field_name('design'); ?>" id="<?php echo $this->get_field_id('design'); ?>" class="postform">
              <option <?php echo (esc_attr($design) == 1 ? 'selected="selected"' : ''); ?> class="level-0" value="1">Nuvem</option>
              <option <?php echo (esc_attr($design) == 2 ? 'selected="selected"' : ''); ?> class="level-1" value="2">Botões</option>
            </select>
        </p>

        
    <?php

  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['taxonomia']    = (!empty($new_instance['taxonomia'])    ?   strip_tags($new_instance['taxonomia'])  : '');
    $instance['title']        = (!empty($new_instance['title'])   ?   strip_tags($new_instance['title']) : '');
    $instance['quantidade']   = (!empty($new_instance['quantidade'])   ?   strip_tags($new_instance['quantidade']) : '');
    $instance['design']       = (!empty($new_instance['design'])   ?   strip_tags($new_instance['design']) : '');
    return $instance;
  }

}

add_action("widgets_init",function(){register_widget("listar_tags_post"); });





/* Widget para posts recentes */

class destaca_post_unico extends WP_Widget
{
    function __construct()
    {
        parent::__construct("destaca_post_unico", "Destacar Post", array('description' => "Destaca um post"));
    }

  public function widget($args, $instance)
  {
        echo $args[" "];

        if(isset($instance['bloco_1']))
        {
          $bloco_1 = $instance['bloco_1'];
        }

        $vetor_posts = array($bloco_1);

        $args = array(
           'showposts' => '1',
           'post__in'      => $vetor_posts,
           'orderby' => 'post__in'
        );

        query_posts($args);
        $contador_de_post = 0;
        if (have_posts()) : 

            while (have_posts()) : the_post(); $contador_de_post++;



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
              $titulo     = get_the_title();
              $titulo_resumo     = resumo_txt($titulo,90,0);
              $resumo     = resumo_txt(get_the_excerpt(),90,0);
              $data_post  = get_the_date('d M Y');
              $autor      = get_the_author();
              $id_post    = get_the_ID();
              $tipo_media = get_post_meta($id_post, "meta-box-tipo-featured_media", true);
              $url_media  = get_post_meta($id_post, "meta-box-url-featured_media", true);
              $media_style = NULL;
              if($url_media != NULL){
                if($tipo_media == 1){
                  $media_style  = (($url_media) ? 'video_post' : '');
                }else if($tipo_media == 2){
                  $media_style = "";
                }
              }else{
                $wp_post_template  = get_post_meta($id_post, "_wp_post_template", true);
                $media_style = (($wp_post_template == 'single-carrousel_galeria.php') ? 'imagem_post' : '');
              }

              
             



              $html_destaques .= "
                <a href=\"{$url}\" class=\"bloco_destaque item_1\" style=\"background-image: url({$the_post_thumbnail})\">
                  <div class=\"content-post\">
                    <div class=\"content-txt\">
                      <h3>{$titulo_resumo}</h3>
                      <p><b>{$autor}</b> <span>- {$data_post}</span></p>
                    </div>
                  </div>
                </a>
                ";

            endwhile;
            wp_reset_query();
        endif;

        if(isset($instance['title']))
        {
          $title = "<h3><span>".$instance['title']."</span></h3>";
        }


        echo "
          <div class='destaca_post_unico textwidget'>
            $title
            <div class=\"barra_destaques\">
                $html_destaques
            </div>
          </div>  
        ";
           
    echo $args["after_widget"];
  }
 
  public function form($instance)
  {

    if(isset($instance['categoria']))
    {
      $categoria = $instance['categoria'];
    }

    if(isset($instance['title']))
    {
      $title = $instance['title'];
    }

    if(isset($instance['bloco_1']))
    {
      $bloco_1 = $instance['bloco_1'];
    }

    wp_reset_query();
    query_posts('orderby=title&posts_per_page=999999');
    if (have_posts()) : 

        while (have_posts()) : the_post(); 
          $bloco_1_html .= "<option ".(esc_attr($bloco_1) == get_the_ID() ? 'selected="selected"' : '')." class='level-0' value='".get_the_ID()."'>".get_the_title()."</option>"; 
        endwhile;
    endif;
    wp_reset_query();


    ?>     


        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" ><b> <?php _e("Titulo:"); ?></b></label>
            <input  type='text' id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
            <div style="font:12px; color:#666;"></div>
        </p> 


        <p>
            <label for="<?php echo $this->get_field_id('bloco_1'); ?>" > <?php _e("Post:"); ?></label>
            <select style='max-width: 100%;' name="<?php echo $this->get_field_name('bloco_1'); ?>" id="<?php echo $this->get_field_id('bloco_1'); ?>" class="postform">
              <?php echo $bloco_1_html; ?>
            </select>
            <div style="font:12px; color:#666;"></div>
        </p>  

    <?php

  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['bloco_1']    = (!empty($new_instance['bloco_1'])   ?   strip_tags($new_instance['bloco_1']) : '');
    $instance['title']      = (!empty($new_instance['title'])   ?   strip_tags($new_instance['title']) : '');
    return $instance;
  }

}

add_action("widgets_init",function(){register_widget("destaca_post_unico"); });


require('widget_about_area.php');
require('widget_parallaxy.php');
require('widget_parallaxy_reviews.php');
require('widget_slide_pagina_inicial.php');
require('widget_servicos.php');
require('widget_planos.php');
require('widget_texto.php');
require('widget_galeria.php');
require('widget_galeria_home.php');
require('widget_posts_recentes.php');




