$(document).ready(()=>{

});

let acordeon = (id)=>{

	$(id).slideDown('slow');
	if(id == "#texto1"){
		$('#texto2').slideUp('slow');
		$('#texto3').slideUp('slow');
	}
	else if(id == "#texto2"){
		$('#texto1').slideUp('slow');
		$('#texto3').slideUp('slow');
	}
	else {
		$('#texto1').slideUp('slow');
		$('#texto2').slideUp('slow');
	}

};