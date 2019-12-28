<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen 
 * @since Twenty Fifteen 1.0
 */   

  if ( is_single() ) { 

    if (has_post_thumbnail() ) {
        $the_post_thumbnail = get_the_post_thumbnail_url();
    } else { 
        $the_post_thumbnail = "";
    } 
 


    $Categoria = get_the_category();
    $Nome_categoria = $Categoria[0] -> cat_name;
    $Id_categoria = $Categoria[0] -> cat_ID;
    $Id_categoria1 = $Categoria[1] -> cat_ID;
    $link_categoria = get_category_link($Id_categoria);
    $author = get_the_author();
    $contador_img_galeria = 0;
    $id_post = get_the_ID();
    $views = getPostViews($id_post);
    $img   = $the_post_thumbnail; 
    $tipo_media = get_post_meta($id_post, "meta-box-tipo-featured_media", true);
    $url_media = get_post_meta($id_post, "meta-box-url-featured_media", true);
    $object_tags = wp_get_post_tags($id_post);
    if(is_array($object_tags)){
      if(count($object_tags) > 1){
        foreach ($object_tags as $key => $value) {
          $vetor_tags[] = $value->name;
        }
        $str_tags = implode($vetor_tags, ', ');
      }
    }
    $site_description =  get_the_title(); 
    
  } else {
    $site_description = get_bloginfo('name')." - ".get_bloginfo('description');
  }
  

?><!DOCTYPE html> 
<html <?php language_attributes(); ?> class="no-js">
<head>

    <!-- <title><?php wp_title( '-', true, 'right' ); ?></title> -->
    <title><?php

      global $page, $paged;

      wp_title( '|', true, 'right' );

      // Add the blog name.
      bloginfo( 'name' );

      // Add the blog description for the home/front page.
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
              echo " | $site_description";

      // Add a page number if necessary:
      if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
              echo esc_html( ' | ' . sprintf( __( 'Página %s', 'twentyten' ), max( $paged, $page ) ) );





    ?></title>


    <meta name="robots" content="index, follow">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="author" content="Rafael Guimarães Barbosa">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $str_tags;?>">

    <!-- Meta tags do facebook-->
    <meta property="fb:app_id" content="406192399779895">
    <meta property="fb:admins" content="100002305938225">

 
    <!-- Meta tags do facebook-->
    <meta property="og:image" content="<?php echo $img; ?>">
    <meta property="og:url" content="<?php esc_url(the_permalink());?>">
    <meta property="og:title" content="<?php wp_title( '-', true, 'right' );?>">
    <meta property="og:site_name" content="<?php bloginfo('name');?>">
    <meta property="og:description" content="<?php echo $site_description;?>">
    <meta property="og:type" content="website"> 
    <!-- meta property="article:tag" content="<?php echo $str_tags;?>" -->
    <meta name="description" content="<?php echo $site_description;?>" />
    



    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php  
      wp_head(); 
    ?>
    
   
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-1.11.1.min.js" language="javascript"></script>        
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/bootstrap.min.js" language="javascript"></script>
    <script src="https://apis.google.com/js/platform.js" async defer><!-- google plus -->
      {lang: 'pt-BR'}
    </script>
     
    <!-- EstilizaÃ§Ãµes do site -->

    <!-- link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/img/favicon.png" type="image/x-icon" -->
    <link rel="shortcut icon" href="<?php bloginfo('template_directory')?>/img/favicon.png" sizes="32x32" />
    <link href="<?php bloginfo( 'template_directory' ); ?>/assets/css/layerslider.css" type="text/css" media="all" rel="stylesheet" />
    <link href="<?php bloginfo( 'template_directory' ); ?>/css/bootstrap.min.css" type="text/css" media="all" rel="stylesheet" />
    <link href="<?php bloginfo( 'template_directory' ); ?>/lib/venobox/venobox.css" rel="stylesheet">




    <link href="<?php bloginfo( 'template_directory' ); ?>/js/jqueryslimscroll/examples/libs/prettify/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jqueryslimscroll/examples/libs/prettify/prettify.js"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jqueryslimscroll/jquery.slimscroll.js"></script>
  
    <link href="<?php bloginfo( 'template_directory' ); ?>/js/jqueryslimscroll/examples/style.css" type="text/css" rel="stylesheet" />

    <link href="<?php bloginfo( 'template_directory' ); ?>/fonts/fontawesome/css/all.min.css" type="text/css" media="all" rel="stylesheet" />
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/fonts/fontawesome/js/all.min.js" language="javascript"></script>
    <script src="https://kit.fontawesome.com/a4502b4008.js"></script>

    <link href="<?php echo bloginfo('stylesheet_url'); ?>?version=0.0.0.9" type="text/css" media="all" rel="stylesheet" />
    <link href="<?php bloginfo( 'template_directory' ); ?>/css/escreva.css" type="text/css" media="all" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory')?>/imagens/fav32x32.png" />
    
     <?php echo !empty($tema_zflag_google['tag_v_analytics']) ? $tema_zflag_google['tag_v_analytics'] : ''; ?>

    <?php  echo !empty($tema_zflag_google['tag_v_adsense']) ? $tema_zflag_google['tag_v_adsense'] : ''; ?>
    
    <?php  echo !empty($tema_zflag_head['head_html']) ? $tema_zflag_head['head_html'] : ''; ?>
    
      
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <div id="fb-root"></div>
      <script><!-- facebook -->
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '737161659782221',
          xfbml      : true,
          version    : 'v2.5'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=737161659782221";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
    
</head> 

<body>
  <?php require_once('topo.php');?>
  