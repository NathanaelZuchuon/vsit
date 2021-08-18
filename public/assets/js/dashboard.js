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
            location.href = 'http://vsit.bhent.org/home/';
        }, 1000);
    };

    request.open('post', 'http://vsit.bhent.org/vsit/dashboard/logout/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send();
});
