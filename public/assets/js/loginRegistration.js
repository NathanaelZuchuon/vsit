const form = {
    firstname: document.querySelector('#firstname'),
    lastname: document.querySelector('#lastname'),
    cni: document.querySelector('#cni'),
    cni_error_box: document.querySelector('#cni-error-box'),
    pseudo: document.querySelector('#pseudo'),
    pseudo_error_box: document.querySelector('#pseudo-error-box'),
    password: document.querySelector('#password'),
    form: document.querySelector('#form'),
    btn: document.querySelector('#btn'),
};

function handlerResponse(responseObj) {
    form.btn.innerHTML = "S'enregistrer <i class='fa fa-check-circle'></i>";
    form.btn.disabled = false;

    if ( responseObj.num === 0 ) {
        swal({
            title: "Enregistrement",
            text: "Opération réussie",
            icon: "success",
        });
        setTimeout(() => {
            location.href = 'http://127.0.0.1/bhent_prods/vsit/login/';
        }, 1000);
    } else {
        switch ( responseObj.num ) {
            case 1:
                swal({
                    title: "Enregistrement",
                    text: `${responseObj.msg[0]}`,
                    icon: "error",
                    button: "Ok",
                });
                break;
            case 2:
                swal({
                    title: "Enregistrement",
                    text: "N° de CNI et pseudo existants",
                    icon: "error",
                    button: "Ok",
                });
                break;
        }
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
    } else {
        form.btn.removeChild(form.btn.firstChild);
        form.btn.innerHTML = "Enregistrement en cours...";
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
        formData.append("lastname", form.lastname.value)
        formData.append("cni", form.cni.value);
        formData.append("pseudo", form.pseudo.value);
        formData.append("password", form.password.value);

        request.open('post', 'http://127.0.0.1/bhent_prods/vsit/login/checkLoginRegistration/');
        request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
        request.send(formData);
    }
});

let eye_icon = document.querySelector("#eye-icon");
let pass_field = document.querySelector("#password");

eye_icon.addEventListener("click", () => {
    if ( eye_icon.classList.contains("fa-eye-slash") ) {
        eye_icon.classList.remove("fa-eye-slash");
        eye_icon.classList.add("fa-eye");
        pass_field.type = "password";
    } else {
        eye_icon.classList.remove("fa-eye");
        eye_icon.classList.add("fa-eye-slash");
        pass_field.type = "text";
    }
});
