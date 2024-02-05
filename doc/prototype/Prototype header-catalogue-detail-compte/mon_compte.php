<div class="d-flex justify-content-center">
	<div class="d-flex w-50 mt-4 mb-4 border bg-white">
		<div class="d-flex flex-column border-end">
			<div class="border-bottom mb-2 px-4 py-2">
				<a href="#">Mon compte</a>
			</div>
			<div class="border-bottom mb-2 px-4 py-2">
				<a href="#">Mes commandes</a>
			</div>
		</div>
		<div>
			<form action="#" method="post">
			<div class="d-flex flex-column align-items-center mt-3 mb-3">
				<h4>Mon compte</h4>
				<img src="avatar.png" class="w-75">
				<h4>Prenom Nom</h4>
			</div>
			<div class="d-flex flex-column ms-4 mb-4 align-items-center">
				<div class="d-flex mb-2">
					<p class="me-2">Adresse mail:</p>
					<input type="email" id="email" value="adresse@mail.com" disabled>
				</div>
				<div class="d-flex">
					<p class="me-2">Numéro de téléphone:</p>
					<input type="tel" id="phone" value="01 23 45 67 89" disabled>
				</div>
			</div>
			<div class="d-flex justify-content-center mb-4">
				<button class="btn btn-primary" id="btnModifier" type="button" onclick="activerModif()">Modifier</button>
				<button class="btn btn-primary me-2" id="btnMaj" type="submit" hidden>Mettre à jour</button>
				<button class="btn btn-primary" id="btnAnnuler" type="button" onclick="annulerModif()" hidden>Annuler</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
function activerModif() {
	let btnModifier = document.getElementById("btnModifier");
	let btnMaj = document.getElementById("btnMaj");
	let btnAnnuler = document.getElementById("btnAnnuler");
	
	let inputMail = document.getElementById("email");
	let inputPhone = document.getElementById("phone");
	
	// On cache le bouton modifier et on affiche les deux autres
	btnModifier.setAttribute("hidden", "");
	btnMaj.removeAttribute("hidden");
	btnAnnuler.removeAttribute("hidden");
	
	// On permet l'écriture dans les input
	inputMail.removeAttribute("disabled");
	inputPhone.removeAttribute("disabled");
	
	// On stocke les valeurs des input dans des variables globales pour les rétablir
	// si l'utilisateur clique sur le bouton annuler
	oldMail = inputMail.value;
	oldPhone = inputPhone.value;
}

function annulerModif() {
	let btnModifier = document.getElementById("btnModifier");
	let btnMaj = document.getElementById("btnMaj");
	let btnAnnuler = document.getElementById("btnAnnuler");
	
	let inputMail = document.getElementById("email");
	let inputPhone = document.getElementById("phone");
	
	// On affiche le bouton modifier et on cache les deux autres
	btnModifier.removeAttribute("hidden");
	btnMaj.setAttribute("hidden", "");
	btnAnnuler.setAttribute("hidden", "");
	
	// On désactive l'écriture dans les input
	inputMail.setAttribute("disabled", "");
	inputPhone.setAttribute("disabled", "");
	
	// On rétablit les valeurs des deux input
	inputMail.value = oldMail;
	inputPhone.value = oldPhone;
}
</script>