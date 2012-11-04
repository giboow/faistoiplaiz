$(document).ready(function(){
	initElements();
	initEvents();
});

function initElements(){
	var header = $('header#homeHeader #logo');
	var pos = header.position();
	header.css('top', $(window).height()/2- header.height()/2);
}

function initEvents(){
	$(window).oneTime("1s", openHome);
	$('#leftBlock .beginBt').click(leftClick);
	$('#rightBlock .beginBt').click(rightClick);
	$('.thirdStep .choice .male').click(function(){sexeChoice("homme")});
	$('.thirdStep .choice .female').click(function(){sexeChoice("femme")});
}

function openHome(){
	$('.firstStep').transition({opacity : 0}, function(){
		$(this).remove();
		var time = 1000;
		$('header#homeHeader #logo').transition({top: 0, position: "fixe"}, time);
		$('header#homeHeader').transition({position: "fixe", height: 103}, time, function(){
			$(this).css('border-top', 'solid 2px white');
			$(this).css('border-bottom', 'solid 2px white');
		});
		$('footer#homeFooter').transition({opacity : 1}, time);

	});
}

function leftClick(){
	var time = 1000;
	var el = $('.secondStep #leftBlock');
	el.css('z-index', 100);
	el.find('.contentBlock').transition({opacity : 0}, time);
	el.transition({"margin-left": 0}, time, function(){
		$('.thirdStep').css('display', 'block').addClass('lightBg');
		$('.secondStep').remove();
	});
	$('.secondStep #rightBlock').transition({"margin-left" : "100%"}, time);
	$(document).data('insulte', false);
}

function rightClick(){
	var time = 1000;
	var el = $('.secondStep #rightBlock');
	el.css('z-index', 100);
	el.find('.contentBlock').transition({opacity : 0}, time);
		$('.secondStep #leftBlock').transition({"margin-left": "-100%"}, time);
		el.transition({"margin-left": 0}, time, function(){
		$('.thirdStep').css('display', 'block').addClass('darkBg');
		$('.secondStep').remove();
	});
	$(document).data('insulte', true);
}


function sexeChoice(sexe) {
	var time = 1000;
	$(document).data('sexe', sexe);
	$('.thirdStep #first').transition({opacity : 0}, time, function(){
		$(this).remove();
		$('.thirdStep #second').show(0).transition({opacity : 1}, time);
	})

}

function validName(){
	var form = $('.thirdStep #second .form form');
	var prenom = form.find("input[name=prenom]");
	var url = form.attr('action');
	var datas = {
		prenom : prenom,
		sexe : $(window).data('sexe'),
		insulte: $(window).data('insulte')
	};
	$.ajax({
		url: url,
		type: "POST",
		data : datas,
		dataType: "json",
	}).success(function(response){
		alert(response);
	});

	return false;
}
