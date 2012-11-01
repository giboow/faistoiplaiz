function centerElement(element){
	var pos =  element.position();
	element.css({"left": pos.left - element.width()/2})
}

function init() {
	centerElement($("#logo"));

	//events
	initBlock($("#leftBlock"), $("#rightBlock"), 0);
	initBlock($("#rightBlock"), $("#leftBlock"), 1);
}

var blockClick = false;

function initBlock(block, depBlock, insultes) {

	block.click(function(){
		if (blockClick) {
			return;
		}
		blockClick = true;
		var pos = block.position();
		block.children(".content").children(".firstStep").hide();
		$(depBlock).css('display', 'none');
		$("#separatorBlock").hide();
		block.transition({width: "100%"}, 1000, function(){
			$(this).children(".content").children(".secondStep").show();
		});
		$("#logo").transition({opacity: 0}, 500);
	});

	initForm(block, insultes);
}


function initForm(block, insultes) {
	var form = block.find('.secondStep form').submit(function(){
		var form = $(this);
		var prenom = form.find('input[name=prenom]').val();
		var url = form.attr('action');
		var datas = {prenom : prenom, insultes: insultes};

		$.ajax({
			url: url,
			data : datas,
			type: "POST",
			dataType: "json"
		}).success(function(response){
			alert(response.phrase);
		}).error(function(){
		});
		//interromp le submit
		return false;

	});
	console.log(form);
}

$(document).ready(function(){
	init();
	$("#leftBlock").click();
});
