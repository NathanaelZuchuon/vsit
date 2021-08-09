const form = {
    cni: document.querySelector("#cni"),
    form: document.querySelector("#form"),
};

function handlerResponse(responseObj) {
    if (responseObj.ok) {
        swal({
            title: "Enregistrement",
            text: "Visiteur retiré avec succès",
            icon: "success",
            button: "Ok",
        });
    } else {
        swal({
            title: "Enregistrement",
            text: "Visiteur non existant",
            icon: "info",
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
    formData.append("cni", form.cni.value);

    request.open('post', 'http://vsit.bhent.org/dashboard/removeVisitorFromStack/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
});
