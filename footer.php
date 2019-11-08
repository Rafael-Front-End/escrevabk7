 <?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Under
 */
?>  
    <div class="barramidia">
        <h3><a href="<?php echo get_page_link( get_page_by_path( 'na-midia' ) ); ?>">Estamos na mídia</a></h3>
        <div class="col-md-3"> <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/logos/globo.png'> </div>
        <div class="col-md-3"> <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/logos/infomoney.png'> </div>
        <div class="col-md-3"> <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/logos/terra.png'> </div>
        <div class="col-md-3"> <img src='<?php bloginfo( 'template_directory' ); ?>/imagens/logos/mundo_marketing.png'> </div>
    </div>
		<footer class="row" id="rodape"> 
			  <div style='' class="rodape1">
          
            <div class='container'>
              <?php dynamic_sidebar('rodape');?>
            </div>
			    
			  	
		    </div><!-- .container -->
		     <section class="copyright col-md-12"> 
          <div class="container">
            <a class="pull-left" href='<?php echo esc_url(the_permalink());?>'><img src='<?php bloginfo( 'template_directory' ); ?>/imagens/maracaescreva.png'></a>
            <?php dynamic_sidebar('rodape2'); ?>
            <a class="pull-right" href='https://agenciabk7.com.br/'><img src='<?php bloginfo( 'template_directory' ); ?>/imagens/marcabk7.png'></a>
          </div><!-- .container -->
        </section>
		</footer><!-- # -->
	</div><!-- #conteudo_site -->
</div><!-- #site --> 


	<!-- Scrits do site -->
 


    <script type="text/javascript" language="javascript"></script>
     
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery.html-svg-connect.js" language="javascript"></script>

    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-cover-master/jquery.cover.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/plugins.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jssor/jssor.slider.min.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/greensock.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/layerslider.transitions.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/layerslider.kreaturamedia.jquery.js" language="javascript"></script>
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/jQueryRotate.js" language="javascript"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/lib/venobox/venobox.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/lib/isotope/isotope.pkgd.min.js"></script>
    
    
    <script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/js/script.js?version=0.0.0.4" language="javascript"></script>


	<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=1516588398635174";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    </script>




</body>
</html>
    <?php wp_footer(); ?>
 