var SHA256 = new Hashes.SHA256;

var loginForm = document.getElementById("login-form")
var outputDiv = document.getElementById("output-div")

function getInfo() {
    email = loginForm.email.value;
    password = SHA256.hex(loginForm.password.value);

    // const xhttp = new XMLHttpRequest();
    // xhttp.open("POST", "php/user_create.php?email=" + email + "&password=" + password);
    // xhttp.send();

    sessionStorage.setItem('logintoken', 'beans');
    window.location.href = "index.html";

}


// Prevent login form from submitting, so we can have more control over it in javascript
document.getElementById("loginsubmit").addEventListener("click", function(event) {
    event.preventDefault();
    getInfo();
});