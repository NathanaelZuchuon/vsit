/* Cursor's Animation */
let cursor_box = document.querySelector("#cursor-box");
let cursor_box_container = document.querySelector("#cursor-box-container");

addEventListener('mousemove', tellPos);

function tellPos (e) {

    document.body.style.overflowY = ( e.pageX >= screen.availWidth - 15 && e.pageX <= screen.availWidth ) ? "scroll" : "hidden";

    cursor_box.style.left = e.pageX + "px";
    cursor_box.style.top = e.pageY + "px";

    let rem = ( cursor_box_container.clientWidth - cursor_box.clientWidth ) / 2;

    cursor_box_container.style.left = ( e.pageX - rem ) + "px";
    cursor_box_container.style.top = ( e.pageY - rem ) + "px";

    cursor_box.style.display = "block";
    cursor_box_container.style.display = "block";
}
/* ------------------- */
