function Login() {
    loading(true);
    let username = document.getElementById("bankLoginUsername");
    let password = document.getElementById("bankLoginPassword");
    if(username.value.trim() == "") {
        error("Please enter your username/email/phone number");
        loading(false);
        return;
    } else if(password.value == "") {
        loading(false);
        error("Sorry, you must provide a valid password!");
        return;
    }
    let xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function() {
        if(this.readyState == 4) {
            if(this.status == 200) {
                window.location.assign('/who_is');
            } else if(this.status == 400) {
                error("Wrong Username/Email/Phone or password!");
                loading(false);
            } else if(this.status == 423) {
                error("Sorry this account has been locked, please contact bank for help.");
                loading(false);
            } else if(this.status == 403){
                error("Sorry this account has been blocked, please contact bank support.");
                loading(false);
            } else if(this.status == 102) {
                error("Please wait for few days before accessing this account, bank is working to get it active.");
                loading(false);
            } else {
                error("Oops! Something went wrong!!");
                loading(false);
            }
        }
    }
    xmlHttpRequest.open("POST", '/login_server.php');
    xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttpRequest.send("username=" + encodeURIComponent(username.value) + "&password=" + encodeURIComponent(password.value));
}




function getLoginOTP(button = null) {
    let checkOTP = null;
    let otp = document.getElementById('forgot-password-otp');
    let user = document.getElementById('forgot-password-user');
    let label = document.getElementById('forgot-password-otp-label');
    let password = document.getElementById('forgot-password-new-password');
    let nextTime = document.getElementById('forgot-password-next-request-time');
    let atempts = document.getElementById('forgot-password-next-atempts');
    try {
        removeEventListener('input', checkOTP);
    } catch(e) {
        console.error(e);
    }

    if(user.value.trim() == "") {
        error('Please enter you account email or phone number');
        return;
    }
    if(password.value == "") {
        error('Please a new password for your account');
        return;
    } else  if(password.value.length < 6) {
        error('Password is too short, password must be 6 in length and above');
        return;
    } else if(password.value.length > 100) {
        error('Sorry we recomend using a password that you can remember');
        return;
    }

    if(user.value.trim() != "") {
        loading(true);
        let xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onload = function() {
            if(this.status == 200) {
                otp.style.display = 'block';
                user.disabled = true;
                password.disabled = true;
                if(button != null) {
                    button.disabled = true;
                }
                label.innerText = this.responseText;

                if(button != null) {
                    let timeINRequest = 60;
                    let countNextRequest = setInterval(()=>{
                        timeINRequest -= 1;
                        nextTime.innerText = "You can request a new one in " + timeINRequest + 's';
                        if(timeINRequest <= 0) {
                            clearInterval(countNextRequest);
                            nextTime.innerText = "";
                        }
                    }, 1000);
                    let countNextRequestOut = setTimeout(()=>{
                        
                        button.disabled = false;

                    }, ((1000 * 60)));
                }
                
                loading(false);
                let numOfAtemptsLeft = 5;
                checkOTP = otp.addEventListener('input', ()=> {

                    let getOTP = otp.value;
                    if(getOTP.length == 6) {
                        loading(true);

                        let changePasswordXmlHttpRequest = new XMLHttpRequest();
                        changePasswordXmlHttpRequest.onload = function() {
                            if(this.status == 200) {

                                otp.value = "";
                                user.value = "";
                                password.value = "";
                                label.innerText = "";
                                alert('Password Change Successfully!');
                                forgotPassword();
                                alert('Please login!');
                                otp.removeEventListener('input', checkOTP);
                                loading(false);

                            } else if(this.status == 400) {
                                numOfAtemptsLeft -= 1;
                                atempts.innerText = "You have " + numOfAtemptsLeft + " atempts left";
                                if(numOfAtemptsLeft <= 0) {
                                    otp.value = "";
                                    user.value = "";
                                    password.value = "";
                                    label.innerText = "";
                                    atempts.innerText = "";
                                    otp.style.display = "none";
                                    user.disabled = false;
                                    password.disabled = false;
                                }
                                loading(false);
                                error('Wrong OTP!');
                                otp.value = "";
                            } else {
                                loading(false);
                                error('Oops! That\'s and error, please try again.');
                            }
                        }
                        changePasswordXmlHttpRequest.open('POST', './Reset_Password.php');
                        changePasswordXmlHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        changePasswordXmlHttpRequest.send(
                            'user=' + encodeURIComponent(user.value) + 
                            '&password=' + encodeURIComponent(password.value) +
                            '&otp=' + encodeURIComponent(getOTP)
                        );
                    } else if(getOTP.length > 6) {
                        otp.value = getOTP.substr(0, 6);
                    }

                });
            } else {
                error(this.responseText);
                loading(false);
            }
        }
        xmlHttpRequest.open('POST', './OTP.php');
        xmlHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlHttpRequest.send('user=' + encodeURIComponent(user.value));
    }

}