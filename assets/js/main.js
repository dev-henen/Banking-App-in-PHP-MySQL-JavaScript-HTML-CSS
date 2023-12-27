
function mobileOpenMenu() {
    let x = document.getElementById("mobile-menu");
    if(x.style.height == "500px") {
        x.style.height = "0px";
    } else {
        x.style.height = "500px";
    }
}

function bankLogin() {
    let x = document.getElementById("bank-login");
    let clickOverlayToHide = x.addEventListener('click', (event) => {
        if(event.target == x || event.target == x.getElementsByClassName('wrap-like-midle')[0]) {
            bankLogin();
        }
    });
    if(x.style.display == "block") {
        x.style.display = "none";
        x.removeEventListener('click', clickOverlayToHide);
    } else {
        x.style.display = "block";
    }
}

function error(message = "") {
    let error = document.getElementById("layout-error");
    let msg = document.getElementById("layout-error-message");
    if(message == "") {
        msg.innerText = "";
        error.style.display = "none";
    } else {
        msg.innerText = message;
        error.style.display = "block";
        let c = setTimeout(() => { 
            error.style.display = "none";
            msg.innerText = "";
            clearTimeout(c);
        }, (1000 * 5));
    }
}

function loading(state) {
    let ajax = document.getElementById("layout-ajax-clock");
    if(state === false) {
        ajax.style.display = "none";
    } else if(state === true) {
        ajax.style.display = "flex";
    }
}

function openLeftDashboard() {
    let dashboard = document.getElementById("dashboard");
    if(dashboard.style.display == "block") {
        dashboard.style.display = "none";
    } else {
        dashboard.style.display = "block";
    }
}


function showLeftNestedLinks(clickedElement) {
    let content = clickedElement.parentElement.getElementsByClassName("content")[0];
    let indicator = clickedElement.getElementsByTagName('span')[0];
    if(content.style.display == "block") {
        content.style.display = "none";
        indicator.classList.remove("bi-chevron-up");
        indicator.classList.add("bi-chevron-down");
    } else {
        content.style.display = "block";
        indicator.classList.remove("bi-chevron-down");
        indicator.classList.add("bi-chevron-up");
    }
}

function logout() {
    if(confirm('Do you want to logout?')) {
        window.location.replace('/logout.php');
    }
}

function forgotPassword() {
    bankLogin();
    let x = document.getElementById('bank-login-forgot-password');
    if(x.style.display == "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}