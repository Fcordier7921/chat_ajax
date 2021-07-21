// Variables globales
let lastId = 0 // id du dernier message affiché

let xhr = new XMLHttpRequest(), //appelle de la variable de séssion en ajax
    IdSession;
xhr.open('POST', "ajax/get_session.php", false);
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        IdSession = JSON.parse(xhr.responseText)
    }

};
xhr.send();
// On attend le chargement du document
window.onload = () => {
    // On va chercher la zone texte
    let texte = document.querySelector("#texte") // 
    texte.addEventListener("keyup", verifEntree) //écouter dans la zone de texte si il y fait sur entré

    // On va chercher le bouton valid
    let valid = document.querySelector("#valid")
    valid.addEventListener("click", ajoutMessage) //ecoute le click sur le bouton

    // On charge les nouveaux messages
    setInterval(chargeMessages, 1000) //cargera le prmier paramétre tout le 1seconde
}


/**
 * Charge les derniers messages en Ajax et les insère dans la discussion
 */
function chargeMessages() {
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest()

    // On gère la réponse
    xmlhttp.onreadystatechange = function() { //ecouteur d'événement 
        if (this.readyState == 4) { //sit le satus et fini 
            if (this.status == 200) { //Requête traitée avec succès. La réponse dépendra de la méthode de requête utilisée.
                // On a une réponse
                // On convertit la réponse en objet JS
                let messages = JSON.parse(this.response) // analyse une chaîne de caractères JSON et construit la valeur JavaScript ou l'objet décrit par cette chaîne

                // On retourne l'objet
                messages.reverse()

                // On récupère la div #discussion
                let discussion = document.querySelector("#discussion");



                for (let message of messages) { //j'ai un message parmis les messsage
                    // On transforme la date du message en JS car ce que l'on a recu est un text
                    let dateMessage = new Date(message.created_at);




                    if (message.pseudo == IdSession) { //si le pseudo et idantique a la session

                        if (message.pseudo == 'admin') { //si le pseudo et admin tu conna accés a la parti inscription


                            document.getElementById('registration').innerHTML = '<a class="btn btn-danger float-right shadow rounded mx-5"  href="inscription.php">inscription</a>'
                        }
                        // On ajoute le contenu avant le contenu actuel de discussion  a droit pour l'utilisateur du chat
                        discussion.innerHTML += `<div class="container" style="overflow: hidden;"><div class="lodahout my-4 float-right col-12 col-md-6 clo-lg-3" style="background-color: #028090; color: white;"><p classe="tex_chat">  ${message.message}</p><img src="img/` + message.photo + `.jpg" alt="Avatar" class="right" style="width:100%;"><span class="time-right"> ${message.pseudo} : le ${dateMessage.toLocaleString()}</span></div></div>`
                            // On met à jour le lastId
                        lastId = message.id
                    } else { //On ajoute le contenu avant le contenu actuel de discussion a gauche pour les message recu 
                        discussion.innerHTML += `<div class="container" style="overflow: hidden;"><div class="lodahout my-4 ml-3 float-left col-12 col-md-6 clo-lg-3" style="background-color: #02c39a; color: white;"><p classe="tex_chat">  ${message.message}</p><img src="img/` + message.photo + `.jpg" alt="Avatar" class="right" style="width:100%;"><span class="time-right"> ${message.pseudo} : le ${dateMessage.toLocaleString()}</span></div></div>`
                            // On met à jour le lastId
                        lastId = message.id
                    }
                    discussion.scrollTo(0, discussion.scrollHeight); //srole automatique vers le bas
                }
            } else {
                // On gère les erreurs
                let erreur = JSON.parse(this.response);
                alert(erreur.message);
            }
        }

    }

    // On ouvre la requête
    xmlhttp.open("GET", "ajax/chargeMessages.php?lastId=" + lastId); //charger avec le dernier id

    // On envoie
    xmlhttp.send();
}


/**
 * Cette fonction vérifie si on a appuyé sur la touche entrée
 */
function verifEntree(e) {
    if (e.key == "Enter") {
        ajoutMessage();
    }
}

/**
 * Cette fonction envoie le message en ajax à un fichier ajoutMessage.php
 */
function ajoutMessage() {
    // On récupère le message dans le champ et on prend ca valeur
    let message = document.querySelector("#texte").value

    // On vérifie si le message n'est pas vide
    if (message != "") {
        // créer un tableau pour l'assossier a les donné json
        let donnees = {}
        donnees["message"] = message //dans la variable on ajout les message

        // On convertit les données en JSON
        let donneesJson = JSON.stringify(donnees) //converti les donné en json d'un tableau

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest() //méthode pour envoyer des requéte a un serveur

        // On gère la réponse
        xmlhttp.onreadystatechange = function() { //ecouteur quand il y a un changement
            // On vérifie si la requête est terminée
            if (this.readyState == 4) { //this est xmlhttp et apres on voie readystate si la requé est fini avec la valeur 4 etent donner que la requé a 4 étape
                // On vérifie qu'on reçoit un code 201
                if (this.status == 201) { //le code 201 permet de dir c'est bon le poste a été créer et tout c'est bien passé
                    // L'enregistrement a fonctionné
                    // On efface le champ texte
                    document.querySelector("#texte").value = "" //réiniialisr le champ et le vidé
                } else {
                    // L'enregistrement a échoué
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "ajax/ajoutMessage.php") //chemin vers le fichier d'ajout de message

        // On envoie la requête en incluant les données
        xmlhttp.send(donneesJson)
    }
}


for (let i = 1; i <= 21; i++) { //création des image pour la parti inscription

    let getphoto = document.createElement('div');
    getphoto.className = 'photo col-12 col-lg-1 p-0 m-0';
    getphoto.style.width = '50%';
    getphoto.style.height = '50%';
    getphoto.innerHTML = '<div><img class="img-fluid mx-1" src="img/' + i + '.jpg" alt=""><p class="col-12 col-lg-1">' + i + '</p></div>';
    document.getElementById("lulu").appendChild(getphoto);

}