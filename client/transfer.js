function transfer_funds() {
    let account = document.getElementById('add-fund-account-number');
    let amount = document.getElementById('add-fund-amount');
    let bank = document.getElementById('add-fund-bank');

    if(account.value.trim() == "") {
        error('Please provide beneficial account number');
        return;
    } else if(/[^0-9]/.test(account.value)) {
        error('Invalid account number');
        return;
    } else if(account.value.length != 10) {
        error('Unsupported account number');
        return;
    }

    if(amount.value.trim() == "") {
        error('Please specify the amount to fund the current account');
        return;
    } else if(/[^0-9]\./.test(account.value)) {
        error('Invalid amount to fund');
        return;
    } 

    if(bank.value.trim() == "") {
        error('Select bank');
        return;
    }

    loading(true);
    if(bank.value == "other") {
        document.getElementById('confirm-funding').style.display = 'block';
        document.getElementById('add-fund-response').innerHTML = "<p>Transfering $" +
        amount.value +" to " + account.value + "</p> ";
        loading(false);

    } else {

        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onload = function() {
            if(this.status == 200) {
                document.getElementById('add-fund-response').innerHTML = "<p>To transfer " +
                "$" + amount.value + " to " + this.responseText + ", ";
                document.getElementById('confirm-funding').style.display = 'block';
            } else if(this.status == 400) {
                error('No customer was found with this account number');
            } else if(this.status == 423) {
                error('This account has been locked, please contact us through our customer support email to unlock this account.');
            } else {
                error('Oops! Something went wrong processing your transaction');
            }
            loading(false);
        }
        xmlHttpRequest.open('POST', './transfer.php');
        xmlHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlHttpRequest.send('confirm=true&account=' + account.value);

    }
}


function confirm_fund() {
    let account = document.getElementById('add-fund-account-number');
    let amount = document.getElementById('add-fund-amount');
    let bank = document.getElementById('add-fund-bank');
    let pin = document.getElementById('add-fund-pin');

    if(account.value.trim() == "") {
        error('Please provide customer account number');
        return;
    } else if(/[^0-9]/.test(account.value)) {
        error('Invalid account number');
        return;
    } else if(account.value.length != 10) {
        error('Unsupported account number');
        return;
    }

    if(amount.value.trim() == "") {
        error('Please specify the amount to fund the current account');
        return;
    } else if(/[^0-9]\./.test(account.value)) {
        error('Invalid amount to fund');
        return;
    }
    
    if(pin.value.trim() == "") {
        error('Please enter your 4 degit PIN to continue');
        return;
    } else if(/[^0-9]\./.test(pin.value)) {
        error('Invalid PIN');
        return;
    }

    if(pin.value.trim() == "") {
        error('Select bank');
        return;
    }

    loading(true);
    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onload = function() {
        if(this.status == 200) {
            //console.log(this.responseText);
            alert('Tranasaction made sucessfully!');
            account.value = "";
            amount.value = "";
            pin.value = "";
            main();
            document.getElementById('confirm-funding').style.display = 'none';
        } else if(this.status == 400) {
            error(this.responseText);
        } else if(this.status == 423) {
            error('This account has been locked, please contact us through our customer support email to unlock this account.');
        } else {
            error('Oops! Something went wrong processing your transaction');
        }
        loading(false);
    }
    xmlHttpRequest.open('POST', './transfer.php');
    xmlHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlHttpRequest.send('add=true&account=' + account.value + '&amount=' + amount.value + '&pin=' + pin.value + '&bank=' + bank.value);
}