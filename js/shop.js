window.onload = function () {
    var choose = document.querySelectorAll(".choose");
    var send = document.getElementById("send");
    var input = document.querySelectorAll("input");

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

    var h2 = document.querySelector(".row");

    function surligne(champChoose, champInput)
    {
      champChoose.parentNode.parentNode.parentNode.style.backgroundColor = "#e7f5f2";
      champInput.value = champChoose.value;
      choose.forEach(function(element) {
        if(champInput.name == element.name && element.value != champChoose.value){
          element.parentNode.parentNode.parentNode.style.backgroundColor = "";
        }
      });
      event.preventDefault();
    }

    input.forEach(function(elementInput) {
      choose.forEach(function(element) {
        if(elementInput.name == element.name){
          element.addEventListener('click', function (event) {
              surligne(element, elementInput);
          }, false);
        }
      });
    });


    send.addEventListener('click', function (event) {
      var error = 0;
      input.forEach(function(elementInput) {
        if(elementInput.value == ""){
          error = 1;
        }
      });

      if(error == 1){
        p = document.createTextNode(" Il faut choisir un élément de chaque catégories.");
        div.removeChild(div.lastChild);
        div.appendChild(p);
        h2.insertBefore(div, h2.children[0]);
        // On envoie pas le formulaire
        event.preventDefault();
      }
    }, false);

};
