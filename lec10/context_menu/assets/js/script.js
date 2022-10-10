

let toggleColor = document.querySelector('#toggleColor'),
    body = document.querySelector('body'),
    customMenu = document.querySelector(".custom-menu");


// dark mode event
toggleColor.onclick = () => {
    body.classList.toggle('dark');
    let theme;
    if(body.classList.contains('dark')) {
        theme = 'dark'
    } else {
        theme = 'light'
    }
    localStorage.setItem('theme', JSON.stringify(theme));
}

let getTheme = JSON.parse(localStorage.getItem('theme'));
if(getTheme === 'dark') {
    body.classList.toggle('dark');
}


// context menu
window.oncontextmenu = (e) => {
    e.preventDefault();
    e.stopPropagation();
    let xPosition = e.offsetX,
        yPosition = e.offsetY,
        windowWidth = window.innerWidth,
        windowHeight = window.innerHeight,
        menuWidth = customMenu.offsetWidth,
        menuHeight = customMenu.offsetHeight;

        // menu position
        xPosition = xPosition > windowWidth - menuWidth ? windowWidth - menuWidth : xPosition;
        yPosition = yPosition > windowHeight - menuHeight ? windowHeight - menuHeight  : yPosition;

        customMenu.style.left =  `${xPosition}px`;
        customMenu.style.top =  `${yPosition}px`;
        customMenu.style.display = 'block';

}

document.onclick = () => {
    customMenu.style.display = 'none';
}

document.onkeyup = (e) => {
    if(e.keyCode == 27) {
        customMenu.style.display = 'none';
    }
}


