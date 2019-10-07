//================================================================================================================================================
// WHEN DOC READY START
//================================================================================================================================================
$(document).ready(function() {
  track_order();
});
//================================================================================================================================================
// WHEN DOC READY END
//================================================================================================================================================

//================================================================================================================================================
// TRACK ORDER API START
//================================================================================================================================================
const track_order = () => {
  let order_code = localStorage.getItem("track_order");

  if (order_code) {
    $("#display_order_code").html(`ORDER CODE# ${order_code}`);

    let url, base_url;

    if (location.host == 'demo.creativedrop.com') base_url = '/'
    else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'
  
    url = `${base_url}pizza_max/public/api/customer/order/track/${order_code}`;
  
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
        switch (data.data[0].status) {
          case 0:
            $("#order_pending").addClass("active");
            break;
          case 1:
            $("#order_pending").addClass("active");
            $("#order_accepted").addClass("active");
            break;
          case 2:
            $("#order_pending").addClass("active");
            $("#order_accepted").addClass("active");
            $("#order_dispatched").addClass("active");
            break;
          case 3:
            $("#order_pending").addClass("active");
            $("#order_accepted").addClass("active");
            $("#order_dispatched").addClass("active");
            $("#order_delivered").addClass("active");
            break;
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
};
//================================================================================================================================================
// TRACK ORDER API END
//================================================================================================================================================
