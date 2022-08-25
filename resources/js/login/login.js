var url = `${window.location}`;

document.addEventListener("DOMContentLoaded", () =>
{
    localStorage.setItem('urlMovieApp', window.location);
});

function goToRegister(){
    window.location.href = url + 'Login/register';
}