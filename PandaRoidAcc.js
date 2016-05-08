function loading(){
	document.getElementById('popup').classList.add("hidden");
	
}

function popup(){
	document.getElementById('Tableauform').classList.add("hidden");
	document.getElementById('popup').classList.remove("hidden");
}

function annuler(){
	document.getElementById('popup').classList.add("hidden");
	document.getElementById('Tableauform').classList.remove("hidden");
}