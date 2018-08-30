window.onload = function () {
    var email = document.getElementById("E-mail");
    var form = document.querySelector(".form");


    email.addEventListener('input', function (event) {
        email.style.backgroundColor = "red";
    }, false);

};
