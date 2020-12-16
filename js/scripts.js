// Variables globales
let lastId = 0 // id du dernier message affiché

// On attend le chargement du document
window.onload = () => {
    // On va chercher la zone texte
    let texte = document.querySelector("#texte")// 
    texte.addEventListener("keyup", verifEntree)//écouter dans la zone de texte si il y fait sur entré

    // On va chercher le bouton valid
    let valid = document.querySelector("#valid")
    valid.addEventListener("click", ajoutMessage)//ecoute le click sur le bouton

    // On charge les nouveaux messages
    setInterval(chargeMessages, 1000)//cargera le prmier paramétre tout le 1seconde
}

/**
 * Charge les derniers messages en Ajax et les insère dans la discussion
 */
function chargeMessages(){
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest()

    // On gère la réponse
    xmlhttp.onreadystatechange = function(){//ecouteur d'événement 
        if (this.readyState == 4){//sit le satus et fini 
            if(this.status == 200){//Requête traitée avec succès. La réponse dépendra de la méthode de requête utilisée.
                // On a une réponse
                // On convertit la réponse en objet JS
                let messages = JSON.parse(this.response)// analyse une chaîne de caractères JSON et construit la valeur JavaScript ou l'objet décrit par cette chaîne

                // On retourne l'objet
                messages.reverse()

                // On récupère la div #discussion
                let discussion = document.querySelector("#discussion");
                

                for(let message of messages){//j'ai un message parmis les messsage
                    // On transforme la date du message en JS car ce que l'on a recu est un text
                    let dateMessage = new Date(message.created_at)
                    if(message.id= `${$user['id']}`){
                    // On ajoute le contenu avant le contenu actuel de discussion  
                    discussion.innerHTML +=`<div class="container"><div class="lodahout" style="background-color: black;"><p>  ${message.message}</p><span class="time-right"> ${message.pseudo} à ${dateMessage.toLocaleString()}</span></div></div>`  
                    // On met à jour le lastId
                    lastId = message.id
                    }
                    discussion.scrollTo(0, discussion.scrollHeight);//srole automatique vers le bas
                }
            }else{
                // On gère les erreurs
                let erreur = JSON.parse(this.response);
                alert(erreur.message);
            }
        }
    }

    // On ouvre la requête
    xmlhttp.open("GET", "ajax/chargeMessages.php?lastId="+lastId);

    // On envoie
    xmlhttp.send();
}


/**
 * Cette fonction vérifie si on a appuyé sur la touche entrée
 */
function verifEntree(e){
    if(e.key == "Enter"){
        ajoutMessage();
    }
}

/**
 * Cette fonction envoie le message en ajax à un fichier ajoutMessage.php
 */
function ajoutMessage(){
    // On récupère le message dans le champ et on prend ca valeur
    let message = document.querySelector("#texte").value
    
    // On vérifie si le message n'est pas vide
    if(message != ""){
        // créer un tableau pour l'assossier a les donné json
        let donnees = {}
        donnees["message"] = message//dans la variable on ajout les message

        // On convertit les données en JSON
        let donneesJson = JSON.stringify(donnees)//converti les donné en json d'un tableau

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest()//méthode pour envoyer des requéte a un serveur

        // On gère la réponse
        xmlhttp.onreadystatechange = function(){//ecouteur quand il y a un changement
            // On vérifie si la requête est terminée
            if(this.readyState == 4){//this est xmlhttp et apres on voie readystate si la requé est fini avec la valeur 4 etent donner que la requé a 4 étape
                // On vérifie qu'on reçoit un code 201
                if(this.status == 201){//le code 201 permet de dir c'est bon le poste a été créer et tout c'est bien passé
                    // L'enregistrement a fonctionné
                    // On efface le champ texte
                    document.querySelector("#texte").value = ""
                }else{
                    // L'enregistrement a échoué
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "ajax/ajoutMessage.php")//chemin vers le fichier d'ajout de message

        // On envoie la requête en incluant les données
        xmlhttp.send(donneesJson)
    }
}