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
            const indicator = [], slider = []

            if (data.success) {
                for (let i = 0; i < data.data.length; i++) {
                    indicator.push(`<li data-target="#carouselExampleIndicators" data-slide-to="${i}" class="${(i = 0) ? 'active' : ''}"></li>`)
                    slider.push(`<div class="carousel-item" class="${(i = 0) ? 'active' : ''}"><img class="d-block w-100" src="${data.data[i].path}"></div>`)
                }
                console.log(data);

            } else {
                console.log(data.message);
            }

            // $(".carousel-indicators").html(indicator.join(" "))
            // $(".carousel-inner").html(slider.join(" "))
        })
        .catch(err => {
            console.log(err);
        });
});
