$(document).ready(function () {
    let url, base_url;

    if (location.host == 'demo.creativedrop.com') base_url = '/'
    else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

    url = `${base_url}pizza_max/public/api/banners/web`;

    fetch(url, {
        method: "GET",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            mode: "no-cors"
        }
    })
        .then(res => res.json())

        .then(data => {
            const head_tail = [
                `<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">`,
                `<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>`
            ]
            const indicator = [], slider = []

            if (data.success) {
                for (let i = 0; i < data.data.length; i++) {
                    indicator.push(`<li data-target="#carouselExampleIndicators" data-slide-to="${i}" class="${(i == 0 ? 'active' : '')}"></li>`)
                    slider.push(`<div class="carousel-item ${(i == 0 ? ' active' : '')}"><img class="d-block w-100" src="${data.data[i].path}"></div>`)
                }
            } else {
                console.log(data.message);
            }

            setTimeout(() => {
                $("#banners_slider").html(head_tail[0] + `<ol class="carousel-indicators">${indicator.join(" ")}</ol>` + `<div class="carousel-inner">${slider.join(" ")}</div>` + head_tail[1])
            }, 500);
        })
        .catch(err => {
            console.log(err);
        });
});
