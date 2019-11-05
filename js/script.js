
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


	
	$(".vidWrapper").click(function(event) {    
	    if($(event.target).hasClass('vidWrapper')) {
	        event.preventDefault();
	        console.log('ok');
	        // Additional event handling code ...
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





