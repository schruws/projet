/**
 * Created by michael on 27-12-16.
 */

project = {
    name : 'projet'
};
/**
 * template : menu/login.php
 * explication:
 * form-id: menu_rentitialisation : permet de vérifier la rénitialisation du password.
 * form-id : personnel.creer : vérifié si la date de fin du CDD est inférieur à la date du début, template
 * @param form_id
 * @returns {boolean}
 */
function form_action(form_id)
{
    valide = true;
    if(form_id === "menu.renitialisation") {
        erreur = document.getElementById("erreur");
        mdp1 = document.getElementById("password1");
        mdp2 = document.getElementById("password2");
        if (mdp1.value == '' || mdp2.value == '') {
            erreur.style.display = "";
            erreur.innerHTML = "Tous les champs ne sont pas remplis.";
            erreur.className = "alert alert-danger";
            mdp1.focus();
            valide = false;
        }
        else if (mdp1.value != mdp2.value) {
            erreur.style.display = "";
            erreur.innerHTML = "Ce ne sont pas les mêmes mots de passe.";
            erreur.className = "alert alert-danger";
            mdp1.focus();
            valide = false;
        }
        else if (mdp1.value == mdp2.value) {
            valide = true;
        }
        else {
            mdp1.focus();
            valide = false;
        }
    }
    else if(form_id === "personnel.creer")
    {
        if(document.getElementById("selectContrat")) {
            valeur = document.getElementById("selectContrat");

            if (valeur.value !== "CDI") {
                dateDebut = new Date(document.getElementById("anneeDebut").value, document.getElementById("moisDebut").value, document.getElementById("jourDebut").value);
                dateFin = new Date(document.getElementById("anneeFin").value, document.getElementById("moisFin").value, document.getElementById("jourFin").value);
                if (dateDebut > dateFin) {
                    erreur.style.display = "";
                    erreur.innerHTML = "La date de fin est inférieure à la date du début.";
                    erreur.className = "alert alert-danger";
                    window.top.window.scrollTo(0, 0);
                    valide = false;
                }
                else {
                    valide = true;
                }
            }
            else {
                valide = true;
            }
        }
        else
        {
            valide = true;
        }
    }
    else if(form_id === "horaire.CreationHoraireManuel")
    {
        tt = document.querySelectorAll('input[value][type="hidden"]:not([value=""])');

        for(var i = 0; i< tt.length; i++)
        {
            valeur = 0;
            besoin = tt[i].value;
            td = document.getElementById(tt[i].id);
            check = td.querySelectorAll('input[type="checkbox"]');
            for(var a = 0; a < check.length; a++)
            {
                if(check[a].checked)
                {
                    valeur++;
                }
            }
            if(valeur < besoin)
            {
                erreur.style.display = "";
                erreur.innerHTML = "Vous n’avez pas assez  sélectionné d’effectifs pour le jour "+tt[i].id+".";
                erreur.className = "alert alert-danger";
                window.top.window.scrollTo(0, 0);
                valide = false;
            }
            else if (valeur > besoin)
            {
                erreur.style.display = "";
                erreur.innerHTML = "vous avez sélectionné trop d’effectifs pour le jour "+tt[i].id+".";
                erreur.className = "alert alert-danger";
                window.top.window.scrollTo(0, 0);
                valide = false;
            }
        }

    }
    else if(form_id === "contrat.creer")
    {
        valeur = document.getElementById("selectContrat");

        if (valeur.value !== "CDI") {
            dateDebut = new Date(document.getElementById("anneeDebut").value, document.getElementById("moisDebut").value, document.getElementById("jourDebut").value);
            dateFin = new Date(document.getElementById("anneeFin").value, document.getElementById("moisFin").value, document.getElementById("jourFin").value);
            if (dateDebut > dateFin) {
                erreur.style.display = "";
                erreur.innerHTML = "La date de fin est inférieure à la date du début.";
                erreur.className = "alert alert-danger";
                window.top.window.scrollTo(0, 0);
                valide = false;
            }
            else {
                valide = true;
            }
        }
        else {
            valide = true;
        }
    }
    else if(form_id === "conger.creer")
    {
        valeur = document.getElementById("selectContrat");
        dateDebut = new Date(document.getElementById("anneeDebut").value, document.getElementById("moisDebut").value, document.getElementById("jourDebut").value);
        dateFin = new Date(document.getElementById("anneeFin").value, document.getElementById("moisFin").value, document.getElementById("jourFin").value);
        if (dateDebut > dateFin) {
            erreur.style.display = "";
            erreur.innerHTML = "La date de fin est inférieure à la date du début.";
            erreur.className = "alert alert-danger";
            window.top.window.scrollTo(0, 0);
            valide = false;
        }
        else {
            valide = true;
        }
    }
    if(valide) {
        // récupérer le formulaire via l'id en argument
        form = document.getElementById(form_id);

        // récupérer l'action du formulaire
        action = form.getAttribute('action');

        // récupérer le contrôleur et la méthode à appeler
        controller = action.split('.')[0];
        method = action.split('.')[1];

        // générer la vrai url d'action du formulaire
        url =  '/'+project.name+'/controlleur/' + controller + '.php';

        // créer un paramètre caché qui contient l'action
        input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'action');
        input.setAttribute('value', method);

        // ajouter l'input au formulaire
        form.appendChild(input);

        // remplacer l'action virtuelle par la vraie action
        form.setAttribute('action', url);

        // valider le formulaire pour envoyer les données au contrôleur définit dans l'action
        form.submit();
    }
    else
    {
        return false;
    }

}

var retour = document.getElementById("retour");

retour.addEventListener('click', function() {

    url =  '/'+project.name+'/index.php?page=menu.menu';
    window.location.href= url;
});


function retourAdmin(){

    url =  '/'+project.name+'/index.php?page=personnel.afficherResponsable';
    window.location.href= url;
}

var ma_liste = document.getElementsByClassName("progressBar");
var les_li = ma_liste.getElementsByTagName("li");

function creerContrat(object)
{
    document.getElementById("personne").style.display = "none";
    document.getElementById("contrat").style.display = "";
    document.getElementById("2").classList.add("active");
    object.style.display ="none";

}
function valider(object)
{
    document.getElementById("personne").style.display = "";
    document.getElementById("contrat").style.display = "";
    document.getElementById("3").classList.add("active");
    object.style.display ="none";
    document.getElementById("bouttonvalider").style.display = "";

}



function afficher(object){

    if( document.getElementById("choix"))
    {
        document.getElementById("choix").value = "";
    }
    var variable = object.id;
    var tableau = document.getElementById(variable);
    var tbody = tableau.getElementsByTagName("tbody");
    var tr = tbody.contenue.querySelectorAll('tr');
    if(object.checked)
    {
        for(var i = 0; i<= tr.length; i++)
        {
            if (tr[i].id.substr(0, 7) === "archive")
            {
                if (tr[i].style.display === "none") {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
            else
            {
                tr[i].style.display = "none";
            }
        }
    }
    else
    {

        for(var i = 0; i<= tr.length; i++)
        {
            if (tr[i].id.substr(0, 7) !== "archive") {
                if (tr[i].style.display === "none") {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
            else
            {
                tr[i].style.display = "none";
            }
        }

    }
}
function rechercheNom(object){


    var nom = object.value;
    var a = nom.length;
    var tr = document.getElementsByTagName("tbody")[0].getElementsByTagName('tr');
    for(var i = 0; i<= tr.length; i++)
    {
        if(document.getElementById("check").getElementsByTagName("input")[0].checked !== true) {
            if (tr[i].id.substr(0, 7) !== "archive") {
                if (tr[i].id.substr(0, nom.length) === nom) {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
        }
        else
        {
            if (tr[i].id.substr(0, 7) === "archive") {
                if (tr[i].id.substr(8, nom.length) === nom) {
                    tr[i].style.display = "";
                }
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}
function recherch(objet)
{
    var tableau = document.querySelectorAll("table")
    if(objet.value === ",")
    {
        for(var i = 0; i<= tableau.length; i++) {
            tableau[i].style.display= "";
        }
    }
    for(var i = 0; i<= tableau.length -1; i++)
    {
        if(objet.value == tableau[i].id.substr(0,objet.value.length))
        {
            tableau[i].style.display= "";
            $parent = tableau[i].parentNode;
            $div = $parent.querySelector("div");
            $div.style.display="";


        }
        else
        {
            tableau[i].style.display= "none";
            $parent = tableau[i].parentNode;
            $div = $parent.querySelector("div");
            $div.style.display="none";
        }

    }

}
function jour(jour) {
    contrat = document.getElementById("contrat");
    tableau = contrat.querySelectorAll("table");
    for(var i = 1; i<= tableau.length; i++) {
        if(jour.id === "tous")
        {
            tableau[i].style.display = "";
        }
        else
        {
            if(jour.id === tableau[i].id)
            {
                tableau[i].style.display = "";
            }
            else
            {
                tableau[i].style.display = "none";
            }
        }
    }

}
function horaireRecherche(jour) {
    horaire = document.getElementById("horaire");
    tableau = horaire.querySelectorAll("iframe");
    for(var i = 0; i<= tableau.length; i++) {
        if(jour.id === "tous")
        {
            tableau[i].style.visibility = "visible";
            tableau[i].height = "600";
            tableau[i].width= "900";

        }
        else
        {
            if(jour.id === tableau[i].id)
            {
                tableau[i].style.visibility = "visible";
                tableau[i].height = "600";
                tableau[i].width= "900";
            }
            else
            {
                tableau[i].style.visibility = "hidden";
                tableau[i].height = "0";
                tableau[i].width= "0";
            }
        }
    }

}
function contrat (contrat)
{
    finContrat = document.getElementById("dateFin");
    if(contrat.value == "CDI") {
        finContrat.style.display = "none";
    }
    else
    {
        finContrat.style.display = "";
    }

}
function Check(valeur)
{
    password = valeur.value;
    erreur = document.getElementById("erreur");
    if(password.length != 0)
    {
        passwordlow = password.toLowerCase();
        majuscule = false;

        //On vérifie si il y a des majuscules
        if(password != passwordlow)
        {
            majuscule = true;
        }

        taille = password.length;
        numerique = false;
        // On vérifie qu'il y a des chiffres
        for(i=0;i<taille ;i++)
        {
            caractere = password.substring(i,i+1);
            if(!isNaN(caractere))
            {
                numerique = true;
            }
        }

        if((majuscule==false && numerique==false))
        {
            if(document.getElementById)
            {
                erreur.style.display= "";
                erreur.innerHTML = "Le mot de passe ne contient pas une majuscule et une valeur numérique.";
                document.getElementById("faible").style.backgroundColor = 'green';
                document.getElementById("moyen").style.backgroundColor = 'white';
                document.getElementById("elevee").style.backgroundColor = 'white';
            }
        }
        else
        {
            if(majuscule && numerique && taille <=7)
            {
                erreur.style.display= "";
                erreur.innerHTML = "Le mot de passe doit être d'une longueur de 8 caractères minimum.";
                document.getElementById("faible").style.backgroundColor = 'green';
                document.getElementById("moyen").style.backgroundColor = 'green';
                document.getElementById("elevee").style.backgroundColor = 'white';
            }
            else if(majuscule && numerique && taille > 7)
            {
                erreur.style.display= "none";
                document.getElementById("faible").style.backgroundColor = 'green';
                document.getElementById("moyen").style.backgroundColor = 'green';
                document.getElementById("elevee").style.backgroundColor = 'green';
            }
            else if(majuscule  && numerique === false && taille < 7)
            {
                erreur.style.display= "";
                erreur.innerHTML = "Le mot de passe n'a pas de valeur numérique et doit être d'une longueur de 8 caractères minimum.";
                document.getElementById("faible").style.backgroundColor = 'green';
                document.getElementById("moyen").style.backgroundColor = 'green';
                document.getElementById("elevee").style.backgroundColor = 'white';
            }
            else
            {
                erreur.style.display= "";
                erreur.innerHTML = "Le mot de passe n'a pas une majuscule et  doit être d'une longeur de 8 caractères minimum.";
                document.getElementById("faible").style.backgroundColor = 'green';
                document.getElementById("moyen").style.backgroundColor = 'green';
                document.getElementById("elevee").style.backgroundColor = 'white';
            }
        }
    }
    else
    {
        erreur.style.display= "none";
        document.getElementById("faible").style.backgroundColor = 'white';
        document.getElementById("moyen").style.backgroundColor = 'white';
        document.getElementById("elevee").style.backgroundColor = 'white';
    }

}

