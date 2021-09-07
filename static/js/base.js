window.onresize = function() {
    let height = window.innerHeight;
    let body = document.getElementById('main');
    body.style.height = 'auto';
    if (body.scrollHeight < height) {
        body.style.height = height + 'px';
    }
}

window.onscroll = function() {
    let width = window.innerWidth;
    let height = window.innerHeight;
    let offset = window.pageYOffset;
    let scrollUp = document.getElementById('scrollUp');
    if (offset > 0 && width > 1500) {
        scrollUp.style.display = 'block';
        scrollUp.style.height = height + 'px';
    }
    else {
        scrollUp.style.display = 'none';
    }
}

function scrollUp() {
    let offset = window.pageYOffset;
    window.scrollBy(0, -offset);
}
