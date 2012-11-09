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
	$('header#homeHeader .imgLogo').click(function(){$(document).attr('location', '/');});
	$('#leftBlock .beginBt').click(leftClick);
	$('#rightBlock .beginBt').click(rightClick);
	$('.thirdStep .choice .male').click(function(){sexeChoice("M")});
	$('.thirdStep .choice .female').click(function(){sexeChoice("F")});
	$('.thirdStep #second .form form').submit(validName);
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
	$(document).data('insulte', 0);
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
	$(document).data('insulte', 1);
}


function sexeChoice(sexe) {
	var time = 1000;
	$(document).data('sexe', sexe);
	$('.thirdStep #first').transition({opacity : 0}, time, function(){
		$(this).remove();
		$('.thirdStep #second').show(0).transition({opacity : 1}, time, function(){
			$('.thirdStep #second form input[name=prenom]').focus();
		});
	})

}

function validName(){
	var form = $(this);
	var prenom = form.find("input[name=prenom]").val();
	var url = form.attr('action');
	var datas = new Object;
	datas.prenom = prenom,
	datas.sexe = $(document).data('sexe');
	datas.insulte = $(document).data('insulte');
	$.ajax({
		url: url,
		type: "POST",
		data : datas,
		dataType: "json",
	}).success(function(response){
		$.extend(datas, response);
		drawFinal(datas);
		return false;
	});

	return false;
}


function drawFinal(datas)
{
	var time = 1000;
	console.log(datas);
	var prenom = datas.prenom;
	var phrase = datas.phrase;
	var color = datas.color;
	var link = datas.link;

	var finalStr = new String(phrase);
	finalStr = finalStr.replace("{prenom}", '<span class="prenom">'+prenom+'</span>');
	$(".thirdStep #final #postit .content .phrase").html(finalStr);

	$(".thirdStep #second").transition({opacity : 0}, time, function() {
		$(this).remove();
		$(".thirdStep #final").css({opacity:0}).show(0);
		var postit = $(".thirdStep #final #postit");
		var fbSharing = $(".thirdStep #final .fbSharing");
		postit.css('left', $(window).width()/2-postit.width()/2);

		var position = postit.position();
		fbSharing.css('left', position.left-33);
		fbSharing.css('top', position.top+postit.width()-40);
		fbSharing.hover(function(){
			$(this).stop();
			$(this).transition({ left : $(".thirdStep #final #postit").position().left - $(this).width()+5});
		}, function(){
			$(this).stop();
			fbSharing.transition({ left : $(".thirdStep #final #postit").position().left-33});
		})
		$(".thirdStep #final #postit .content").css(
			'padding-top',
			($(".thirdStep #final #postit").height() - $(".thirdStep #final #postit .content").height())/2
		);
		$(".thirdStep #final").transition({opacity : 1}, time);
	});

}