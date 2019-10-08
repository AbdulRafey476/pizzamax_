//================================================================================================================================================
// WHEN DOC READY START
//================================================================================================================================================
let orders_array;
$(document).ready(function() {
  get_user_info_api();
  get_user_addressess_api();
  user_active_orders();
  user_history_orders();
});
//================================================================================================================================================
// WHEN DOC READY END
//================================================================================================================================================

//================================================================================================================================================
// SET USER INFO LOCAL START
//================================================================================================================================================
const get_user_info_api = () => {
  try {
    var customer = JSON.parse(sessionStorage["customer"]);
    console.log("cus",customer)
  } catch (error) {
    console.log(error);
    return;
  }

  $("#profile_name").val(customer.user_name);
  $("#profile_email").val(customer.email);
  $("#profile_number").val(customer.phone);
  $("#profile_landline").val(customer.phone);

  if (customer.fb_id !== "" ) {
    $("#profile_update_password").css("display", "none");
  }

  localStorage.setItem("user_name", customer.user_name);
  localStorage.setItem("user_number", customer.phone);
  localStorage.setItem("user_email", customer.email);
};
//================================================================================================================================================
// SET USER INFO LOCAL END
//================================================================================================================================================

//================================================================================================================================================
// SET & RENDER USER ADDRESSES LOCAL START
//================================================================================================================================================
const get_user_addressess_api = () => {
  var keys = Object.keys(localStorage),
    i = keys.length;

  while (i--) {
    if (is_address(localStorage.getItem(keys[i]))) {
      localStorage.removeItem(keys[i]);
    }
  }

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/addresses/${customer.id}`;

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
      const addressess = [];

      if (data.success) {
        for (let i = 0; i < data.data.length; i++) {
          localStorage.setItem(
            "new_address_" + makeid(10),
            data.data[i].title +
              "~" +
              data.data[i].address +
              "~" +
              data.data[i].contact
          );
          addressess.push(`
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 align-self-center">
                            <h6 class="pmax-h6 pmax-grey mb-2">${data.data[i].title}</h6>
                            <p class="card-para pmax-light-grey m-0">${data.data[i].address}</p>
                            <p class="card-para pmax-light-grey m-0">Contact: ${data.data[i].contact}</p>
                        </div>
                        <div class="col-4 align-self-center text-right">
                            <a href="javascript:void(0);" class="pmax-para pmax-red profile-edit-btn m-0" data-toggle="modal" data-target="#addressModal">edit <i class="far fa-edit"></i></a><br>
                            <a href="javascript:void(0);" onclick="user_address_delete('${data.data[i].id}')" class="pmax-para pmax-red profile-edit-btn m-0">delete <i class="far fa-trash-alt"></i></a>
                        </div>
                    </div>
                </div>
            </div>
          `);
        }
      } else {
        $("#user_profile_addresses").html("You have no set addresses");
      }

      $("#user_profile_addresses").html(addressess.join(" "));
      localStorage.setItem("hasCodeRunBefore", true);
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// SET & RENDER USER ADDRESSES LOCAL END
//================================================================================================================================================

//================================================================================================================================================
// DEL USER ADDRESS START
//================================================================================================================================================
const user_address_delete = id => {

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/delete_address`;

  if (!confirm("Are you sure")) return false;

  fetch(url, {
    method: "POST",
    body: JSON.stringify({ id }),
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    }
  })
    .then(res => res.json())

    .then(data => {
      get_user_addressess_api();
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// DEL USER ADDRESS END
//================================================================================================================================================

//================================================================================================================================================
// USER ACTIVE ORDERS START
//================================================================================================================================================
const user_active_orders = () => {
  let user_id = auth().customer.id;

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/active/orders/${user_id}`;

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
      const active_orders = [];

      if (data.success) {
        for (let i = 0; i < data.data.length; i++) {
          let order_details = JSON.parse(data.data[i].content);

          const order_data = [];

          for (let ord_d = 0; ord_d < order_details.length; ord_d++) {
            order_data.push(
              `<li>${order_details[ord_d].quantity} x ${order_details[ord_d].name} - ${order_details[ord_d].price}</li>`
            );
          }

          active_orders.push(`
            <li>
              <div class="row">
                <div class="col-sm-12">
                  <h6 class="pmax-h6 pmax-grey mb-1">Order ID: ${
                    data.data[i].id
                  }</h6>
                  <ul>${order_data.join(" ")}</ul>
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-left align-self-center">
                  <h6 class="pmax-h6 pmax-grey mb-1">Total</h6>
                  <p class="mb-0 pmax-normal">PKR ${data.data[i].total}</p>
                </div>
                <div class="col-4 text-left align-self-center">
                  <h6 class="pmax-h6 pmax-grey mb-1">Date</h6>
                  <p class="mb-0 pmax-normal"><?php echo date("d-m-Y") ?></p>
                </div>
                <div class="col-4 text-right align-self-center">
                  <button onclick="track_order_code('${
                    data.data[i].code
                  }')" class="btn pmax-btn green-btn">Track Order</button>
                </div>
              </div>
            </li>
          `);
        }
      } else {
        $("#user_no_active_orders").html("You have no active orders!");
      }

      $("#user_active_orders").html(active_orders.join(" "));
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// USER ACTIVE ORDERS END
//================================================================================================================================================

//================================================================================================================================================
// USER HISTORY ORDERS START
//================================================================================================================================================
const user_history_orders = () => {
  let user_id = auth().customer.id;

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/history/orders/${user_id}`;

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
      const history_orders = [];

      if (data.success) {
        orders_array = data.data;
        for (let i = 0; i < data.data.length; i++) {
          let order_details = JSON.parse(data.data[i].content);

          const order_data = [];

          for (let ord_d = 0; ord_d < order_details.length; ord_d++) {
            order_data.push(
              `<li>${order_details[ord_d].quantity} x ${order_details[ord_d].name} - ${order_details[ord_d].price}</li>`
            );
          }

          history_orders.push(`
            <li>
              <div class="row">
                <div class="col-sm-12">
                  <h6 class="pmax-h6 pmax-grey mb-1">Order ID: ${
                    data.data[i].id
                  }</h6>
                  <ul>${order_data.join(" ")}</ul>
                </div>
              </div>
              <div class="row">
                <div class="col-4 text-left align-self-center">
                  <h6 class="pmax-h6 pmax-grey mb-1">Total</h6>
                  <p class="mb-0 pmax-normal">PKR ${data.data[i].total}</p>
                </div>
                <div class="col-4 text-left align-self-center">
                  <h6 class="pmax-h6 pmax-grey mb-1">Date</h6>
                  <p class="mb-0 pmax-normal"><?php echo date("d-m-Y") ?></p>
                </div>
                <div class="col-4 text-right align-self-center">
                  <button onclick="user_reorder('${
                    data.data[i].id
                  }')" class="btn pmax-btn">Reorder</button>
                </div>
              </div>
            </li>
          `);
        }
      } else {
        $("#user_no_history_orders").html("You have not ordered anything yet!");
      }

      $("#user_history_orders").html(history_orders.join(" "));
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// USER HISTORY ORDERS END
//================================================================================================================================================

//================================================================================================================================================
// USER TRACK ORDERS START
//================================================================================================================================================
const track_order_code = code => {
  localStorage.setItem("track_order", code);

  setTimeout(function() {
    location.href = `${location.origin}/track-order`;
  }, 500);
};
//================================================================================================================================================
// USER TRACK ORDERS END
//================================================================================================================================================

//================================================================================================================================================
// USER REORDERS START
//================================================================================================================================================
const user_reorder = code => {
  let menu = [];
  orders_array.forEach((o)=>{
    if(parseInt(o.id)=== parseInt(code)){
      menu = JSON.parse(o.content);
    }
  });
  localStorage.clear();
  menu.forEach((m)=>{
    localStorage.setItem(m.id, JSON.stringify(m));

  });
  alert("Items added into cart");
  console.log(orders_array);
};
//================================================================================================================================================
// USER REORDERS END
//================================================================================================================================================

//================================================================================================================================================
// USER UPDATE INFO START
//================================================================================================================================================
const update_basic_info = () => {
  let id = auth().customer.id;
  let user_name = $("#profile_name").val();
  let phone = $("#profile_number").val();

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/basic_info`;

  fetch(url, {
    method: "POST",
    body: JSON.stringify({ id, user_name, phone }),
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    }
  })
    .then(res => res.json())

    .then(data => {
      $(".profile_form_spin").addClass("hidden");

      if (data.success) {
        sessionStorage["customer"] = JSON.stringify(data.data[0]);
        $("#update_basicinfo_success").html("Profile updated successfully!");
        setTimeout(function() {
          $("#update_basicinfo_success").html("");
        }, 3000);
      } else {
        console.log(data.message);
      }
    })
    .catch(err => {
      $(".profile_form_spin").addClass("hidden");
      console.log(err);
    });
};
//================================================================================================================================================
// USER UPDATE INFO END
//================================================================================================================================================

//================================================================================================================================================
// USER UPDATE FORM START
//================================================================================================================================================
$("#profile_form").submit(function(e) {
  $(".profile_form_spin").removeClass("hidden");
  e.preventDefault();
  update_basic_info();
});
//================================================================================================================================================
// USER UPDATE FORM END
//================================================================================================================================================

//================================================================================================================================================
// USER UPDATE PASSWORD FORM START
//================================================================================================================================================
$("#profile_update_password").submit(function(e) {
  $(".profile_update_password_spin").removeClass("hidden");
  e.preventDefault();

  let user_id = auth().customer.id;
  let pwd = $("#update_profile_pwd").val();
  let pwd_confirm = $("#update_profile_pwd_confirm").val();
  let old_password = $("#update_profile_old_pwd").val();

  if (pwd !== pwd_confirm) {
    $("#update_password_fail").html("Password don't match");
    $(".profile_update_password_spin").addClass("hidden");
    return;
  }

  $("#update_password_fail").html("");

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/update/password`;

  fetch(url, {
    method: "POST",
    body: JSON.stringify({ user_id, old_password, password: pwd }),
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    }
  })
    .then(res => res.json())

    .then(data => {
      $(".profile_update_password_spin").addClass("hidden");
      if (data.success) {
        logout();
      } else {
        $("#update_password_fail").html(data.message);
      }
    })
    .catch(err => {
      $(".profile_form_spin").addClass("hidden");
      console.log(err);
    });
});
//================================================================================================================================================
// USER UPDATE PASSWORD FORM END
//================================================================================================================================================
