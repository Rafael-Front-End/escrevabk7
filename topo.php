<?php
    $itens_menu_1 = (array) wp_get_nav_menu_items('menu_1');

    foreach ($itens_menu_1 as $key => $value) {
      $value = (array) $value;
      $html_li_menu_1 .= "<li><a href=\"".$value['url']."\"><span>".$value['title']."</span></a></li>";
    }

    $itens_menu_3 = (array) wp_get_nav_menu_items('menu_3');

    foreach ($itens_menu_3 as $key => $value) {
      $value = (array) $value;
      if($value['title'] == 'Pré-matrícula'){
        $html_li_menu_3 .= "<li><a class='prematricula' href=\"".$value['url']."\"><span>".$value['title']."</span></a></li>";
      }else{
        $html_li_menu_3 .= "<li><a href=\"".$value['url']."\"><span>".$value['title']."</span></a></li>";
      }
    }

  ?>
<div id="site">
  <div id="conteudo_site" class=""> 
    <?php dynamic_sidebar('config_geral'); ?>
    <!-- Static navbar -->
    <div id="social_icons_top" class="pull-left"> 
          <div class="container">
            <div class="col-md-4">  
            </div>
            <div class="col-md-8">
              <a class="botaoazul rocho" href=''>Redação para Ensino Fundamental</a>
              <a class="botaoazul" href=''>Redação para Vestibulares</a>
              <ul >
                <li><i class="fa fas fa-phone-alt"></i><span>21 99698-5031</span></li>
                <li><a href='https://www.facebook.com/cursoescreva'><i class="fa fab fa-facebook-square"></i></a></li>
                <li><a href='https://www.instagram.com/cursoescreva/'><i class="fa fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
    <nav id="menu_topo" class="col-md-12 navbar navbar-default navbar-static-top">
        
      <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Alternar navegação</span>
              <span class="icon-bar top-bar"></span>
              <span class="icon-bar middle-bar"></span>
              <span class="icon-bar bottom-bar"></span>
            </button>

        </div>
        <div class="top-menu-content">
          <a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php
            if(get_header_image()){
                echo "<img id=\"pequena_logo_topo\" class=\"img-responsive\" alt='".( get_bloginfo( 'title' ) )."' src=\"".get_header_image()."\">";
            }else{
              echo "<h1 class='logotxt'>".get_bloginfo( 'title' )."</h1>";
            }
          ?>
          </a>

          <?php
              wp_nav_menu(array(
                  'menu'              => 'menu_2',
                  'theme_location'    => 'primary',
                  'depth'             => 2,
                  'container'         => 'div',
                  'container_class'   => 'collapse navbar-collapse',
                  'container_id'      => 'navbar2',
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker())
              );
          ?>  
          
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li id="logo-menu" >
                <a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php
                    if(get_header_image()){
                        echo "<img class=\"img-responsive\" alt='".( get_bloginfo( 'title' ) )."' src=\"".get_header_image()."\">";
                    }else{
                      echo "<h1 class='logotxt'>".get_bloginfo( 'title' )."</h1>";
                    }
                  ?>
                </a>
              </li>
              <?php echo $html_li_menu_1; ?>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
          
        <ul id='menu_3' class="">
          <?php echo $html_li_menu_3; ?>
        </ul>

      </div><!-- .container -->
    </nav>
<!--     <div id="topo_1" class="col-md-12">   
      <div class="container">
        <div id="banner_topo" class="col-md-8">
          <?php dynamic_sidebar('topo_publicidade');?>
        </div>
      </div><!-- .container --
    </div>
   -->
    <div class="clearfix"></div>  