let i = 0;
let titles_nodes = [];
let t = setInterval(animate, 2000);
let colors = ["#ff5b4f","#ff0080","#0a72ef"];
let title = document.querySelector("#titles");

title.childNodes.forEach( (node) => {
    if ( node.nodeType === Node.ELEMENT_NODE ) {
        titles_nodes.push(node);
    }
});

function animate () {
    if ( i > 2) i = 0;

    titles_nodes[i].style.color = colors[i];
    setTimeout(() => {
        titles_nodes[i].style.color = 'rgba(206, 206, 206, 0.2)';
        i++;
    }, 1000);
}
