var SHA256 = new Hashes.SHA256;

var loginForm = document.getElementById("login-form")
var outputDiv = document.getElementById("output-div")
var emailRegex = new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)

function registerUser(email, password) {
    outputDiv.innerHTML = "";
    email = loginForm.email.value;
    password = SHA256.hex(loginForm.password.value);
    confirm_password = SHA256.hex(loginForm.confirmpassword.value);
    fname = loginForm.fname.value;
    lname = loginForm.lname.value;

    // need to check if email is already in db
    if (password ==
        confirm_password) {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/user/user_create.php?email=" + email + "&password=" + password + "&fname=" + fname + "&lname=" + lname);
        xhttp.send();
    } else {
        outputDiv.innerHTML = "Passwords do not match";
    }
}

function getLoginInfo() {
    outputDiv.innerHTML = "";
    email = loginForm.email.value;
    password = SHA256.hex(loginForm.password.value);
    if (emailRegex.test(email)) {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "php/user/user_login.php?email=" + email + "&password=" + password);
        xhttp.send();
    } else {
        outputDiv.innerHTML = "Invalid email";
    }
}

// Prevent forms from submitting, so we can have more control over them in javascript
if (window.location.href == 'login.html') {
    document.getElementById("loginsubmit").addEventListener("click", function(event) {
        event.preventDefault();
        getLoginInfo();
    });
} else {
    document.getElementById("registersubmit").addEventListener("click", function(event) {
        event.preventDefault();
        registerUser();
    });
}