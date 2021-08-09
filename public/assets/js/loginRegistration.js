const form = {
    firstname: document.querySelector('#firstname'),
    lastname: document.querySelector('#lastname'),
    cni: document.querySelector('#cni'),
    cni_error_box: document.querySelector('#cni-error-box'),
    pseudo: document.querySelector('#pseudo'),
    pseudo_error_box: document.querySelector('#pseudo-error-box'),
    password: document.querySelector('#password'),
    form: document.querySelector('#form'),
};

function removeNode (container) {
    while (form[container].firstChild) {
        form[container].removeChild(form[container].firstChild);
    }
}

function setNone (elem, container) {
    form[elem].style.border = "none";
    form[elem].style.boxShadow = "none";
    removeNode(container);
}

function handlerResponse(responseObj) {
    if (responseObj.ok) {
        swal({
            title: "Enregistrement",
            text: "Opération réussie",
            icon: "success",
        });
        setTimeout(() => {
            location.href = 'http://vsit.bhent.org/login/';
        }, 1000);
    } else {
        removeNode('cni_error_box');
        removeNode('pseudo_error_box');

        responseObj.cni_errors.forEach((message) => {
            form.cni_error_box.textContent = message;
            form.cni.style.border = "1px solid #ff253a";
            form.cni.style.boxShadow = "0 0 2px #ff253a";

        });
        responseObj.pseudo_errors.forEach((message) => {
            form.pseudo_error_box.textContent = message;
            form.pseudo.style.border = "1px solid #ff253a";
            form.pseudo.style.boxShadow = "0 0 2px #ff253a";
        });

        setTimeout(() => {
            setNone('cni', 'cni_error_box');
            setNone('pseudo', 'pseudo_error_box');
        }, 1000);
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
    formData.append("firstname", form.firstname.value);
    formData.append("lastname", form.lastname.value)
    formData.append("cni", form.cni.value);
    formData.append("pseudo", form.pseudo.value);
    formData.append("password", form.password.value);

    request.open('post', 'http://vsit.bhent.org/login/checkLoginRegistration/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
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
