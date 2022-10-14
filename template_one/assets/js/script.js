let filterItem = document.querySelectorAll('.filter-item'),
    portfolioBox = document.querySelectorAll('.portfolio-boxs .box'),
    header =  document.querySelector("header"),
    heroSection = document.querySelector('.hero-sec'),
    menu = document.querySelector('header .menu'),
    scrollTop = document.querySelector('#scrollTop'),
    contactForm = document.querySelector('#contactForm'),
    name = document.getElementById('name'),
    email = document.getElementById('email'),
    message = document.getElementById('message'),
    githubForm = document.getElementById('githubForm'),
    githubUser = document.getElementById('githubUser')
    loader = document.getElementById('loader'),
    loaderNum = document.getElementById('loaderNum'),
    body = document.querySelector('body');

// portfolio event
filterItem.forEach(item => {
    item.addEventListener('click', function () {
        filterItem.forEach(item => {
            item.parentNode.classList.remove('active');
            this.parentNode.classList.add('active');
        });

        let dataFilter = this.getAttribute('data-filter');
        
        portfolioBox.forEach(box => {
            box.classList.remove('active');
            box.classList.add('hide');

            if(box.getAttribute('data-filter') == dataFilter || dataFilter == 'all') {
                box.classList.remove('hide');
                box.classList.add('active')
            }
        })
    });
});


if(heroSection != null) {
// fixed header and change bg color
window.addEventListener("scroll", () => {
    const scrollY = window.pageYOffset;
    const heroSecOffset = heroSection.offsetHeight

    if(scrollY > heroSecOffset - 1){
        header.classList.add("header-active");
    }else{
        header.classList.remove("header-active");
    }
});

}


// scroll to top event
if(scrollTop != null ) {
    scrollTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// go to section

if(menu != null ) {
    menu.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: "smooth",
                block: "start"
            })
        })
    });
}


function checkInputs() {
    const nameValue = name.value,
        emailValue = email.value,
        messageValue = message.value;
    
    if(nameValue === "") {
        name.classList.add('has-error')
        name.nextElementSibling.style.display = 'block'
    } else {
        name.classList.remove('has-error')
        name.nextElementSibling.style.display = 'none'
    }
    if(emailValue === "") {
        email.classList.add('has-error')
        email.nextElementSibling.style.display = 'block'
    } else {
        email.classList.remove('has-error')
        email.nextElementSibling.style.display = 'none'
    }
    if(messageValue === "") {
        message.classList.add('has-error')
        message.nextElementSibling.style.display = 'block'
    } else {
        message.classList.remove('has-error')
        message.nextElementSibling.style.display = 'none'
    }
}

if(contactForm != null ) {
    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        checkInputs();
    });
}

if(githubForm != null ) {
    githubForm.addEventListener('submit', async e => {
        e.preventDefault();
        let username = document.getElementById('searchUser').value;
        let template = "";
        let result = [];
        let repos = [];
        await axios.get(`https://api.github.com/users/${username}`).then(res => {
            result.push(res.data);
        }).catch((error) => {
            githubUser.innerHTML = `
            <div class="error-text">
                No data Found
            </div>
            `
        });;
        await axios.get(`https://api.github.com/users/${username}/repos`).then(res => {
            repos.push(res.data);
        });

        result.forEach(data => {
            repos.forEach (repo => {
                template = `
                <div>
                    <div class="user-card">
                        <div class="avatar">
                            <img src="${data.avatar_url}" alt="" class="img-fluid">
                        </div>
                        <div class="info">
                            <h3>${data.name}</h3>
                            <div class="info-list">
                                <div>
                                    <label>
                                        Repo :
                                    </label>
                                    <p>
                                    ${data.public_repos}
                                    </p>
                                </div>
                                <div>
                                    <label>
                                        Followers :
                                    </label>
                                    <p>
                                    ${data.followers}
                                    </p>
                                </div>

                                <div>
                                    <label>
                                        Following :
                                    </label>
                                    <p>
                                    ${data.following}
                                    </p>
                                </div>
                            </div>
                            <a href="${data.html_url}" class="btn main-btn" target=_blank>
                                Visit Profile
                            </a>
                        </div>
                    </div>

                    <div class="last-repo">
                        <h5>
                            Last repositories
                        </h5>
                        <div class="repo-list">
                            ${repo.map(item =>`
                                <div class="repo-box">
                                    <div>
                                        <h4>${item.name}</h4>
                                        <p>
                                        ${item.description ? item.description : 'No Description'}
                                        </p>
                                    </div>
                                    <a href="${item.html_url}" class="btn main-btn" target=_blank>
                                        Repo Page
                                    </a>
                                </div>
                                
                                `).join('')}
                        </div>
                    </div>
                </div>
            `;
            });
        });
        githubUser.innerHTML = template

    });
}


window.addEventListener('DOMContentLoaded', e => {
    let time = (e.timeStamp).toFixed(0) / 60;
    console.log(time);
    let count = setInterval(function () {
        let number = parseInt(loaderNum.textContent);
        loaderNum.innerHTML = (++number).toString() + '%';
        if(number == 100) {
            clearInterval(count)
            loader.style.display = "none"
            body.style.overflow = "auto"
        }
    }, time);
});