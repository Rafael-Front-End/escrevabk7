<?php
header('Content-Type: text/plain; charset=utf-8');
if($_GET['get_remote_post'] == '234@5563111$2'):
	 
	function set_uri($url){
        $url         = urldecode(preg_replace("/(%C2%A0)+/i", '+', urlencode($url)));//remove character de espaço incoveniente
        
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';

        $b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        $url    =   utf8_decode($url);

        $url    =   strtr($url, utf8_decode($a), $b);

        $url    =   strip_tags(trim($url));

        $url    =   str_replace(" ", "-",$url);

        $url    =   str_replace(array("-----","----","---","--"),"-",$url);

        return strtolower(utf8_encode($url));

    }

	function Generate_Featured_Image( $image_url, $v_img, $post_id  ){
	    $upload_dir = wp_upload_dir();
	    $image_data = file_get_contents($v_img["tmp_name"]);
	    $image_url = utf8_encode($image_url);
	    $ext = substr($image_url, strrpos($image_url, '.'));
	    $filename = set_uri(str_replace($ext, '', $image_url)).$ext;
	    
	    if(wp_mkdir_p($upload_dir['path']))
	      $file = $upload_dir['path'] . '/' . $filename;
	    else
	      $file = $upload_dir['basedir'] . '/' . $filename;
	    file_put_contents($file, $image_data);

	    $wp_filetype = wp_check_filetype($filename, null );
	    $attachment = array(
	        'post_mime_type' => $wp_filetype['type'],
	        'post_title' => sanitize_file_name($filename),
	        'post_content' => '',
	        'post_status' => 'inherit'
	    );
	    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
	    require_once(ABSPATH . 'wp-admin/includes/image.php');
	    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
	    $res2= set_post_thumbnail( $post_id, $attach_id );
	}

	$dados = [
		'post_author' => $_POST['post_author'],
	    'post_date' => $_POST['post_date'],
	    'post_title' => rawurldecode($_POST['post_title']),
	    'post_content' => rawurldecode($_POST['post_content']),
	    'post_excerpt' => rawurldecode($_POST['post_excerpt']),
	    'post_status' => $_POST['post_status'],
	    'post_type' => $_POST['post_type'],
	    'comment_status' => $_POST['comment_status'],
	    'post_mime_type' => $_POST['post_mime_type'],
	    'v_cat'   => json_decode(str_replace('\\', '', $_POST['v_cat'])),
	    'thumb' => $_POST['thumb']
	];

	 
	require_once(ABSPATH. 'wp-config.php'); 
	require_once(ABSPATH. 'wp-includes/wp-db.php'); 
	require_once(ABSPATH. 'wp-admin/includes/taxonomy.php');

	if(is_array($dados['v_cat'])):
		foreach ($dados['v_cat'] as $value):
			if(!category_exists($value)):
				echo wp_create_category($value);
			endif;
			$v_cat = get_category_by_slug($value);
			if(!empty($v_cat->term_id)):
				 $dados['post_category'][] = $dados['post_parent'] = $v_cat->term_id;
			endif;
		endforeach;
	endif;
	unset($dados['v_cat']);
	
	if(is_array($dados)): 
		$post_id = wp_insert_post($dados);
		if($post_id) Generate_Featured_Image($dados['thumb'], $_FILES['content_thumb'], $post_id);
		echo $post_id;
 	endif;

	


	exit;

endif;