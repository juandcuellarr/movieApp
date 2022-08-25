
document.addEventListener("DOMContentLoaded", () => {
    baseList();
});


function baseList() {

    axios.get('baseList', {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
        .then(function (response) {
            // console.log(response);
            let movies = response.data;
            var table = document.getElementsByTagName('tbody')[0];
            table.innerHTML = '';
            table.innerHTML = movies;

            // var table = document.getElementById('table_movies');

            // movies.forEach((movie, i) => {
            //     let newRow = table.insertRow(i + 1);
            //     let newCell = newRow.insertCell(0);
            //     newCell.innerHTML = movie.Title;

            //     newCell = newRow.insertCell(1);
            //     newCell.innerHTML = movie.Year;

            //     newCell = newRow.insertCell(2);
            //     newCell.innerHTML = movie.Type;

            //     newCell = newRow.insertCell(3);
            //     newCell.innerHTML = `<img src="${movie.Poster}" alt="">`;

            // });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
}

function search() {
    let form = document.querySelector('#formSearch');
    let data = new FormData(form);

    axios.post('search', data, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
        .then(function (response) {
            // console.log(response);
            let movies = response.data;
            var table = document.getElementsByTagName('tbody')[0];
            table.innerHTML = '';
            table.innerHTML = movies;
        })
        .catch(function (error) {
            // console.log(error.response.data);
            let { data, status } = error.response;
            if (status == 422) {
                alert(data);
            } else if (status = 403) {
                location.reload();
            }
        });
}