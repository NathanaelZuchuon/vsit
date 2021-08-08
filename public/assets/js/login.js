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
        while (form.errors_box.firstChild) {
            form.errors_box.removeChild(form.errors_box.firstChild);
        }
        responseObj.messages.forEach((message) => {
            let span_container = document.createElement('span');
            span_container.classList.add('error');

            let span_msg  = document.createElement('span');
            span_msg.classList.add('error-msg');
            span_msg.textContent = message;

            let i = document.createElement('i');
            i.classList.add('fa'); i.classList.add('fa-times-circle');

            span_container.append(i); span_container.append(span_msg);
            form.errors_box.append(span_container);
            form.errors_box.style.animation = "show 2s";
            setTimeout(() => {
                form.errors_box.style.animation = "none";
            }, 2000);
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
