<?php

class zflag_depoimentos extends WP_Widget
{ 
    function __construct()
    {
        parent::__construct("zflag_depoimentos", "Zflag Depoimentos", array('description' => "Exibe os depoimentos"));
    }

  public function widget($args, $instance)
  {
        if(isset($instance['title'])){
            $title = apply_filters('widget_title', $instance["title"]);
        }
        echo $args[" "];
        
        global $do_not_duplicate;
        $depoimentocat = get_category_by_slug('depoimentos');
                
        $quantidade = (!empty($instance['quantidade']) ? $instance['quantidade'] : 1);
        $design = $instance['design'];

                
        $query_args =  array(
                'showposts' => $quantidade,  
                'category_name' => 'depoimentos'
        );
       
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
                
                

                  $html_categoria_cultura .="
                      <a href=\"{$url}\" class=\"depoimentos_recentes\">
                        <div class=\"thumbnail_post\" style=\"background-image:url($img);\"><img src=\"{$img}\"></div>
                        <div class=\"content_post\">
                          <h4>{$titulo}</h4>
                          <p><span>{$resumo}</span></p>
                        </div>
                      </a>
                  ";
                  
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

        $titulo_plugin_html = !empty($titulo_plugin) ? "<h3 class='testimonialstitulo'>".$titulo_plugin."</h3>" : '';
        echo "
        <div class=\"".$tipo_layout." destaque_categorias\">
            $titulo_plugin_html 
            $html_categoria_cultura
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
            <label for="<?php echo $this->get_field_id('quantidade'); ?>" > <?php _e("Quantidade de depoimentos:"); ?></label>
            <input type='text' id="<?php echo $this->get_field_id('quantidade'); ?>" name="<?php echo $this->get_field_name('quantidade'); ?>" class="widefat" value="<?php echo esc_attr($quantidade); ?>">
            <div style="font:12px; color:#666;">Digite o numero máximo de depoimentos para serem exibidos</div>
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
    $instance['title']        = (!empty($new_instance['title'])   ?   strip_tags($new_instance['title']) : '');
    $instance['quantidade']   = (!empty($new_instance['quantidade'])   ?   strip_tags($new_instance['quantidade']) : '');
    $instance['design']       = (!empty($new_instance['design'])   ?   strip_tags($new_instance['design']) : '');
    return $instance;
  }

}

add_action("widgets_init",function(){register_widget("zflag_depoimentos"); });





