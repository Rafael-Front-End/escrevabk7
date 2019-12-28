<?php
	$html = '<h2>Configurações para o Google</h2>';
	$html_img = '';
	//Carrega os dados do google
	$tema_zflag_google = array();
	if(get_option('tema_zflag_google')){
		$tema_zflag_google = json_decode(get_option('tema_zflag_google'));
		$tema_zflag_google = (array) $tema_zflag_google;
	}

	//Edita os dados
	if(!empty($_POST['tag_v_adsense'])){
		$tag_v_adsense = htmlspecialchars_decode(str_replace("\\", "", $_POST['tag_v_adsense']));
		$tag_v_analytics = htmlspecialchars_decode(str_replace("\\", "", $_POST['tag_v_analytics']));

		$tema_zflag_google = ['tag_v_adsense' => $tag_v_adsense, 'tag_v_analytics' => $tag_v_analytics];
		
		delete_option('tema_zflag_google');
		if(add_option('tema_zflag_google', json_encode($tema_zflag_google))){
			$html .= "<div class=\"alert alert-success\" role=\"alert\">
					  <strong>Item Salvo!</strong> 
					</div>";
		}
	}



	if(!empty($_GET['acao'])){
		if($_GET['acao'] == 'editar'){
			
			$tabela_cadastro = 
			'
				<form id="zflag_form_galeria" name="salvar" method="post" enctype="multipart/form-data">
				            <input type="hidden" id="id" class="form-control"  name="id" value="'.$id.'">
						<div class="form-group">
				            <label for="tag_v_adsense">Tag de verificação adsense</label>
				            <input type="text" id="tag_v_adsense" class="form-control"  name="tag_v_adsense" value="'.htmlspecialchars(str_replace("\\", "", $tema_zflag_google['tag_v_analytics'])).'">
				        </div>
				        <div class="form-group">
				            <label for="tag_v_analytics">Script Google Analytics</label>
				            <input type="text" id="tag_v_analytics" class="form-control"  name="tag_v_analytics" value="'.htmlspecialchars(str_replace("\\", "", $tema_zflag_google['tag_v_adsense'])).'">
				        </div>
				       
				        <div class="form-group">
				            <button name="salvar" class="salva btn btn-primary" />
				                Salvar
				            </button>
				        </div>
					</form>
					

			';

			$html .= $tabela_cadastro;
		}

	}
