@extends("layouts.app")

@section("content")
<?php header("Access-Control-Allow-Origin: *"); ?>
<div class="d-flex flex-column flex-md-row">
	<div class="col d-flex flex-column p-4">
		<div class="d-flex justify-content-center">
			@if(is_null($produit->image))
			<img class="border img-fluid" src="{{ asset('images/placeholder.webp') }}"></img>
			@else
			<img class="border img-fluid" src="{{ asset($produit->image->chemin) }}"></img>
			@endif
		</div>
		<div class="d-flex justify-content-start col-3">
			<img class="me-1 my-2 border img-thumbnail" src="{{ asset('images/placeholder.webp') }}"></img>
			<img class="me-1 my-2 border img-thumbnail" src="{{ asset('images/placeholder.webp') }}"></img>
			<img class="me-1 my-2 border img-thumbnail" src="{{ asset('images/placeholder.webp') }}"></img>
		</div>
	</div>
	
	<div class="col py-4 pe-4">
		<div class="pb-2">
			<a href="{{ url()->previous() }}">Retour</a>
		</div>
		<div>
			<h4 class="border-bottom border-2 pb-2">{{ $produit->nom }}</h4>
			<p>{{ $produit->description }}</p>
		</div>
		<div class="d-flex border p-2 justify-content-between align-items-center">
			<div class="border d-flex p-2">
				<h5>${{ $produit->prix }} / unité</h5>
			</div>
			<form action="{{'/index.php/confirmationAchat'}}" method="post" id="ConfirmationAchat" enctype="multipart/form-data">
				@csrf
				
				<div class="d-flex">
					<div class="d-flex border me-4 input-group-sm">
						<button type="button" class="btn p-2 m-0" onclick="retraitQuantite()">-</button>
						<input type="number" name="quantite" id="quantite" value="1" min="1">
						<button type="button" class="btn p-2 m-0" onclick="ajoutQuantite()">+</button>
					</div>
					<input type="hidden" name="nomProduit" value="{{$produit->nom}}">
					<input type="hidden" name="prixProduit" value="{{$produit->prix}}">
					<button type="button" class="btn btn-primary" onclick="addPanier()">Ajouter au panier</button>
					<button type="submit" class="btn btn-primary">Acheter</button>
				</div>
			</form>
		</div>
	</div>
</div>
@if(!is_null(Illuminate\Support\Facades\Auth::user()) && Illuminate\Support\Facades\Auth::user()->email)
<div id="ajout-commentaire">
	<h3> Ajout de commentaire :</h3>
	<form action="" id="ajoutcommentaire">
	<div class="row col-sm-10 mx-auto bg-light rounded">
		<textarea id="contenueCommentaire" name="contneueCommentaire" class="rounded "> </textarea>
		<input type="hidden" id="idMembre" name="idMembre" value="{{Illuminate\Support\Facades\Auth::id()}}">
		<input type="hidden" id="idProduit" name="idProduit" value="{{$produit->id}}">
	</div>
	<div class="row col-sm-10 mx-auto bg-light">
		<div class="row col-sm-3 mx-auto mt-2">
			<input type="submit" id="envoieCommentaire" class="btn btn-success" value="poster">
		</div>
	</div>
</div>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-12">
		  <div class="page-header">
			<h1>Commentaires </h1>
		  </div> 
@if($produit->commentaires)
	@foreach($produit->commentaires as $commentaire)
	<div class="comments-list">
		<div class="media" style="border-bottom: 1px dotted #ccc;">
			<p class="float-right"><small>{{$commentaire->date}}</small></p>
			 <div class="media-body">
				 
			   <h4 class="media-heading user_name">{{$commentaire->auteur[0]["name"]}}</h4>
			   {{$commentaire->contenue}}
			   @if(Auth::id() == $commentaire->idMembre)
			   <p><small><a href="">Supprimer</a></p>
			   @endif
			 </div>
		   </div>
		</div>
	@endforeach
@endif
		</div>
	</div>
</div>
<div class="col-sm-10  mx-auto t-5 commentaireType" style="display:none" id="commentaireType">
	<div class="row mx-auto justify-content-center">
		<div class="col-sm-4 bg-light" id="auteur"></div>
		<div class="col-sm-2 bg-light"></div>
		<div class="col-sm-4 bg-light text-end" id="date"> </div>
	</div>
	<div class="row">
		<div class="col-sm-10 mx-auto text-center" id="commentaire-insert">
		</div>
	</div>
</div>
<script>
	function addPanier(){
		console.log("Add panier qté = " + document.getElementById("quantite").value);
		addToCart({{ $produit->id }}, document.getElementById("quantite").value);
	}

	function retraitQuantite(){
		const quantite = document.getElementById("quantite");
		var valeur = quantite.value;
		if(valeur-1 <= 0){
			quantite.value = 0;
		} else {
			quantite.value = valeur-1;
		}
	}

	function ajoutQuantite(){
		const quantite = document.getElementById("quantite")
		var valeur = parseInt(quantite.value) + 1;
		quantite.value = valeur;
	}

	document.getElementById("envoieCommentaire").addEventListener("click", function(event){
  		event.preventDefault();
		ajouterCommentaireVisuel();
		var contenueCommentaire = document.getElementById("contenueCommentaire").value;
		var membre = document.getElementById("idMembre").value;
		var produit = document.getElementById("idProduit").value;
		var DataObjet = {};
		DataObjet["commentaire"] = contenueCommentaire;
		DataObjet["idMembre"] = membre;
		DataObjet["idProduit"] = produit;
		var Data = JSON.stringify(DataObjet);
		fetch("https://chimax.store/index.php/ajoutCommentaire", {
		method: 'post',
		mode : 'cors',
		body: Data,
		headers: {
			'Content-Type': 'application/json',
			'Accept' : 'application/json'
		}
		}).then((response) => {
		return response.text();
		}).then((res) => {
			ajouterCommentaireVisuel(res,contenueCommentaire);
			document.getElementById("contenueCommentaire").value = "";
		}).catch((error) => {
		console.log(error);
		})

	});

	function ajouterCommentaireVisuel(Nom,commentaire){
		if(Nom == null){
			return ;
		}
		var dateActuelle = new Date();

		var annee = dateActuelle.getFullYear();
		var mois = dateActuelle.getMonth() + 1; // Les mois commencent à 0, donc ajoutez 1
		var jour = dateActuelle.getDate();
		var heures = dateActuelle.getHours(); 
		var minutes = dateActuelle.getMinutes();
		var secondes = dateActuelle.getSeconds();

		var dateFormatee = annee + "-" + (mois < 10 ? "0" : "") + mois + "-" + (jour < 10 ? "0" : "") + jour + " " +
                   (heures < 10 ? "0" : "") + heures + ":" + (minutes < 10 ? "0" : "") + minutes; //A retirer si serv de prod est en format 12h

		var Original = document.getElementById("commentaireType");
		var CommentaireAjout = Original.cloneNode(true);
		CommentaireAjout.querySelector('#auteur').innerText = Nom;
		CommentaireAjout.querySelector('#date').innerText = dateFormatee;
		CommentaireAjout.querySelector('#commentaire-insert').innerText = commentaire;
		var ElementParent = document.getElementById('section-commentaire');
		if(ElementParent === null){
			document.getElementById('section-commentaire').innerHTML = CommentaireAjout;
		}else {
			var firstChild = ElementParent.firstChild;
			ElementParent.insertBefore(CommentaireAjout,firstChild);
		}
		CommentaireAjout.style.display = 'block';
	}
</script>
@endsection