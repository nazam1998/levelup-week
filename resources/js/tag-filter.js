let tags = document.querySelectorAll('.tags');

console.log(tags);

tags.forEach(tag => {

    tag.addEventListener('click', (e) => {
            e.target.classList.toggle('active-tag');
            e.target.classList.toggle('inactive-tag');
    });
});

//
