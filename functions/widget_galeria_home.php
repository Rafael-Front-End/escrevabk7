<?php

/* Widget para ZflagGalerias com posts recentes */

class ZflagGaleriaHome extends WP_Widget
{
    function __construct()
    {
        parent::__construct("ZflagGaleria_home", "Zflag portfólio", array('description' => "Exibe o porfólio principal"));
    }

  public function widget($args, $instance)
  {
        echo $args["before_widget"];

        $title = $instance['title'];
        $html_categorias = '';
        $html_galeria_home = '';
        if(get_option('tema_zflag_galeria_home')){
          $tema_zflag_galeria_home = json_decode(get_option('tema_zflag_galeria_home'));
          $tema_zflag_galeria_home = (array) $tema_zflag_galeria_home;
           $blocov = NULL;
           $cont = 0;
          foreach ($tema_zflag_galeria_home as $key => $value) {
            $vetor_galeria_home  = (array) $value;
            $titulo = $vetor_galeria_home['titulo'];
            $slug = str_replace(" ", "_", trim($titulo));

             $html_categorias .= '<li>
                            <a href="#" data-filter=".'.$slug.'">'.$titulo.'</a>
                          </li>';


            $imagem = $vetor_galeria_home['imagem'];
            if($imagem != NULL){
              $vetor_img = explode(', ', $imagem);
              
              foreach ($vetor_img as $key => $value) {
                $thumbnail   =   wp_get_attachment_image_src(intval($value), 'medium');
                $thumbnail   =   $thumbnail[0];
                $img         =   wp_get_attachment_url($value);
                

                if($cont == 0){

                  $blocov = '<div class="blocove azul">
                              <div class="centervertical">
                                <img src="'.get_bloginfo( 'template_directory' ).'/imagens/icons/iconportfolio1.png">
                                <h3>Debates sobre temas atuais
</h3>
                                <p>As discussões sobre atualidades despertam no estudante a capacidade de reflexão e de argumentação, algo fundamental para produzir um texto, de modo eficiente e aprofundado.</p>
                              </div>
                          </div>';
                }else  if($cont == 1){
                    $blocov = '<div class="blocove rochoo">
                              <div class="centervertical">
                              <img src="'.get_bloginfo( 'template_directory' ).'/imagens/icons/icone2.png">
                              <h3>Grupos de até 15 alunos</h3>
                              <p>O trabalho em grupos pequenos, com até 15 alunos, torna as aulas personalizadas fugindo dos modelos ou fórmulas “prontas”.</p>
                          </div>
                          </div>';
                }else  {
                    $blocov = '<div class="blocove vermelho">
                              <div class="centervertical">
                              <img src="'.get_bloginfo( 'template_directory' ).'/imagens/icons/iconportfolio3.png">
                              <h3>Ambiente aconchegante</h3>
                              <p>Ambiente confortável, que propicia condições ideais para serenidade do aprendizado.</p>
                          </div>
                          </div>';
                }


                $cont++;

                $html_galeria_home .="
                  <!-- single-awesome-project start -->
                    <div class=\"photo {$slug}\">
                      <div class=\"single-awesome-project\">
                        <div class=\"awesome-img\" style=\"background-image: url({$img});\">
                          {$blocov} 
                          <img width=\"100%\" height=\"auto\" class=\"thumbnailhide\" src=\"{$thumbnail}\" alt=\"\" />
                        </div>
                      </div>
                    </div>
                    <!-- single-awesome-project end -->
                 ";

              }
            }

            

          }

          $galeria_home_html = '
            <!-- Start portfolio Area -->
            <div id="pagina_portfolio">
              <div id="portfolio" class="portfolio-area area-padding fix">
                <div class="row">
                  <!-- Start Portfolio -page -->
                  <div class="awesome-project-content">
                    '.$html_galeria_home.'
                  </div>
                </div>
              </div>
            </div>
            <!-- awesome-portfolio end -->
          ';

            echo $galeria_home_html;
        }
           
    echo $args["after_widget"];
  }
 
  public function form($instance)
  {


    if(isset($instance['title']))
    {
      $title = $instance['title'];
    }
    else
    {
      $title = "";
    }


    echo 'As configurações estão presentes no menu "Configurações do tema" -> "Galeria_home", é necessario esta com o tema zflag instalado no wordpress';
  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();

    return $instance;
  }
}

add_action("widgets_init",function(){register_widget("ZflagGaleriaHome"); });