//================================================================================================================================================
// WHEN DOC READY START
//================================================================================================================================================
$(document).ready(function () {
    get_outlets('all');
});
//================================================================================================================================================
// WHEN DOC READY END
//================================================================================================================================================

//================================================================================================================================================
// GET OUTLETS START
//================================================================================================================================================
const get_outlets = (city) => {

    let url, base_url;

    if (location.host == 'demo.creativedrop.com') base_url = '/'
    else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

    if (city == 'all') url = `${base_url}pizza_max/public/api/outlets`;
    else url = `${base_url}pizza_max/public/api/outlets?city=${city}`;

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

            var outlets = [];
            var locations = []

            if (data.success) {
                for (let i = 0; i < data.data.length; i++) {
                    outlets.push(`
                    <div class="card outlet-card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h6 class="pmax-h6 pmax-grey mb-2">${data.data[i].title}</h6>
                                    <p class="card-para pmax-light-grey m-0">${data.data[i].address}</p>
                                    <p class="card-para pmax-light-grey m-0">Contact: ${data.data[i].contact}</p>
                                </div>
                                <div class="col-sm-4 text-right align-self-end">
                                    <a href="${"https://www.google.ae/maps/place/" + data.data[i].lat + ',' + data.data[i].lon}" target="_blank" class="btn pmax-btn green-btn">Get Diretions</a>
                                </div>
                            </div>
                        </div>
                    </div>`)
                    locations.push({ lat: Number(data.data[i].lat), lng: Number(data.data[i].lon) })
                }

                setTimeout(() => {
                    $('#outlets_div').html(outlets.join(" "))
                    localStorage.setItem("outlets", JSON.stringify(locations));
                    initMap()
                }, 200);

            } else {
                $('#outlets_div').html(`<p style="text-align: center;">${data.message}</p>`)
            }

        })
        .catch(err => {
            console.log(err);
        });
};
//================================================================================================================================================
// GET OUTLETS END
//================================================================================================================================================

//================================================================================================================================================
// INITIALIZES THE MAP START
//================================================================================================================================================
function initMap(locations = JSON.parse(localStorage.getItem("outlets"))) {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: { lat: 30.3753, lng: 69.3451 }
    });

    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    var markers = locations.map(function (location, i) {
        return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length]
        });
    });

    // Add a marker clusterer to manage the markers.
    var markerCluster = new MarkerClusterer(map, markers,
        { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });
}
//================================================================================================================================================
// INITIALIZES THE MAP END
//================================================================================================================================================
