

let toggleColor = document.querySelector('#toggleColor'),
    body = document.querySelector('body'),
    customMenu = document.querySelector(".custom-menu");


let getTheme = JSON.parse(localStorage.getItem('theme'));
if(getTheme === 'dark') {
    body.classList.add('dark');
}

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


// context menu
window.oncontextmenu = (e) => {
    e.preventDefault();
    let xPosition = e.clientX,
        yPosition = e.clientY,
        windowWidth = window.innerWidth,
        windowHeight = window.innerHeight,
        menuWidth = 200,
        menuHeight = customMenu.offsetHeight;

        // menu position
        xPosition = xPosition > windowWidth - menuWidth ? windowWidth - menuWidth - 20 : xPosition;
        yPosition = yPosition > windowHeight - menuHeight ? windowHeight - menuHeight - 20  : yPosition;

        customMenu.style.left =  `${xPosition}px`;
        customMenu.style.top =  `${yPosition}px`;
        customMenu.style.display = 'block';

}

customMenu.onclick = (e) => e.stopPropagation();

document.onclick = () => {
    customMenu.style.display = 'none';
}

document.onkeyup = (e) => {
    if(e.keyCode == 27) {
        customMenu.style.display = 'none';
    }
}


