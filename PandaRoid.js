function onLoad(){
	document.getElementById('uploadform').classList.add("hidden");
}

function photo(){
	document.getElementById('uploadform').classList.remove("hidden");
}

function annuler1(){
	document.getElementById('uploadform').classList.add("hidden");
	document.location.href="PandaRoid.php";
}

function annuler2(){
	document.getElementById('uploadform').classList.add("hidden");
	document.location.href="admin.php";
}

function annuler3(){
	document.getElementById('uploadform').classList.add("hidden");
	document.location.href="amis.php";
}

function annuler4(){
	document.getElementById('uploadform').classList.add("hidden");
	document.location.href="profil.php";
}

function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
					$('#image').attr('src', e.target.result);
				   }
					reader.readAsDataURL(input.files[0]);
				   }
				document.getElementById('uploadform').style.height = "400px";
				}