let main = document.querySelector("#main");
let loader = document.querySelector("#loader");
let add_visitor = document.querySelector("#add-visitor");
let show_visitors = document.querySelector("#show-visitors");

const form = {
    firstname: document.querySelector('#firstname'),
    lastname: document.querySelector('#lastname'),
    sex: document.querySelector('#sex'),
    form: document.querySelector('#form'),
    cni: document.querySelector('#cni'),
    cni_user: document.querySelector('#cni-user'),
    phone: document.querySelector('#phone'),
    arrived_at: document.querySelector('#arrived_at'),
    left_at: document.querySelector('#left_at'),
    observation: document.querySelector('#observation'),
};

add_visitor.addEventListener("click", addVisitor);
show_visitors.addEventListener("click", showVisitors);

form.form.addEventListener('submit', (event) => {
    loader.style.display = "block";
    event.preventDefault();
    const request = new XMLHttpRequest();

    request.onload = () => { handlerResponse(); };

    const formData = new FormData();
    formData.append("firstname", form.firstname.value);
    formData.append("lastname", form.lastname.value);
    formData.append("cni", form.cni.value);
    formData.append("phone", form.phone.value);
    formData.append("sex", form.sex.value);
    formData.append("cni_user", form.cni_user.innerHTML);
    formData.append("arrived_at", form.arrived_at.value);
    formData.append("left_at", form.left_at.value);
    formData.append("observation", form.observation.value);

    request.open('post', 'http://127.0.0.1/bhent_prods/vsit/dashboard/addVisitor');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send(formData);
});

function hideNode () {
    let ids = ["form", "board", "report"];
    main.childNodes.forEach((node) => {
        if ( ids.includes(node.id) === true ) node.style.display = "none";
    });
}

function setDisplay (id) {
    setTimeout(() => {
        document.querySelector(id).style.display = "flex";
    }, 10);
}

function addVisitor () {
    hideNode();
    setDisplay("#form");

}
function showVisitors () {
    hideNode();
    setDisplay("#board");
}

function handlerResponse () {
    setTimeout(() => {
        loader.style.display = "none";
        swal({
            title: "Enregistrement",
            text: "Opération réussie",
            icon: "success",
        });
    }, 2000);
}
