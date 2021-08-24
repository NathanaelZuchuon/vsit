let span = document.querySelector("#logout");

span.addEventListener('click', () => {
    const request = new XMLHttpRequest();

    request.onload = () => {
        swal({
            title: "Déconnexion",
            text: "Déconnecté avec succès",
            icon: "success",
        });
        setTimeout(() => {
            location.href = 'http://127.0.0.1/bhent_prods/vsit/home/';
        }, 1000);
    };

    request.open('post', 'http://127.0.0.1/bhent_prods/vsit/dashboard/logout/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send();
});
