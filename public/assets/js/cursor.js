window.onload = () => {
    /* Cursor's Animation */
    let cursor_box = document.querySelector("#cursor-box");

    const moveHandler = (event) => {
        let rem = cursor_box.offsetWidth / 2;
        let x = event.pageX - rem;
        let y = event.pageY - rem;

        cursor_box.style.transform = "translate(" + x + "px, "  + y + "px)";
    };

    const setMousemoveHandler = (func) => {
        window.onmousemove = func;
    }

    setMousemoveHandler(moveHandler);

    window.onmousedown = (event) => {
        if ( event.button === 0 ) {
            setMousemoveHandler(null);
            cursor_box.classList.add('animated');

            setTimeout(() => {
                cursor_box.classList.remove('animated');
                setMousemoveHandler(moveHandler);
            }, 500);
        }
    };
    /* ------------------- */
}
