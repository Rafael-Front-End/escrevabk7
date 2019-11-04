<?php
/**
 * @package Under
 */   


    if ( has_post_thumbnail() ) {
        $the_post_thumbnail = get_the_post_thumbnail_url();
    } else { 
        $the_post_thumbnail = "";
    } 

    setPostViews(get_the_ID());
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

    if($url_media != NULL){
        if($tipo_media == 1){
            $featured_video = "<iframe src=\"{$url_media}\" allowfullscreen width=\"100%\" height=\"380\" frameborder=\"0\"></iframe>";
        }else if($tipo_media == 2){
            $featured_audio = "
                <audio id='media_post' controls>
                    <source src=\"{$url_media}\" type=\"audio/mpeg\">
                </audio>
            ";
        }
    }
 
?>
 <main id="main" class="site-main container" role="main">
        <div id="line_post" class="col-md-8">
            <header id="pagina_cabecalho">
                <div class="col-md-12">
                    <span class="meta-category"><a href="<?php echo $link_categoria;?>" class="category-2"><?php echo ($Id_categoria != 1 ? strtolower($Nome_categoria) : ''); ?></a></span>
                    <?php  
                        the_title( '<h1>', '</h1>' );
                        echo '<h4>'.get_nskw_subtitle().'</h4>';
                        echo '
                            <div class="col-md-12 entry-meta">
                                <div class="meta-item date">
                                    <span class="updated">
                                        '.data_amigavel().'
                                    </span>
                                </div>
                                <div class="meta-item comments">
                                    <a href="#comments">
                                        '.get_comments_number().' Comentarios
                                    </a>
                                </div>
                                <div class="meta-item author">
                                    <span class="vcard author">
                                        <span class="fn">
                                            Por '.get_the_author_link().'
                                        </span>
                                    </span>
                                </div>
                                <div class="meta-item views">
                                    '.$views.' Visualizações
                                </div>
                            </div>';
                    ?>
                </div>

            </header>

            <section id="post_thumbnail" class="">
            <?php 
                if($featured_video){
                    echo $featured_video;
                    
                }else{
                    echo "<img src=\"{$img}\" alt=\"\" id=\"post_thumbnail\">";
                }
            ?>

            </section>
            <div id="topo_mostra_autor">
                <img src="<?php echo get_avatar_url(get_the_author_ID());?>" alt="">
                <div class="meta-author-wrapped">Publicado por <span class="vcard author"><span class="fn"><?php echo get_the_author_link(); ?></span></span></div>
            </div>
            <?php echo $featured_audio;?>
            <section class="conteudo_post">

                <div id="texto_post">
                    <?php  the_content(); ?>
                </div>
                
                <div id='inner_post_widget'> <?php dynamic_sidebar('inner_post_widget'); ?></div>
                
            </section>
            <section id="comenarios">
                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?> 
            </section>
        </div>
        <?php get_sidebar(); ?>
</main><!-- #main -->
