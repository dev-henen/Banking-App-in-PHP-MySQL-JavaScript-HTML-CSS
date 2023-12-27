function client_search() {
    let root = document.getElementById('client-search-root');
    let q = document.getElementById('client-search-input');

    if(q.value.trim() != "") {

        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.onload = function() {
            try {

                let resultObject = JSON.parse(this.responseText);
                let resultKeys = Object.keys(resultObject);
                let resultLength = resultKeys.length;
                let lebel = "";
                let oldLebel = "";
                let template = "";

                for(let i = 0; i < resultLength; i++) {

                    let key = resultKeys[i];
                    let singleObject = resultObject[key];

                    if(oldLebel != key) {
                        lebel = '<li class="label">' + key.toUpperCase() + '</li>';
                    } else {
                        lebel = "";
                    }

                    template += lebel;

                    for(let i = 0; i < singleObject.length; i++) {

                        template += `
                            <li class="result">
                                <p class="body">${singleObject[i].Body}</p>
                                <p class="time"><time>${singleObject[i].RecieveDate}</time></p>
                            </li>
                        `;

                    }

                }

                root.innerHTML = template;
                

            } catch(e) {
                console.log(this.responseText);
                error('Error! Something went wrong in the server'); 
            }
        }
        xmlHttpRequest.open('GET', './search.php?q=' + encodeURIComponent(q.value));
        xmlHttpRequest.send();

    }
}