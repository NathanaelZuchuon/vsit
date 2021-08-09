const form = {
    firstname: document.querySelector("#firstname"),
    lastname: document.querySelector("#lastname"),
    sex: document.querySelector("#sex"),
    cni: document.querySelector("#cni"),
    phone: document.querySelector("#phone"),
    observation: document.querySelector("#observation"),
    form: document.querySelector("#form"),
}

function handlerResponse(responseObj) {
    if (responseObj.ok) {
        swal({
            title: "Enregistrement",
            text: "Visiteur ajouté avec succès",
            icon: "success",
            button: "Ok",
        });
    } else {
        swal({
            title: "Enregistrement",
            text: "Visiteur déjà ajouté",
            icon: "info",
            button: "Ok",
        });
    }
}

form.form.addEventListener('submit', (event) => {
    event.preventDefault();

    if ( parseInt(form.cni.value) < 0 ) {
        swal({
            title: "Enregistrement",
            text: "N° de CNI invalide",
            icon: "error",
            button: "Ok",
        });
    } else if ( parseInt(form.phone.value) < 0 ) {
        swal({
            title: "Enregistrement",
            text: "N° de téléphone invalide",
            icon: "error",
            button: "Ok",
        });
    } else {
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
        formData.append("firstname", form.firstname.value);
        formData.append("lastname", form.lastname.value);
        formData.append("sex", form.sex.value);
        formData.append("cni", form.cni.value);
        formData.append("phone", form.phone.value);
        formData.append("observation", form.observation.value);

        request.open('post', 'http://vsit.bhent.org/dashboard/addVisitorInStack/');
        request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
        request.send(formData);
    }
});
