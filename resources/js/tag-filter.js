
global.$=global.jQuery=require('jquery');
let tags = document.querySelectorAll('.tags');


tags.forEach((tag, index) => {

    tag.addEventListener('click', (e) => {
        if (index == 0) {
            tags.forEach(elem => {
                if (elem.classList.contains('active-tag')) {
                    elem.nextElementSibling.disabled = true;
                    elem.classList.toggle('active-tag');
                    elem.classList.toggle('inactive-tag');
                }
            });
        } else if (tags[0].classList.contains('active-tag')) {
            tags[0].classList.toggle('active-tag');
            tags[0].classList.toggle('inactive-tag');
            
        }
        e.target.classList.toggle('active-tag');
        e.target.classList.toggle('inactive-tag');
        e.target.nextElementSibling.disabled = e.target.classList.contains('inactive-tag');
        console.log(e.target.classList.contains('inactive-tag'));
        console.log(e.target.nextElementSibling.disabled);
        let i = 1;
        inactive = true;
        while (i < tags.length && inactive) {
            inactive = tags[i].classList.contains('inactive-tag');
            i++;
        }
        if (inactive && tags[0].classList.contains('inactive-tag')) {
            tags[0].classList.toggle('active-tag');
            tags[0].classList.toggle('inactive-tag');
        }
        i = 0;
    });
});

//
