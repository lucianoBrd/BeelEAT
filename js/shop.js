window.onload = function () {
    var sandwich=0, boisson=0, dessert=0, sauce=0, viande=0, garniture;
    var id = document.querySelectorAll(".main")[0].id;
    var choose = document.querySelectorAll(".choose");
    var sousChoix = document.querySelectorAll(".sousChoix");
    var send = document.getElementById("send");
    var toptop = document.querySelector(".scroll-up");

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

    function surligne(champChoose)
    {
      champChoose.parentNode.parentNode.parentNode.style.backgroundColor = "#e7f5f2";
      if(champChoose.name == "sandwich"){
        sandwich = champChoose.value;
        try{
          sauce = 0;
          viande = 0;
          garniture = [];
          var modal = champChoose.parentNode.parentNode.parentNode.parentNode.nextElementSibling;
          var sauceSelect = modal.children[0].children[1].children[0].children[0].children[0].children[1];
          var viandeSelect = modal.children[0].children[1].children[0].children[0].children[2].children[1];
          var garnitureSelect = modal.children[0].children[1].children[0].children[0].children[1].children;
          sauce = sauceSelect.options[sauceSelect.selectedIndex].value;
          viande = viandeSelect.options[viandeSelect.selectedIndex].value;

          for (var i = 1; i < garnitureSelect.length; i++) {
            var garnitureCheck = garnitureSelect[i].children[0].children[0];
            if(garnitureCheck.checked){
              garniture.push(garnitureCheck.value);
            }
          }
        } catch(error){
          sauce = -1;
          viande = -1;
          garniture = -1;
        }

      } else if(champChoose.name == "boisson"){
        boisson = champChoose.value;
      } else if(champChoose.name == "dessert"){
        dessert = champChoose.value;
      }
      choose.forEach(function(element) {
        if(champChoose.name == element.name && element.value != champChoose.value){
          element.parentNode.parentNode.parentNode.style.backgroundColor = "";
        }
      });
    }

    var s=0, b=0, d=0;
    choose.forEach(function(element) {
      if(element.name == "sandwich"){
        s++;
      } else if(element.name == "boisson"){
        b++;
      } else if(element.name == "dessert"){
        d++;
      }
      element.addEventListener('click', function (event) {
          surligne(element);
      }, false);
    });
    if(s==0){
      sandwich = -1;
    }
    if(b==0){
      boisson = -1;
    }
    if(d==0){
      dessert = -1;
    }

    sousChoix.forEach(function(element) {
      element.addEventListener('click', function (event) {
          surligne(element.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.previousElementSibling.children[0].children[0].children[1].children[0]);
      }, false);
    });


    send.addEventListener('click', function (event) {

      if(sandwich == 0 || boisson == 0 || dessert == 0 || sauce == 0 || viande == 0){
        p = document.createTextNode(" Il faut choisir un élément de chaque catégories.");
        div.removeChild(div.lastChild);
        div.appendChild(p);
        h2.insertBefore(div, h2.children[0]);
        toptop.children[0].click();
        // On envoie pas le formulaire
        event.preventDefault();
      } else {
        //var tabPost = {'sandwich': sandwich, 'boisson': boisson, 'dessert': dessert, 'sauce': sauce, 'viande': viande};
        var tabPost = [sandwich, boisson, dessert, sauce, viande];
        for (var i = 0; i < garniture.length; i++) {
          tabPost.push(garniture[i]);
        }
        var prod = $_GET('prod');
        if(prod == null){
          post('../?page=newComm&id='+id,tabPost);
        } else {
          post('../?page=newComm&prod='+prod,tabPost);
        }
        // On envoie pas le formulaire
        event.preventDefault();
      }
    }, false);

    // get $_GET
    function $_GET(param) {
    	var vars = {};
    	window.location.href.replace( location.hash, '' ).replace(
    		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    		function( m, key, value ) { // callback
    			vars[key] = value !== undefined ? value : '';
    		}
    	);

    	if ( param ) {
    		return vars[param] ? vars[param] : null;
    	}
    	return vars;
    }
    // Send $post
    function post(path, params, method) {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }


    // Get the modal
    var modal = document.querySelectorAll('.modal');

    var choisir = document.querySelectorAll('.closed');

    // Get the button that opens the modal
    var btn = document.querySelectorAll(".open-modal");


    // When the user clicks on the button, open the modal
    btn.forEach(function(element) {
      element.onclick = function() {
        modal.forEach(function(m) {
          if(element.id.substring(5, 6) == m.id.substring(5, 6)) {
            m.style.display = "block";
          }
        });
      }
    });

    // When the user clicks on <span> (x), close the modal
    choisir.forEach(function(element) {
      element.onclick = function() {
        modal.forEach(function(m) {
          m.style.display = "none";
        });
      }
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      modal.forEach(function(m) {
        if (event.target == m) {
          m.style.display = "none";
        }
      });

    }

};
