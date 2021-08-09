const form = {
    pseudo: document.querySelector('#pseudo'),
    password: document.querySelector('#password'),
    errors_box: document.querySelector('#errors-box'),
    form: document.querySelector('#form'),
};

function handlerResponse(responseObj) {
    if (responseObj.ok) {
        location.href = 'http://127.0.0.1/bhent_prods/vsit/dashboard';
    } else {
        swal({
            title: "Connection",
            text: "Données invalides",
            icon: "error",
            button: "Ok",
        });
    }
}

form.form.addEventListener('submit', (event) => {
    event.preventDefault();
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
        }
    };

    const formData = new FormData();
    formData.append("pseudo", form.pseudo.value);
    formData.append("password", form.password.value)

    request.open('post', 'http://127.0.0.1/bhent_prods/vsit/login/checkLogin');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
});
