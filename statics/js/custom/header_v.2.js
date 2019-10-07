//================================================================================================================================================
// HEADER TAB START
//================================================================================================================================================
try {
  var customer = JSON.parse(sessionStorage["customer"]);

  if (customer) {
    document.getElementById("header_login_link").style.display = "none";
    document.getElementById("sidenav_login_link").style.display = "none";
  } else {
    document.getElementById("header_account_link").style.display = "none";
    document.getElementById("small_account_link").style.display = "none";

    document.getElementById("header_logout_link").style.display = "none";
    document.getElementById("sidenav_logout_link").style.display = "none";
  }
} catch (error) {
  document.getElementById("header_account_link").style.display = "none";
  document.getElementById("small_account_link").style.display = "none";

  document.getElementById("header_logout_link").style.display = "none";
  document.getElementById("sidenav_logout_link").style.display = "none";
}
//================================================================================================================================================
// HEADER TAB END
//================================================================================================================================================

//================================================================================================================================================
// AUTH LOGOUT START
//================================================================================================================================================
const logout = () => {
  sessionStorage.removeItem("customer");
  window.localStorage.clear();
  location.reload();
};
//================================================================================================================================================
// AUTH LOGOUT END
//================================================================================================================================================

//================================================================================================================================================
// GET AUTH USER START
//================================================================================================================================================
const auth = () => {
  try {
    var customer = JSON.parse(sessionStorage["customer"]);
    if (customer) {
      return { success: true, customer };
    } else {
      return { success: false };
    }
  } catch (error) {
    return { success: false };
  }
};
//================================================================================================================================================
// GET AUTH USER END
//================================================================================================================================================


//================================================================================================================================================
// TRACK MY ORDER START
//================================================================================================================================================
const track_my_order = code => {
  if (code != "") {
    let url = `/pizza_max/public/api/customer/order/track/${code}`;

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
        if (data.success) {
          localStorage.setItem("track_order", code);
          setTimeout(function() {
            location.href = `${location.origin}/track-order`;
          }, 500);
        } else {
          alert(data.message);
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
};
//================================================================================================================================================
// TRACK MY ORDER END
//================================================================================================================================================
