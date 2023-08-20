const form = {
    pseudo: document.querySelector('#pseudo'),
    password: document.querySelector('#password'),
    errors_box: document.querySelector('#errors-box'),
    form: document.querySelector('#form'),
    btn: document.querySelector('#btn'),
};

function handlerResponse(responseObj) {
    form.btn.style.padding = "0 35%";
    form.btn.innerHTML = "Allons-y <i class='fa fa-arrow-circle-right'></i>";
    form.btn.disabled = false;

    if (responseObj.ok) {
        location.href = 'http://127.0.0.1/vsit/dashboard/';
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

    form.btn.removeChild(form.btn.firstChild);
    form.btn.style.padding = "0 25%";
    form.btn.innerHTML = "Connection en cours...";
    form.btn.disabled = true;

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

    request.open('post', 'http://127.0.0.1/vsit/login/checkLogin/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
});
