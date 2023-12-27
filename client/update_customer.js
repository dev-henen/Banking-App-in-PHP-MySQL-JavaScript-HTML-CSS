function validate_update_customer(form) {
    let id = document.getElementById("update-customer-id");
    let firstname = document.getElementById("update-customer-firstname");
    let lastname = document.getElementById("update-customer-lastname");
    let birthday = document.getElementById("update-customer-birthday");
    let email = document.getElementById("update-customer-email");
    let phone = document.getElementById("update-customer-phone");
    let pin = document.getElementById("update-customer-pin");
    let address = document.getElementById("update-customer-address");
    let username = document.getElementById("update-customer-username");
    let password = document.getElementById("update-customer-password");

    //Firstname validation
    if(firstname.value.trim() == "") {
        error('Please enter new customer\'s first name');
        return;
    } else if(/[^a-zA-Z]/.test(firstname.value)) {
        error('First name is not a valid name, please enter a valid name.');
        firstname.value = "";
        return;
    } else if(firstname.value.length > 30) {
        error('The customer\'s first name is too long');
        return;
    }

    //Lastname validation
    if(lastname.value.trim() == "") {
        error('Please enter new customer\'s last name');
        return;
    } else if(/[^a-zA-Z]/.test(lastname.value)) {
        error('Lastname is not a valid name, please enter a valid name.');
        lastname.value = "";
        return;
    } else if(lastname.value.length > 30) {
        error('The customer\'s last name is too long');
        return;
    }

    //Birthday validation
    if(birthday.value.split('/').length == 3 || birthday.value.split('-').length == 3) {



    } else {
        error('Sorry you must provide a valid customer\'s birthday');
        birthday.value = "";
        return;
    }

    //email validation
    if(email.value == null || email.value.trim() == "") {
        //Nothing
    } else if(!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.value)) {
        error('Please provide a valid email address for new customer');
        return;
    }
    
    //Phone number validation
    if(phone.value.trim() == "") {
        error('Please enter new customer\'s phone number');
        return;
    } else if(/[^0-9\+]/.test(phone.value)) {
        error('Sorry we do not allow such phone numbers to be use on our services.');
        phone.value = "";
        return;
    } else if(phone.value.length > 15) {
        error('The customer\'s phone number is not supported');
        return;
    }
   
    //PIN validation
    if(pin.value.trim() == "") {
        error('Please enter customer\'s withdrawer pin');
        return;
    } else if(/[^0-9]/.test(pin.value)) {
        error('Invalid PIN');
        pin.value = "";
        return;
    } else if(pin.value.length != 4) {
        error('Unsupported 4 digit PIN');
        return;
    }

    if(address.value.trim() != "" && address.value.length > 200) {
        error('We don\'t allow such addresses');
        return;
    }
  
    //Username validation
    if(username.value.trim() == "") {
        error('Please enter login username');
        return;
    } else if(/[^a-zA-Z0-9]/.test(username.value)) {
        error('Username can only contain letters & numbers');
        username.value = "";
        return;
    } else if(username.value.length > 30) {
        error('Login username is too long');
        return;
    }

    //Password validation
    if(password.value == "") {
        error('Please enter login password, new/old');
        return;
    } if(password.value.length > 100) {
        error('Please we recommend using a password that you can remember.');
        return;
    }

    loading(true);
    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function() {
        if(this.readyState == 4) {
            if(this.status == 200) {
                loading(false);
                alert('Updated customer "' + firstname.value + '" successfully.');
            } else {
                loading(false);
                error(this.responseText);
            }
        }
    }
    xmlHttpRequest.open("POST", "./update_customer.php");
    xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttpRequest.send(
        "firstname=" + encodeURIComponent(firstname.value) + 
        "&lastname=" + encodeURIComponent(lastname.value) +
        "&birthday=" + encodeURIComponent(birthday.value) +
        "&email=" + encodeURIComponent(email.value) +
        "&phone=" + encodeURIComponent(phone.value) +
        "&pin=" + encodeURIComponent(pin.value) +
        "&address=" + encodeURIComponent(address.value) +
        "&id=" + encodeURIComponent(id.value) +
        "&username=" + encodeURIComponent(username.value) +
        "&password=" + encodeURIComponent(password.value)
    );
    
}