$(document).ready(function(){
	initElements();
	initEvents();
});

$(window).resize(function(){

		$('.secondStep .contentBlock').css({
		    "margin-top": function(){
		    	var top = ($(window).height()  - $(this).height())/2- 103;
		    	if (top <= 103) {
		    		return $(this).top;
		    	} else {
		    		return top;
		    	}
		    },
		});

		$('.thirdStep > .content').css({
		    "margin-top": function(){
		    	return ($(window).height()  - $(this).height()-103)/2;
		    },
		});


		var postit = $(".thirdStep #final #postit");
		var fbSharing = $(".thirdStep #final .fbSharing");
		var next = $(".thirdStep #final .next");
		var helpSharing = $(".thirdStep #final .helpSharing");
		postit.css('left', $(window).width()/2-postit.width()/2);


		var position = postit.position();
		fbSharing.css({
			left: position.left-26,
			top: position.top+postit.height()*2/3
		});

		helpSharing.css({
			left: position.left - helpSharing.width() - 30,
			top: fbSharing.position().top - helpSharing.height() - 10
		});


		next.css({
			left: position.left+postit.width()+next.width()/2,
			top: position.top+postit.height()/2
		});


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

		$(".firstStep .separator").animate({width : "100%"}, 5000, openHome);
		$(document).click(function(){
			$(".firstStep .separator").stop().animate({width : "100%"}, 100, openHome);
		})
	}


	$('header#homeHeader .imgLogo').click(function(){$(document).attr('location', '/');});
	$('#leftBlock').click(leftClick);
	$('#rightBlock').click(rightClick);
	$('.thirdStep .choice .male').click(function(){sexeChoice("M")});
	$('.thirdStep .choice .female').click(function(){sexeChoice("F")});
	$('.thirdStep #second .form form').submit(validName);

	var fbSharing = $(".thirdStep #final .fbSharing");
	fbSharing.hover(function(){
		$(this).stop();
		$(this).animate({ left : $(".thirdStep #final #postit").position().left - $(this).width()+5});
	}, function(){
		$(this).stop();
		fbSharing.animate({ left : $(".thirdStep #final #postit").position().left-26});
	})

	$(".thirdStep #final .next").click(nextPhrase)
}

function openHome(callback){

	$(document).unbind("click");
	$(window).resize();
	$('.firstStep').animate({opacity : 0}, function(){
		$(this).hide(0);
		var time = 1000;
		$('header#homeHeader #logo').animate({top: 0, position: "fixe"}, time, function(){
		});
		$('header#homeHeader').animate({position: "fixe", height: 103}, time, function(){
			$(this).css('border-top', 'solid 2px white');
			$(this).css('border-bottom', 'solid 2px white');
			if($.isFunction(callback)) {
				callback();
			}
		});
		$('footer#homeFooter').animate({opacity : 1}, time);


	});
}

function leftClick(){
	var time = 1000;
	var el = $('.secondStep #leftBlock');
	el.css('z-index', 100);
	el.find('.contentBlock').animate({opacity : 0}, time);
	el.animate({"margin-left": 0}, time, function(){
		$('.thirdStep').css('display', 'block').addClass('lightBg');
		$('.thirdStep #first .help').html("Choisis le sexe de la personne que tu veux complimenter");
		$('.secondStep').hide(0);
	});
	$('.secondStep #rightBlock').animate({"margin-left" : "100%"}, time);
	$(document).data('insulte', 0);
}

function rightClick(){
	var time = 1000;
	var el = $('.secondStep #rightBlock');
	el.css('z-index', 100);
	el.find('.contentBlock').animate({opacity : 0}, time);
		$('.secondStep #leftBlock').animate({"margin-left": "-100%"}, time);
		el.animate({"margin-left": 0}, time, function(){
		$('.thirdStep').css('display', 'block').addClass('darkBg');
		$('.thirdStep #first .help').html("Choisis le sexe de la personne que tu veux vanner");
		$('.secondStep').hide();
	});
	$(document).data('insulte', 1);
}


function sexeChoice(sexe) {
	$(window).resize();
	var time = 1000;
	$(document).data('sexe', sexe);
	$('.thirdStep #first').animate({opacity : 0}, time, function(){
		$(this).hide(0);
		if ($(document).data('insulte')) {
			$('.thirdStep #second .title').html('<div class="upper big">Qui veux-tu</div><div class="upper">vanner</div>');
			$('.thirdStep #second input[name=prenom]').attr('placeholder', 'entre son prenom');
		} else {
			$('.thirdStep #second .title').html('<div class="upper big">Comment</div><div class="upper">t\'appelles tu</div>');
			$('.thirdStep #second input[name=prenom]').attr('placeholder', 'entre ton prenom');
		}
		$('.thirdStep #second').show(0).animate({opacity : 1}, time, function(){
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
		if(!prenom) {
			alert('Entre un prenom!');
			return false;
		}
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
	var time = 500;
	$(window).resize();
	$(".thirdStep #final").animate({opacity:0}, time, function(){
		validName();
	});
}


function drawFinal(datas)
{
	var time = 500;
	var prenom = datas.prenom;
	var phrase = datas.phrase;
	var color = datas.color;
	var link = datas.fbUrl;

	var finalStr = new String(phrase);
	finalStr = finalStr.replace("{prenom}", prenom);
	/*$(".thirdStep #final #postit .content .phrase").html(finalStr);
	$(".thirdStep #final #postit").removeClass().addClass(color);*/
	$(".thirdStep #final #postit").html('<img src="'+datas.imgUrl+'"></img>')

	var fbSharing = $(".thirdStep #final .fbSharing");

	var hideFb = false;
	if(typeof(link)!='string') {
		hideFb = true;
	} else {
		fbSharing.unbind('click').click(function(){
			var title = finalStr.toUpperCase();
			var summary = "Toi aussi fais toi plaiz, vannes tes amis ou complimente toi sur : http://www.fais-toi-plaiz.com";
			var fbLink = "http://www.facebook.com/sharer.php?s=100&p[title]="+title
						+"&p[url]="+encodeURIComponent(link)
						+"&p[summary]="+summary+"&p[images][0]="
						+encodeURIComponent(datas.imgUrl);
			//fbLink = link;
			window.open(fbLink);
		});
	}


	$(".thirdStep #second").animate({opacity : 0}, time, function() {
		$(".thirdStep #final *").show();
		if(hideFb) {
			fbSharing.unbind('click').hide();
			$(".thirdStep #final .next").unbind('click').hide();
		}
		$(this).hide();
		$(".thirdStep #final").css({opacity:0}).show(0);
		$(window).resize();

		$(".thirdStep #final").animate({opacity : 1}, time);
	});
}