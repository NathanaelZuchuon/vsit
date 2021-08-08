function getKeys (arr) {
    let keys = [];

    for ( let key of Object.keys(arr[0]) ) {
        if ( isNaN( parseInt(key) ) ) {
            keys.push(key);
        }
    }

    return keys;
}

function handlerResponse (responseObj) {
    let i = 0;
    let k = 0;
    let left = 0;
    let titles = {
        'firstname': 'Nom',
        'lastname': 'Prénom',
        'sex': 'Sexe',
        'cni': 'N° de sa CNI',
        'phone': 'N° de téléphone',
        'arrived_at': 'Heure d\'arrivée',
        'left_at': 'Heure de départ',
    };

    let persons = responseObj.personsInfos;
    let personsKey = getKeys(persons);

    let visitors = responseObj.visitorsInfos;
    let visitorsKey = getKeys(visitors);

    for ( let visitor of visitors ) {
        let curr_person = persons[i];

        if ( visitor['personID'] !== curr_person['id'] )  {
            i++;
        }

        curr_person = persons[i];

        let div_visitor_infos = document.createElement('div');
        div_visitor_infos.classList.add("visitor-infos");
        div_visitor_infos.style = 'left: ' + left + 'px;';

        for ( let key of personsKey ) {

            if ( Object.keys(titles).includes(key) ) {

                let div_infos = document.createElement('div');
                div_infos.classList.add("infos");

                let span_title = document.createElement('span');
                span_title.classList.add("title");
                span_title.textContent = titles[key];

                let span_value = document.createElement('span');
                span_value.classList.add("value");
                span_value.textContent = curr_person[key];

                div_infos.appendChild(span_title);
                div_infos.appendChild(span_value);

                div_visitor_infos.appendChild(div_infos);

            }

        }

        for ( let key of visitorsKey ) {

            if ( Object.keys(titles).includes(key) ) {

                let div_infos = document.createElement('div');
                div_infos.classList.add("infos");

                let span_title = document.createElement('span');
                span_title.classList.add("title");
                span_title.textContent = titles[key];

                let span_value = document.createElement('span');
                span_value.classList.add("value");

                if ( titles[key] === 'Heure de départ' ) {
                    span_value.innerHTML = ( visitor['arrived_at'] === visitor['left_at'] ) ? "<i>Il n'est pas encore sorti.</i>" : visitor[key];
                } else {
                    span_value.textContent = visitor[key];
                }

                div_infos.appendChild(span_title);
                div_infos.appendChild(span_value);

                div_visitor_infos.appendChild(div_infos);

            }

        }

        slider.appendChild(div_visitor_infos);
        left += slider.clientWidth;
    }
}

const request = new XMLHttpRequest();

request.onload = () => {
    let responseObj = null;
    try {
        responseObj = JSON.parse(request.responseText);
    } catch (e) {
        console.error('Could not parse JSON !');
    }
    if (responseObj) {
        handlerResponse(responseObj);
        let slider_nodes = [];
        let slider = document.querySelector("#slider");
        let chevron_left = document.querySelector("#chevron-left");
        let chevron_right = document.querySelector("#chevron-right");

        chevron_left.addEventListener("click", prev);
        chevron_right.addEventListener("click", next);

        /* Get the real child nodes of the slider */
        function getNodes () {
            slider.childNodes.forEach( (node) => {
                if ( node.nodeName !== "#text" ) slider_nodes.push(node);
            });
        }
        getNodes();
        /* ************************************** */

        /* Slider */
        function prev () {
            if ( parseInt(slider_nodes[slider_nodes.length - 1 ].style.left) >= slider.clientWidth ) {
                slider_nodes.forEach( (node) => {
                    let value = parseInt(node.style.left) - slider.clientWidth;
                    node.style.left = value + "px";
                });
            }
        }

        function next () {
            if ( parseInt(slider_nodes[0].style.left) < 0 ) {
                slider_nodes.forEach( (node) => {
                    let value = parseInt(node.style.left) + slider.clientWidth;
                    node.style.left = value + "px";
                });
            }
        }
        /* ****** */
    }
};

request.open('post', 'http://127.0.0.1/bhent_prods/vsit/dashboard/showVisitors');
request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
request.send();
