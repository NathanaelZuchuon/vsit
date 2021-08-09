let span = document.querySelector("#logout");

span.addEventListener('click', () => {
    const request = new XMLHttpRequest();

    request.onload = () => {
        swal({
            title: "Déconnexion",
            text: "Déconnecter avec succès",
            icon: "success",
        });
        setTimeout(() => {
            location.href = 'http://vsit.bhent.org/home/';
        }, 1500);
    };

    request.open('post', 'http://vsit.bhent.org/dashboard/logout/');
    request.setRequestHeader('Content', 'application/x-www-form-urlencoded');
    request.send();
});
