
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


	
		$('select#turmas').append('<option disabled selected value="">Selecione</option>');
		$('select#dia').append('<option disabled selected value="">Selecione</option>');
		$('select#horario').append('<option disabled selected value="">Selecione</option>');
		$('select#dia').find('option').hide();
		$('select#horario').find('option').hide();
	
	$('select#turmas').change(function(){
		
		$('select#dia').find('option').hide();
		$('select#horario').find('option').hide();
		$('select#dia').append('<option disabled selected value="">Selecione</option>');
		$('select#horario').append('<option disabled selected value="">Selecione</option>');

		switch($(this).val()) {
		  case "Tijuca":
		    	$('select#dia').find('option[value="Quinta-Feira"]').show();
				$('select#horario ').find('option[value="18:00"]').show();
		    break;
		  case "Botafogo":
		    	//Dia
		    	$('select#dia').find('option[value="Segunda-Feira"]').show();
		    	$('select#dia').find('option[value="Terça-Feira"]').show();
		    	$('select#dia').find('option[value="Quarta-Feira"]').show();
		    	$('select#dia').find('option[value="Quinta-Feira"]').show();
		    	$('select#dia').find('option[value="Sexta-Feira"]').show();
		    	//Horario
				$('select#horario ').find('option[value="18:10 - 19:30"]').show();
				$('select#horario ').find('option[value="16:10 - 17:30"]').show();
		    break;
		     case "Alunos do 5º ao 7º":
		    	//Dia
		    	$('select#dia').find('option[value="Sábados"]').show();
		    	//Horario
				$('select#horario ').find('option[value="08:30 - 09:45"]').show();
		    break;
		    case "Alunos do 8º e 9º":
		    	//Dia
		    	$('select#dia').find('option[value="Sábados"]').show();
		    	//Horario
				$('select#horario ').find('option[value="10:00 - 11:15"]').show();
		    break;
		  	default:
		   		$('select#dia').find('option').hide();
				$('select#horario').find('option').hide();
		}

		
	});


    $("#svgContainer").HTMLSVGconnect({
        stroke: "#bc84d7",
        strokeWidth: 5,
        orientation: "auto",
        paths: [
          { start: "#diagrama_metodologia_1", end: "#diagrama_metodologia_2", },
          { start: "#diagrama_metodologia_2", end: "#diagrama_metodologia_3", }
        ]
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
  veno_box.venobox();

  
	$('#botao_pesquisa.fa-search').on('click', function(){
		
		if($('#barra_pesquisa').is(':hidden'))
	    {
	      $('#barra_pesquisa').show().stop().animate({top:'0'},800);
	    }else{
	      $('#barra_pesquisa').stop().animate({top:'-80px'}, 800).hide();
	    }
	});

	
			
});





