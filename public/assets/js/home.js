let num = 0;

let t = setInterval( () => {
    document.querySelector("#wrapper").style.backgroundPositionX = num + "px";
    num += 5;
}, 100);
