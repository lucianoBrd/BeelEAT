window.onload = function () {
    var email = document.getElementById("E-mail");
    var form = document.querySelector(".form");


    function emailValide(email){
      var regex = /^[a-zA-Z0-9._-]+@etu\.univ-lyon1\.fr$/;

      if(!regex.test(email.value)){
        email.style.backgroundColor = "#ffe6eb";
        return false;
      } else {
        email.style.backgroundColor = "#e7f5f2";
        return true;
      }

    }

    email.addEventListener('input', function (event) {
        emailValide(email);
    }, false);

    form.addEventListener('submit', function (event) {
        if(!emailValide(email)){

          // On envoie pas le formulaire
          event.preventDefault();
        }
    }, false);

};
