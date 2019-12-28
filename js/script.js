
$(function(){ 
 

	// $(".photo img").hover(
	// 	alert('over');
	// 	function(){
	// 	  $(this).find('.blocove').stop().animate({
	// 	     width: 50%
	// 	  },'slow');
	// 	},
	// 	function() {
	// 	  $(this).find('.blocove').stop().animate({
	// 	     width: 0 
	// 	  },'slow');
	// });


	$("#svgContainer").HTMLSVGconnect({
        stroke: "#bc84d7",
        strokeWidth: 5,
        orientation: "auto",
        paths: [
          { start: "#diagrama_metodologia_1", end: "#diagrama_metodologia_2", },
          { start: "#diagrama_metodologia_2", end: "#diagrama_metodologia_3", }
        ]
  	}); 

  	$("#svgContainer2").HTMLSVGconnect({
        stroke: "#bc84d7",
        strokeWidth: 5,
        orientation: "auto",
        paths: [
          { start: "#diagrama_metodologia_4", end: "#diagrama_metodologia_5", },
          { start: "#diagrama_metodologia_5", end: "#diagrama_metodologia_6", }
        ]
  	}); 


		$('select#turmas').append('<option disabled selected value="">Selecione</option>');
		$('select#curso').append('<option disabled selected value="">Selecione</option>');
		$('select#curso').find('option').hide();

	
	
	$('select#turmas').change(function(){
		
		$('select#curso').find('option').hide();
		$('select#curso').append('<option disabled selected value="">Selecione</option>');

		switch($(this).val()) {
		  case "Tijuca":
		    	$('select#curso').find('option[value="Grupos para Vestibulares"]').show();
				$('select#curso ').find('option[value="Grupos para Ensino Fundamental"]').show();
		    break;
		  case "Botafogo":
		    	//curso
		    	$('select#curso').find('option[value="Grupos para Vestibulares"]').show();
		    break;
		     
		  	default:
		   		$('select#curso').find('option').hide();
		}

		
	});

	$('#curso').on('click', function(){
		if($('select#turmas').val() == null)
			alert("Selecione um local primeiro para o sistema carregar os cursos");
	});

	    
	    //For Firefox we have to handle it in JavaScript 
		var vids = $("video"); 
		$.each(vids, function(){
		       this.controls = false; 
		}); 
		//Loop though all Video tags and set Controls as false

		$("video").on('click', function() {
			  if (this.paused) {
			  	this.controls = true; 
			  } else {
			  	this.pause();
			  	this.controls = false; 
			  }
		});


	$('.photo .awesome-img').on('hover', function(){
		var thisheight = $('.photo .awesome-img').height();
		var pxheight = thisheight+"px";
		$('.blocove').css('height', pxheight);
	});

	// $('.photo .awesome-img').hover(
	// 	function(){
	// 		var bloco = $(this).before('.blocove');
			
	// 		$(`.blocove`).show().stop().animate({
	// 			top: '0%'
	// 		}, 500);   
  
	// 	console.log('pau no cu');
	// 	}
	// );


	// $('.tipo_5 .bloco_post > .thumbnail_post').hover(
	// 	function(){
	// 		$(this).stop().animate({
	// 			"background-size": "150%"
	// 		}, 500);
	// 	},
	// 	function(){

	// 		$(this).stop().animate({
	// 			"background-size": "100%"
	// 		}, 'fast');
	// 	}
	// );


	// $('.blocove').('height', $('.photo').height());
	// $('.blocove').('width', $('.photo').width());
	    /*---------------------
    Venobox
  --------------------- */
  var veno_box = $('.venobox') ;
  veno_box.venobox({
        framewidth: '60%',        // default: ''
        frameheight: '60%',       // default: ''
        border: '0px',             // default: '0'
        bgcolor: '#5dff5e',         // default: '#fff'
        titleattr: 'data-title',    // default: 'title'
        numeratio: true,            // default: false
        infinigall: true
    });

  
	$('#botao_pesquisa.fa-search').on('click', function(){
		
		if($('#barra_pesquisa').is(':hidden'))
	    {
	      $('#barra_pesquisa').show().stop().animate({top:'0'},800);
	    }else{
	      $('#barra_pesquisa').stop().animate({top:'-80px'}, 800).hide();
	    }
	});

	
			
});





