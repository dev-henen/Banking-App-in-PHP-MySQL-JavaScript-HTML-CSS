function takeActionOnCusromer(type, customer) {
    if(['block', 'delete', 'lock', 'activate', 'pend'].includes(type.toString().toLowerCase())) {
        const actions = {
            block: 'Blocked',
            delete: 'Deleted',
            lock: 'Locked',
            activate: 'Activated',
            pend: 'Pending'
        }

        let confir = confirm('Are you sure you want to ' + type.toString().toLowerCase() + ' customer?');
        if(!confir) {
            return;
        }

        let xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onload = function() {

            if(this.status == 200) {

                console.log(this.responseText);

                alert('Customer ' + actions[type].toString().toLowerCase());

            } else {
                error('Oops! Something wenr wrong performing your action.');
            }

        }
        xmlHttpRequest.open('POST', './take_action_on_customer.php');
        xmlHttpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlHttpRequest.send('action_type=' + type.toString().toLowerCase() + '&customer=' + customer);

    }
}