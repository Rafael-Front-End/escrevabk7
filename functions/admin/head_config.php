<?php
	$html 	= 	'<h2>Cabeçalho do site (tag head)</h2>';
	$html 	.= 	'<p>Adicione conteudo entre a tag head do seu site</p>';
	$html_img = '';
	//Carrega os dados do google
	$tema_zflag_head = array();
	if(get_option('tema_zflag_head')){
		$tema_zflag_head = json_decode(get_option('tema_zflag_head'));
		$tema_zflag_head = (array) $tema_zflag_head;
	}

	//Edita os dados
	if(!empty($_POST['head_html'])){
		$head_html = htmlspecialchars_decode(str_replace("\\", "", $_POST['head_html']));

		$tema_zflag_head = ['head_html' => $head_html];
		
		delete_option('tema_zflag_head');
		if(add_option('tema_zflag_head', json_encode($tema_zflag_head))){
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
				            <label for="head_html">Adicione um script ao cabeçalho do site</label>
				            <textarea rows="10" type="text" id="head_html" class="form-control"  name="head_html" >'.htmlspecialchars(str_replace("\\", "", $tema_zflag_head['head_html'])).'</textarea>
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
