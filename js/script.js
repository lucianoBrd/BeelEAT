window.onload = function () {
    var email = document.getElementById("E-mail");
    var form = document.querySelector(".form");
    var pseudo = document.getElementById("username");
    var password = document.getElementById("password");
    var rePassword = document.getElementById("re-password");

    var div = document.createElement("div");
    div.className = "alert alert-danger";
    div.role = "alert";

    var button = document.createElement("button");
    button.className = "close";
    button.type = "button";
    button.innerHTML = "&times;";
    button.setAttribute("data-dismiss", "alert");
    button.setAttribute("aria-hidden", "true");

    var i = document.createElement("i");
    i.className = "fa fa-coffee";

    var strong = document.createElement("strong");
    strong.innerHTML = "Alert!";

    var p = document.createTextNode(" Erreur.");

    div.appendChild(button);
    div.appendChild(i);
    div.appendChild(strong);
    div.appendChild(p);

    var h4 = document.getElementById("error");

    function surligne(champ, erreur)
    {
       if(erreur)
          champ.style.backgroundColor = "#ffe6eb";
       else
          champ.style.backgroundColor = "#e7f5f2";
    }

    function emailValide(email){
      var regex = /^[a-zA-Z0-9._-]+@etu\.univ-lyon1\.fr$/;

      if(!regex.test(email.value)){
        surligne(email, true);
        return false;
      } else {
        surligne(email, false);
        return true;
      }
    }

    function passwordValide(password){
      var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/;

      if(!regex.test(password.value)){
        surligne(password, true);
        return false;
      } else {
        surligne(password, false);
        return true;
      }
    }

    function rePasswordValide(rePassword){

      if(password.value != rePassword.value || !passwordValide(password)){
        surligne(rePassword, true);
        return false;
      } else {
        surligne(rePassword, false);
        return true;
      }
    }

    function pseudoValide(pseudo)
    {
       if(pseudo.value.length < 2 || pseudo.value.length > 25)
       {
          surligne(pseudo, true);
          return false;
       }
       else
       {
          surligne(pseudo, false);
          return true;
       }
    }

    email.addEventListener('input', function (event) {
        emailValide(email);
    }, false);

    pseudo.addEventListener('input', function (event) {
        pseudoValide(pseudo);
    }, false);

    password.addEventListener('input', function (event) {
        passwordValide(password);
    }, false);

    rePassword.addEventListener('input', function (event) {
        rePasswordValide(rePassword);
    }, false);

    form.addEventListener('submit', function (event) {
      var emailOk = emailValide(email);
      var pseudoOk = pseudoValide(pseudo);
      var passwordOk = passwordValide(password);
      var rePasswordOk = rePasswordValide(rePassword);

      if(!emailOk || !pseudoOk || !passwordOk || !rePasswordOk){
        if(!emailOk){
          p = document.createTextNode(" Email invalide. Vous devez vous inscrire avec votre email de l'université.");
        } else if (!pseudoOk) {
          p = document.createTextNode(" Pseudo invalide.");
        } else if (!passwordOk) {
          p = document.createTextNode(" Mot de passe invalide. Il doit contenir : de 8 à 15 caractères, au moins une lettre minuscule, au moins une lettre majuscule, au moins un chiffre et au moins un caractère spécial");
        } else {
          p = document.createTextNode(" Les mots de passe ne sont pas identiques.");
        }
        div.removeChild(div.lastChild);
        div.appendChild(p);
        h4.insertBefore(div, h4.children[0]);
        // On envoie pas le formulaire
        event.preventDefault();
      }
    }, false);

};
