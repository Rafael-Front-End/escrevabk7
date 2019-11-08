<?php

/* Widget para posts recentes */

 

class posts_recentes extends WP_Widget
{ 
    function __construct()
    {
        parent::__construct("posts_recentes", "Zflag Posts Recentes", array('description' => "Exibe os posts recentes"));
    }

  public function widget($args, $instance)
  {
        if(isset($instance['title'])){
            $title = apply_filters('widget_title', $instance["title"]);
        }
        echo $args[" "];
        
        global $do_not_duplicate;
        $depoimentocat = get_category_by_slug('depoimentos');
        $namidia = get_category_by_slug('na-midia');
        $quantidade = (!empty($instance['quantidade']) ? $instance['quantidade'] : 1);
        $design = $instance['design'];

        $categoria = (!empty($instance['categoria']) && ($instance['categoria'] != 'todas-categorias') ? "&category_name=".$instance['categoria'] : "");
        
        $query_args =  array(
                'showposts' => $quantidade,  
                'category_name' => $categoria, 
                'post__not_in'   => $do_not_duplicate,
                'category__not_in'   => array($depoimentocat->cat_ID, $namidia->cat_ID)
        );
        if(empty($instance['categoria']) || ($instance['categoria'] == 'todas-categorias'))
          unset($query_args['category_name']); 
        query_posts($query_args);


        $contador_de_post = 0;
        if (have_posts()) : 

            while (have_posts()) : the_post(); $contador_de_post++;
              $id_post    = get_the_ID();
              
                $do_not_duplicate[] = $id_post;

                // if ( has_post_thumbnail() ) {
                //   $the_post_thumbnail = get_the_post_thumbnail();
                // } else { 
                //   $the_post_thumbnail = "<img src='".get_bloginfo('template_directory')."/imagens/default-image.png' alt='".get_the_title()."' />";
                // } 

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
                $resumo     = resumo_txt(get_the_excerpt(),160,0);
                $data_post  = get_the_date('d M Y');
                $autor      = get_the_author();
                
                
                switch($design):
                  case 1: 
                    $html_categoria_cultura .="
                        <a href=\"{$url}\" class=\"bloco_post\">
                          <div class=\"thumbnail_post\" style=\"background-image:url($img);\"></div>
                          <div class=\"content_post\">
                            <h4>{$titulo}</h4>
                            <p><span>{$data_post}</span></p>
                          </div>
                        </a>
                    ";
                  break;
                  case 2: 
                    $html_categoria_cultura .="
                      <a href=\"{$url}\" class=\"bloco_post esquerda col-md-6\">
                        <div class=\"thumbnail_post\" style=\"background-image:url($img);\">
                          <img src='{$img}'>
                        </div>
                        <div class=\"content_post\">
                          <h4>{$titulo}</h4>
                          <p><span>{$data_post}</span></p>
                        </div>
                      </a>
                    ";
                  break;
                  case 3: 
                    $html_categoria_cultura .='
                      <a href="'.$url.'" class="bloco_post esquerda col-md-6">
                        <div class="thumbnail_post" style="background-image:url('.$img.');"></div>
                        <h4>'.$titulo.'</h4>
                        <p>'.$autor.'<span> - '.$data_post.'</span></p>
                      </a>
                    ';
                  break;   
                  case 4: 
                    $html_categoria_cultura .='
                      <div href="'.$url.'" class="bloco_post esquerda col-md-3">
                        <div class="thumbnail_post" style="background-image:url('.$img.');">
                          <img src="'.$img.'">
                        </div>
                        <h4>'.$titulo.'</h4>
                        <p>'.$resumo.'</p>
                        <a class="btn btn-light" href="'.$url.'">VER MAIS</a>
                      </div>
                    ';
                  break;
                  // case 5: 
                  //   $html_categoria_cultura .='
                  //     <a href="'.$url.'" class="bloco_post esquerda col-md-4">
                  //       <div class="thumbnail_post" style="">
                  //         <img src="'.$img.'" class="myBackgroundImage">
                  //       </div>
                  //     </a>
                  //   ';
                  // break;

                endswitch;
            endwhile;
              wp_reset_query();
        endif;

        switch($design):
          case 1: 
            $tipo_layout = 'tipo_1'; 
          break;
          case 2: 
            $tipo_layout = 'tipo_2'; 
          break;
          case 3: 
            $tipo_layout = 'tipo_3'; 
          break;
          case 4: 
            $tipo_layout = 'tipo_4'; 
          break; 
          // case 5: 
          //   $tipo_layout = 'tipo_5'; 
          // break;
        endswitch;
        $titulo_plugin = $instance['title'];

        $titulo_plugin_html = !empty($titulo_plugin) ? "<h3><span>".$titulo_plugin."</span><div class=\"theme-border-color\"></div></h3>" : '';
        echo "
        <div class=\"".$tipo_layout." destaque_categorias\">
            $titulo_plugin_html 
            $html_categoria_cultura
            <div class='clearfix'></div>
            <div class='col-md-12'><a class='todososposts btn' href='".get_permalink( get_page_by_path( 'blog' ) )."'>VER TODOS OS POSTS</a></div>
        </div>
        ";
           

    echo $args["after_widget"];
  }
 
  public function form($instance)
  {

    if(isset($instance['design']))
    {
      $design = $instance['design'];
    }

    if(isset($instance['categoria']))
    {
      $categoria = $instance['categoria'];
    }

    if(isset($instance['title']))
    {
      $title = $instance['title'];
    }
    else
    {
      $title = "Novo titulo";
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
            <label for="<?php echo $this->get_field_id('quantidade'); ?>" > <?php _e("Quantidade de posts:"); ?></label>
            <input type='text' id="<?php echo $this->get_field_id('quantidade'); ?>" name="<?php echo $this->get_field_name('quantidade'); ?>" class="widefat" value="<?php echo esc_attr($quantidade); ?>">
            <div style="font:12px; color:#666;">Digite o numero máximo de posts para serem exibidos</div>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('categoria'); ?>" > <?php _e("Categoria:"); ?></label>

            <?php 

              $args = array(
                'walker'             => new SH_Walker_TaxonomyDropdown(),
                'show_option_all'    => '',
                'show_option_none'   => '',
                'option_none_value'  => '-1',
                'orderby'            => 'ID',
                'order'              => 'ASC',
                'show_count'         => 0,
                'hide_empty'         => 1,
                'child_of'           => 0,
                'exclude'            => '',
                'include'            => '',
                'echo'               => 1,
                'selected'           => esc_attr($categoria),
                'hierarchical'       => 0,
                'name'               => $this->get_field_name('categoria'),
                'id'                 => $this->get_field_id('categoria'),
                'class'              => 'postform',
                'depth'              => 0,
                'tab_index'          => 0,
                'taxonomy'           => 'category',
                'hide_if_empty'      => false,
                'value_field'        => 'slug',
                'value'              => 'slug'
              ); 

              wp_dropdown_categories( $args ); 
            ?> 
            <div style="font:12px; color:#666;">Caso queira exibir uma categoria especifica selecione uma categoria, só sera exibida as postagens desta categoria.<br>Deixe como "Todas Categorias" para exibir todos os posts com ou sem categorias.</div>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('design'); ?>" > <?php _e("Layout do Widget:"); ?></label>
            
            <select name="<?php echo $this->get_field_name('design'); ?>" id="<?php echo $this->get_field_id('design'); ?>" class="postform">
              <option <?php echo (esc_attr($design) == 1 ? 'selected="selected"' : ''); ?> class="level-0" value="1">Design Padrão</option>
              <option <?php echo (esc_attr($design) == 2 ? 'selected="selected"' : ''); ?> class="level-1" value="2">Design 2</option>
              <option <?php echo (esc_attr($design) == 3 ? 'selected="selected"' : ''); ?> class="level-2" value="3">Design 3</option>
              <option <?php echo (esc_attr($design) == 4 ? 'selected="selected"' : ''); ?> class="level-2" value="4">Design 4</option>
              <!-- option <?php echo (esc_attr($design) == 5 ? 'selected="selected"' : ''); ?> class="level-2" value="5">Design 5</option -->

            </select>
 
            </p>

        
    <?php

  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['categoria']    = (!empty($new_instance['categoria'])    ?   strip_tags($new_instance['categoria'])  : '');
    $instance['title']        = (!empty($new_instance['title'])   ?   strip_tags($new_instance['title']) : '');
    $instance['quantidade']   = (!empty($new_instance['quantidade'])   ?   strip_tags($new_instance['quantidade']) : '');
    $instance['design']       = (!empty($new_instance['design'])   ?   strip_tags($new_instance['design']) : '');
    return $instance;
  }

}

add_action("widgets_init",function(){register_widget("posts_recentes"); });





