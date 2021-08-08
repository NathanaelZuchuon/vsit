const form = {
    start_at: document.querySelector("#start_at"),
    end_at: document.querySelector("#end_at"),
    form: document.querySelector("#form"),
};

form.form.onsubmit = () => {
    if ( form.start_at.value > form.end_at.value ) {
        swal({
            title: "Génération du rapport",
            text: "Dates invalides",
            icon: "error",
            button: "Ok",
        });
        return false;
    } else {
        form.form.action = 'http://127.0.0.1/bhent_prods/vsit/dashboard/makeReport';
    }
}
