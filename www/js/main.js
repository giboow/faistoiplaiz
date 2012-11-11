$(document).ready(function(){
	initElements();
	initEvents();
});

$(window).resize(function(){


		var postit = $(".thirdStep #final #postit");
		var fbSharing = $(".thirdStep #final .fbSharing");
		var next = $(".thirdStep #final .next");
		postit.css('left', $(window).width()/2-postit.width()/2);

		var position = postit.position();
		fbSharing.css('left', position.left-33);
		fbSharing.css('top', position.top+postit.height()*2/3);

		next.css('left', position.left+postit.width()+next.width()/2);
		next.css('top', position.top+postit.height()/2);

});



function initElements(){
	var header = $('header#homeHeader #logo');
	var pos = header.position();
	header.css('top', $(window).height()/2- header.height()/2);
}

function initEvents(){

	if($(document).data('encodedData')) {
		$('#content .secondStep, #content .thirdStep .content *').hide();
		$('#content .thirdStep').addClass('lightBg');
		$('#content .thirdStep, #content .thirdStep #final, #content .thirdStep').show();
		openHome(function(){validName()});

	} else {
		$(".firstStep .separator").transition({width : "100%"}, 5000, openHome);
	}


	$('header#homeHeader .imgLogo').click(function(){$(document).attr('location', '/');});
	$('#leftBlock .beginBt').click(leftClick);
	$('#rightBlock .beginBt').click(rightClick);
	$('.thirdStep .choice .male').click(function(){sexeChoice("M")});
	$('.thirdStep .choice .female').click(function(){sexeChoice("F")});
	$('.thirdStep #second .form form').submit(validName);

	var fbSharing = $(".thirdStep #final .fbSharing");
	fbSharing.hover(function(){
		$(this).stop();
		$(this).transition({ left : $(".thirdStep #final #postit").position().left - $(this).width()+5});
	}, function(){
		$(this).stop();
		fbSharing.transition({ left : $(".thirdStep #final #postit").position().left-33});
	})

	$(".thirdStep #final .next").click(nextPhrase)
}

function openHome(callback){
	$('.firstStep').transition({opacity : 0}, function(){
		$(this).hide(0);
		var time = 1000;
		$('header#homeHeader #logo').transition({top: 0, position: "fixe"}, time, function(){
		});
		$('header#homeHeader').transition({position: "fixe", height: 103}, time, function(){
			$(this).css('border-top', 'solid 2px white');
			$(this).css('border-bottom', 'solid 2px white');
			if($.isFunction(callback)) {
				callback();
			}
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
		$('.secondStep').hide(0);
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
		$('.secondStep').hide();
	});
	$(document).data('insulte', 1);
}


function sexeChoice(sexe) {
	var time = 1000;
	$(document).data('sexe', sexe);
	$('.thirdStep #first').transition({opacity : 0}, time, function(){
		$(this).hide(0);
		$('.thirdStep #second').show(0).transition({opacity : 1}, time, function(){
			$('.thirdStep #second form input[name=prenom]').focus();
		});
	})

}

function validName(){
	var form = $(".thirdStep #second form");
	var prenom = form.find("input[name=prenom]").val();
	var url = form.attr('action');
	var datas = new Object;
	var encoded = null;
	if(encoded = $(document).data('encodedData')) {
		datas = encoded;
		$(document).removeData('encodedData')
	} else {
		datas.prenom = prenom,
		datas.sexe = $(document).data('sexe');
		datas.insulte = $(document).data('insulte');
	}
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


function nextPhrase() {
	$(".thirdStep #final").transition({opacity:0}, function(){
		validName();
	}, 1000);
}


function drawFinal(datas)
{
	var time = 1000;
	console.log(datas);
	var prenom = datas.prenom;
	var phrase = datas.phrase;
	var color = datas.color;
	var link = datas.fbUrl;

	var finalStr = new String(phrase);
	finalStr = finalStr.replace("{prenom}", '<span class="prenom">'+prenom+'</span>');
	$(".thirdStep #final #postit .content .phrase").html(finalStr);

	var fbSharing = $(".thirdStep #final .fbSharing");

	var hideFb = false;
	if(typeof(link)!='string') {
		hideFb = true;
	} else {
		fbSharing.click(function(){
			window.open(link);
		});
	}


	$(".thirdStep #second").transition({opacity : 0}, time, function() {
		$(".thirdStep #final *").show();
		if(hideFb) {
			fbSharing.unbind('click').hide();
			$(".thirdStep #final .next").unbind('click').hide();
		}
		$(this).hide();
		$(".thirdStep #final").css({opacity:0}).show(0);
		$(window).resize();

		$(".thirdStep #final #postit .content").css(
			'padding-top',
			($(".thirdStep #final #postit").height() - $(".thirdStep #final #postit .content").height())/2
		);
		$(".thirdStep #final").transition({opacity : 1}, time);

	});
}