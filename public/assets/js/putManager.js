const form = {
    pseudo: document.querySelector("#pseudo"),
    form: document.querySelector("#form"),
    btn: document.querySelector("#btn"),
};

function handlerResponse(responseObj) {
    form.btn.innerHTML = "Mettre manager<i class='fa fa-user-shield'></i>";
    form.btn.disabled = false;

    if (responseObj.ok) {
        swal({
            title: "Enregistrement",
            text: "Status mis à jour avec succès",
            icon: "success",
            button: "Ok",
        });
    } else {
        swal({
            title: "Enregistrement",
            text: "Pseudo incorrect",
            icon: "error",
            button: "Ok",
        });
    }
}

form.form.addEventListener('submit', (event) => {
    event.preventDefault();

    form.btn.removeChild(form.btn.firstChild);
    form.btn.innerHTML = "Action en cours...";
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

    request.open('post', 'http://vsit.bhent.org/dashboard/putManager/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
});
