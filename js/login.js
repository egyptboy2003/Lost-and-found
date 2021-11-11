var SHA256 = new Hashes.SHA256;

var loginForm = document.getElementById("login-form")
var outputDiv = document.getElementById("output-div")

function registerUser(email, password) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "php/user/user_create.php?email=" + email + "&password=" + password);
    xhttp.send();
}

function getLoginInfo() {
    email = loginForm.email.value;
    password = SHA256.hex(loginForm.password.value);

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "php/user/user_login.php?email=" + email + "&password=" + password);
    xhttp.send();
}


// Prevent login form from submitting, so we can have more control over it in javascript
document.getElementById("loginsubmit").addEventListener("click", function(event) {
    event.preventDefault();
    getLoginInfo();
});