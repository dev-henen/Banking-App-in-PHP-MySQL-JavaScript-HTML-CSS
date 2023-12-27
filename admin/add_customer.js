function validate_new_customer(form) {
    let firstname = document.getElementById("new-customer-firstname");
    let lastname = document.getElementById("new-customer-lastname");
    let genderMale = document.getElementById("new-customer-gender-m");
    let genderFemale = document.getElementById("new-customer-gender-f");
    let birthday = document.getElementById("new-customer-birthday");
    let email = document.getElementById("new-customer-email");
    let phone = document.getElementById("new-customer-phone");
    let balance = document.getElementById("new-customer-balance");
    let pin = document.getElementById("new-customer-pin");
    let username = document.getElementById("new-customer-username");
    let password = document.getElementById("new-customer-password");
    let gender = 'other';

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

    //Gender validation
    if(!genderFemale.checked && !genderMale.checked) {
        error('Sorry our customers must be a valid person, gender must be checked.');
        return;
    } else if(genderFemale.checked) {
        gender = "female";
    } else if(genderMale.checked) {
        gender = "male";
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

    //New balance validation
    if(balance.value.trim() == "") {
        //Nothing
    } else if(/[^0-9\.]/.test(balance.value)) {
        error('Sorry enter a valid amount in USD');
        phone.value = "";
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
        error('Please enter login password');
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
                alert('New customer "' + firstname.value + '" added successfully.');
                firstname.value = '';
                lastname.value = '';
                genderMale.checked = false;
                genderFemale.checked = false;
                birthday.value = '';
                email.value = '';
                phone.value = '';
                balance.value = '';
                pin.value = '';
                username.value = '';
                password.value = '';
            } else {
                loading(false);
                error(this.responseText);
            }
        }
    }
    xmlHttpRequest.open("POST", "./add_customer.php");
    xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttpRequest.send(
        "firstname=" + encodeURIComponent(firstname.value) + 
        "&lastname=" + encodeURIComponent(lastname.value) +
        "&gender=" + encodeURIComponent(gender) +
        "&birthday=" + encodeURIComponent(birthday.value) +
        "&email=" + encodeURIComponent(email.value) +
        "&phone=" + encodeURIComponent(phone.value) +
        "&balance=" + encodeURIComponent(balance.value) +
        "&pin=" + encodeURIComponent(pin.value) +
        "&username=" + encodeURIComponent(username.value) +
        "&password=" + encodeURIComponent(password.value) 
    );
    
}