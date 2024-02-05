let btnAppliquer = document.getElementById('btn-appliquer');
btnAppliquer.addEventListener("click",(evenement) => FiltrerCatalogue(evenement));
let formSelect = document.getElementById('form-select');

function FiltrerCatalogue(evenement){
    evenement.preventDefault();
    let order = formSelect.value;
    ajax = new XMLHttpRequest();
    url = "https://test.galahost.xyz/Donnee/endpoints/FiltrerCatalogue.php?order="+order
    ajax.open('GET', url, true);
    ajax.onreadystatechange = function() {
        if(4 == ajax.readyState) {
            document.getElementById('produits').innerHTML = "";
            // console.log('recevoirCatalogueFiltre() ' + order);
            catalogue = JSON.parse(ajax.responseText);
            // console.log(catalogue);
            listeProduits = []
            for(var i = 0; i < catalogue.length; i++){
                let obj = catalogue[i];
                console.log(obj['nom'])
                listeProduits.push(new Produit(obj['nom'], obj['prix']))
            }

            for(var produit in listeProduits){
                // console.log("Ajout produit");
                document.getElementById('produits').innerHTML +=
                    "<div id='produit'>" +
                    "<p>"+listeProduits[produit].nom+"</p>" +
                    "<p>"+listeProduits[produit].prix+"$</p>" +
                    "</div>";
            }
        }
    };
    ajax.send('');
}
