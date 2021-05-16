/*1. функция для клавиш left arrow, right arrow, up arrow, down arrow*/
$(document).ready(function(){
	$(document).keydown(function(e){
		if(e.which == 37 || e.which == 38 || e.which == 39 || e.which == 40){
			console.log('key pressed');
		}
	}
});

/*функция для клавиш*/
$(document).ready(function(){
	$(document).keydown(function(e){
		alert(e.key);
	}
});