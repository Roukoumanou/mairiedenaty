const { default: axios } = require("axios");

function onClikBtnCommentLike(event)
{
    event.preventDefault();

    const url = this.href;
    const spanLikes = this.querySelector('span.js-likes');
    const icon = this.querySelector('i');

    axios.get(url)
        .then(function(response){
            spanLikes.textContent = response.data.likes;
            if (icon.classList.contains('fas')) icon.classList.replace('fas', 'far'); 
            else icon.classList.replace('far', 'fas');
        })
        .catch(function(error){
            window.alert("Un problème est survenu ! Vérifiez si vous êtes connectez");
        });
}

document.querySelectorAll('a.js-like').forEach(function(link){
    link.addEventListener('click', onClikBtnCommentLike);
})