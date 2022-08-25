
var url = `${window.location}`;

document.addEventListener("DOMContentLoaded", () =>
{
    url = localStorage.getItem('urlMovieApp');
});

function goToLogin(){
    window.location.href = url;
}