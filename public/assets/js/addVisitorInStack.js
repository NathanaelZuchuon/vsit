const form = {
    firstname: document.querySelector("#firstname"),
    lastname: document.querySelector("#lastname"),
    sex: document.querySelector("#sex"),
    cni: document.querySelector("#cni"),
    phone: document.querySelector("#phone"),
    observation: document.querySelector("#observation"),
    form: document.querySelector("#form"),
    btn: document.querySelector("#btn"),
}

function handlerResponse(responseObj) {
    form.btn.innerHTML = "Ajouter<i class='fa fa-plus'></i>";
    form.btn.disabled = false;

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

    if ( !( /^\d{10}$/.test(form.cni.value) ) ) {
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
        form.btn.removeChild(form.btn.firstChild);
        form.btn.innerHTML = "Ajout en cours...";
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
        formData.append("firstname", form.firstname.value);
        formData.append("lastname", form.lastname.value);
        formData.append("sex", form.sex.value);
        formData.append("cni", form.cni.value);
        formData.append("phone", form.phone.value);
        formData.append("observation", form.observation.value);

        request.open('post', 'http://127.0.0.1/bhent_prods/vsit/dashboard/addVisitorInStack/');
        request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
        request.send(formData);
    }
});
