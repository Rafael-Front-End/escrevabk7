<?php

/* Widget para slide_pagina_inicials com posts recentes */

class slide_pagina_inicial extends WP_Widget
{
    function __construct()
    {
        parent::__construct("slide_pagina_inicial", "Zflag Slide principal", array('description' => "Exibe o slide principal"));
    }

  public function widget($args, $instance)
  {
       echo $args["before_widget"];

       
        if(get_option('tema_zflag_slide_principal')){
          $tema_zflag_slide_principal = json_decode(get_option('tema_zflag_slide_principal'));
          $tema_zflag_slide_principal = (array) $tema_zflag_slide_principal;
           $contador_de_post = 0;
          foreach ($tema_zflag_slide_principal as $key => $value) {
            $contador_de_post++;
            $value = (array) $value;
            $titulo = $value['titulo'];
            $img_align = $value['img_align'];
            $texto = stripslashes($value['texto']);
            $imagem = $value['imagem'];
            $imagem_fundo = $value['imagem_fundo'];
            $link = $value['link'];
            $background = $value['background'];


            if(!empty($value['video'])){
              $lado_imagem = '<iframe src="'.$value['video'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }else{
              $lado_imagem = "<img class='img-fluid' src='{$imagem}'>";
            }

            $style = "
              <style>
                  .fundoslide{
                    position: absolute;
                    width: 100%;
                    z-index: -2;
                    height: 520px;
                     
                    
                  }
                </style>

            ";
            $html_destaques .= " 

                <div  style='background-image: url(\"{$imagem_fundo}\");' class=\"item ".($contador_de_post == 1 ? 'active' : '')."\">
                  <div style='".($background != NULL ? 'background-color:rgb('.$background.', 0.8); !important' : '')."' class='fundoslide'></div>
                  <div class=\"container desktop\">";

                    if($img_align == 'Esquerda'){
                        $html_destaques .="<div class='lado-imagem imagem_slide'>$lado_imagem</div>";
                      }

                    $html_destaques .= " 
                       <div class='lado-texto ".($img_align == 'Direita' ? 'direita' : '')." '>
                        <h1>{$titulo}</h1>
                        <p>{$texto}</p>
                         <div class='botaonoslidedahomeolocoqueclassegrande'><a href='".$link."' class='btn'>VER MAIS</a></div>
                      </div>
                      ";
                        
                      if($img_align == 'Direita'){
                        $html_destaques .="<div class='lado-imagem imagem_slide'>$lado_imagem</div>";
                      }


            $html_destaques .= "
                      
                  </div>";

            $html_destaques .= " 
                  <div class=\"container mobile\" style='background-image:url(\"{$imagem}\");'>
                  <div class=\"background_txt_thumb\"></div>
                  ";

                    $html_destaques .= " 
                       <div class='lado-texto'>
                        <h1>{$titulo}</h1>
                        <p>{$texto}</p>
                        <a href='".$link."' class='btn'>VER MAIS</a>
                      </div>
                      ";

            $html_destaques .= "
                  </div>";


            $html_destaques .= "
                </div>
                <div id=\"#rolldownslide\"></div>
            ";

          }

         

          $slide_html = 
          "<div class='slide_home carousel_tipo_1'>
              <div id=\"myCarousel{$id_bootstrap_carousel}\" class=\"carousel slide carousel-fade\" data-ride=\"carousel\">
                <!-- Indicators -->
                <ol class=\"carousel-indicators\">
                  <li data-target=\"#myCarousel{$id_bootstrap_carousel}\" data-slide-to=\"0\" class=\"\"></li>
                  <li data-target=\"#myCarousel{$id_bootstrap_carousel}\" data-slide-to=\"1\" class=\"\"></li>
                  <li data-target=\"#myCarousel{$id_bootstrap_carousel}\" data-slide-to=\"2\" class=\"active\"></li>
                </ol>
                <div class=\"carousel-inner\" role=\"listbox\">
                  $html_destaques
                </div>
                <a class=\"left carousel-control\" href=\"#myCarousel{$id_bootstrap_carousel}\" role=\"button\" data-slide=\"prev\">
                  <img class='seta_esq' src=\"".get_bloginfo( 'template_directory' )."/imagens/icons/seta_esq.png\">
                  <span class=\"sr-only\">Previous</span>
                </a>
                <a class=\"right carousel-control\" href=\"#myCarousel{$id_bootstrap_carousel}\" role=\"button\" data-slide=\"next\">
                  <img class='seta_dir' src=\"".get_bloginfo( 'template_directory' )."/imagens/icons/seta_dir.png\">
                  <span class=\"sr-only\">Next</span>
                </a> 
              </div>
            </div>";

            echo '<header id="pagina_cabecalho">'.do_shortcode($slide_html).'</header>'.$style;
        }
           
    echo $args["after_widget"];
  }
 
  public function form($instance)
  {
    echo 'As configurações estão presentes no menu "Configurações do tema" -> "Slide", é necessario esta com o tema zflag instalado no wordpress';
  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();

    return $instance;
  }
}

add_action("widgets_init",function(){register_widget("slide_pagina_inicial"); });