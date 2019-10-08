//================================================================================================================================================
// WHEN DOC READY START
//================================================================================================================================================
$(document).ready(function () {
  if (auth().customer) {
    get_user_addressess_api_modal(auth().customer);
    user_addresses();
  }
});
//================================================================================================================================================
// WHEN DOC READY END
//================================================================================================================================================

//================================================================================================================================================
// MAKE RANDOM ID START
//================================================================================================================================================
const makeid = length => {
  var result = "";
  var characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
};
//================================================================================================================================================
// MAKE RANDOM ID END
//================================================================================================================================================

//================================================================================================================================================
// DEAL MODAL DETAILS START
//================================================================================================================================================
$("#deal_modal_details_form").click(function (e) {
  e.preventDefault();

  const base_url = location.origin;
  let list = [];

  let deal = $("#deal_detail").val();
  deal = deal ? JSON.parse(deal) : null;

  let item_0 = document.querySelector('input[name="item_0"]:checked')
    ? document.querySelector('input[name="item_0"]:checked').value
    : null;
  item_0 = item_0 ? list.push(JSON.parse(item_0)) : null;

  let item_1 = document.querySelector('input[name="item_1"]:checked')
    ? document.querySelector('input[name="item_1"]:checked').value
    : null;
  item_1 = item_1 ? list.push(JSON.parse(item_1)) : null;

  let item_2 = document.querySelector('input[name="item_2"]:checked')
    ? document.querySelector('input[name="item_2"]:checked').value
    : null;
  item_2 = item_2 ? list.push(JSON.parse(item_2)) : null;

  let item_3 = document.querySelector('input[name="item_3"]:checked')
    ? document.querySelector('input[name="item_3"]:checked').value
    : null;
  item_3 = item_3 ? list.push(JSON.parse(item_3)) : null;

  let item_4 = document.querySelector('input[name="item_4"]:checked')
    ? document.querySelector('input[name="item_4"]:checked').value
    : null;
  item_4 = item_4 ? list.push(JSON.parse(item_4)) : null;

  let item_5 = document.querySelector('input[name="item_5"]:checked')
    ? document.querySelector('input[name="item_5"]:checked').value
    : null;
  item_5 = item_5 ? list.push(JSON.parse(item_5)) : null;

  let deal_qty = $("#deal_qty").val();

  const deal_cart = {
    deal: true,
    id: deal.id,
    name: deal.name,
    image: `${base_url}/${deal.path}`,
    price: deal.price,
    list: list,
    quantity: deal_qty
  };

  localStorage.setItem("order_" + makeid(8), JSON.stringify(deal_cart));

  cart_items();

  $("#dealMenuModal").modal("toggle");
});
//================================================================================================================================================
// DEAL MODAL DETAILS END
//================================================================================================================================================

//================================================================================================================================================
// FOOD MODAL DETAILS START
//================================================================================================================================================
$("#food_modal_details_form").click(function (e) {
  e.preventDefault();

  const my_extras = [];

  let food = $("#food_data").val();
  food = food ? JSON.parse(food) : null;

  let food_size = document.querySelector('input[name="food_size"]:checked')
    ? document.querySelector('input[name="food_size"]:checked').value
    : null;
  food_size = food_size ? JSON.parse(food_size) : null;

  let food_extras_0 =
    $('input[name="food_extras_0"]:checked').length > 0
      ? $('input[name="food_extras_0"]').val()
      : null;
  food_extras_0 = food_extras_0
    ? my_extras.push(JSON.parse(food_extras_0))
    : null;

  let food_extras_1 =
    $('input[name="food_extras_1"]:checked').length > 0
      ? $('input[name="food_extras_1"]').val()
      : null;
  food_extras_1 = food_extras_1
    ? my_extras.push(JSON.parse(food_extras_1))
    : null;

  let food_extras_2 =
    $('input[name="food_extras_2"]:checked').length > 0
      ? $('input[name="food_extras_2"]').val()
      : null;
  food_extras_2 = food_extras_2
    ? my_extras.push(JSON.parse(food_extras_2))
    : null;

  let food_extras_3 =
    $('input[name="food_extras_3"]:checked').length > 0
      ? $('input[name="food_extras_3"]').val()
      : null;
  food_extras_3 = food_extras_3
    ? my_extras.push(JSON.parse(food_extras_3))
    : null;

  let food_extras_4 =
    $('input[name="food_extras_4"]:checked').length > 0
      ? $('input[name="food_extras_4"]').val()
      : null;
  food_extras_4 = food_extras_4
    ? my_extras.push(JSON.parse(food_extras_4))
    : null;

  let food_extras_5 =
    $('input[name="food_extras_5"]:checked').length > 0
      ? $('input[name="food_extras_5"]').val()
      : null;
  food_extras_5 = food_extras_5
    ? my_extras.push(JSON.parse(food_extras_5))
    : null;

  let food_extras_6 =
    $('input[name="food_extras_6"]:checked').length > 0
      ? $('input[name="food_extras_6"]').val()
      : null;
  food_extras_6 = food_extras_6
    ? my_extras.push(JSON.parse(food_extras_6))
    : null;

  let food_extras_7 =
    $('input[name="food_extras_7"]:checked').length > 0
      ? $('input[name="food_extras_7"]').val()
      : null;
  food_extras_7 = food_extras_7
    ? my_extras.push(JSON.parse(food_extras_7))
    : null;

  let food_extras_8 =
    $('input[name="food_extras_8"]:checked').length > 0
      ? $('input[name="food_extras_8"]').val()
      : null;
  food_extras_8 = food_extras_8
    ? my_extras.push(JSON.parse(food_extras_8))
    : null;

  let food_extras_9 =
    $('input[name="food_extras_9"]:checked').length > 0
      ? $('input[name="food_extras_9"]').val()
      : null;
  food_extras_9 = food_extras_9
    ? my_extras.push(JSON.parse(food_extras_9))
    : null;

  let food_extras_10 =
    $('input[name="food_extras_10"]:checked').length > 0
      ? $('input[name="food_extras_10"]').val()
      : null;
  food_extras_10 = food_extras_10
    ? my_extras.push(JSON.parse(food_extras_10))
    : null;

  let food_qty = $("#food_qty").val();
  let actual_price = Number(food.price);

  if (food_size) {
    actual_price = Number(food_size.price);
  }

  if (my_extras.length) {
    for (let exi = 0; exi < my_extras.length; exi++) {
      actual_price = actual_price + Number(my_extras[exi].price);
    }
  }

  food.quantity = food_qty;
  food.price = actual_price;
  food.my_variation = food_size;
  food.my_extras = my_extras;

  localStorage.setItem("order_" + makeid(8), JSON.stringify(food));

  cart_items();

  $("#singleMenuModal").modal("toggle");
});
//================================================================================================================================================
// FOOD MODAL DETAILS END
//================================================================================================================================================

//================================================================================================================================================
// GUEST CHECKOUT DETAILS FORM START
//================================================================================================================================================
$("#guest_checkout_form").submit(function (e) {
  e.preventDefault();

  let user_name = $("#user_name").val();
  let user_number = $("#user_number").val();
  let user_email = $("#user_email").val();

  localStorage.setItem("user_name", user_name);
  localStorage.setItem("user_number", user_number);
  localStorage.setItem("user_email", user_email);

  window.location.replace(location.origin + "/checkout");
});
//================================================================================================================================================
// GUEST CHECKOUT DETAILS FORM END
//================================================================================================================================================

//================================================================================================================================================
// GUEST CHECKOUT DETAILS EDIT MODAL FORM START
//================================================================================================================================================
$("#edit_user_details").submit(function (e) {
  e.preventDefault();

  let user_name = $("#ed_user_name").val();
  let user_number = $("#ed_user_number").val();
  let user_email = $("#ed_user_email").val();
  let user_landline = $("#ed_user_landline").val();

  localStorage.setItem("user_name", user_name);
  localStorage.setItem("user_number", user_number);
  localStorage.setItem("user_email", user_email);
  localStorage.setItem("user_landline", user_landline);

  $("#editUser").modal("toggle");

  $("#ed_user_name").val("");
  $("#ed_user_number").val("");
  $("#ed_user_email").val("");
  $("#ed_user_landline").val("");

  user_details();
});
//================================================================================================================================================
// GUEST CHECKOUT DETAILS EDIT MODAL FORM END
//================================================================================================================================================

//================================================================================================================================================
// ADD NEW ADDRESS FORM MODAL START
//================================================================================================================================================
$("#target").submit(function (e) {

  e.preventDefault();
  $(".loading").removeClass("hidden");

  if (auth().customer) {
    let address = $("#new_address_modal").val();
    let contact = $("#new_address_contact_modal").val();
    let user_id = auth().customer.id;
    let title = $("#new_address_title_modal").val();

    localStorage.setItem(
      "new_address_" + makeid(10),
      title + "~" + address + "~" + contact
    );

    $("#addressModal").modal("toggle");

    $("#new_address_modal").val("");
    $("#new_address_contact_modal").val("");
    $("#new_address_title_modal").val("");

    let url, base_url;

    if (location.host == 'demo.creativedrop.com') base_url = '/'
    else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

    url = `${base_url}pizza_max/public/api/customer/addresses`;

    fetch(url, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        mode: "no-cors"
      },
      body: JSON.stringify({ title, address, contact, user_id })
    })
      .then(res => res.json())

      .then(data => {
        if (data.success) {
          $(".loading").addClass("hidden");
          user_addresses();
          get_user_addressess_api_modal();
        } else {
          $(".loading").addClass("hidden");
          console.log(data);
        }
      })
      .catch(err => {
        console.log(err);
      });
  } else {
    let address = $("#new_address").val();
    let contact = $("#new_address_contact").val();
    let title = $("#new_address_title").val();

    localStorage.setItem(
      "new_address_" + makeid(10),
      title + "~" + address + "~" + contact
    );

    $("#addressModal").modal("toggle");
    $(".loading").addClass("hidden");

    $("#new_address").val("");
    $("#new_address_contact").val("");

    user_addresses();
  }
});
//================================================================================================================================================
// ADD NEW ADDRESS FORM MODAL END
//================================================================================================================================================

//================================================================================================================================================
// LOGIN FORM MODAL FORM START
//================================================================================================================================================
$("#user_login_form").submit(function (e) {
  $(".fa-spinner").removeClass("hidden");

  e.preventDefault();

  let email = $("#login_email").val();
  let pwd = $("#login_password").val();

  $("#login_error_msgs").html("");

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/login`;

  fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    },
    body: JSON.stringify({ email, pwd })
  })
    .then(res => res.json())

    .then(data => {
      $(".fa-spinner").addClass("hidden");
      if (data.success) {
        new Promise((resolve, reject) => {
          var keys = Object.keys(localStorage);
          for (let iot = 0; iot < keys.length; iot++) {
            if (!check_order(localStorage.getItem(keys[iot]))) {
              localStorage.removeItem(keys[iot]);
            }
          }

          sessionStorage["customer"] = JSON.stringify(data.data);

          resolve(data.data);
        })
          .then(async res => {
            await get_user_info_api_modal(res);

            return true;
          })
          .then(res => {
            location.reload();
          });
      } else {
        $("#login_error_msgs").html(data.message);
      }
    });
});
//================================================================================================================================================
// LOGIN FORM MODAL FORM END
//================================================================================================================================================

//================================================================================================================================================
// REGISTER FORM MODAL FORM START
//================================================================================================================================================
$("#user_signup_form").submit(function (e) {
  e.preventDefault();

  let user_name = $("#signup_name").val();
  let phone = $("#signup_number").val();
  let email = $("#signup_email").val();
  let pwd = $("#signup_password").val();
  let pwd_confirm = $("#signup_password_confirm").val();

  $(".fa-spinner").removeClass("hidden");

  register_form("", user_name, phone, email, pwd, pwd_confirm);
});

const register_form = (fb_id, user_name, phone, email, pwd, pwd_confirm) => {
  let signup_error_msgs = $("#signup_error_msgs");

  if (fb_id == "") {
    if (pwd !== pwd_confirm || pwd.length < 8) {
      signup_error_msgs.html("Please confirm your password");
      if (pwd.length < 8) {
        signup_error_msgs.html("Password length must be or greater than 7");
      }
      return;
    } else {
      signup_error_msgs.html("");
    }
  }

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/register`;

  let body = JSON.stringify({ user_name, phone, email, pwd });

  if (fb_id != "") {
    body = JSON.stringify({ fb_id, user_name, email });
  }

  fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    },
    body: body
  })
    .then(res => res.json())

    .then(data => {
      $(".fa-spinner").addClass("hidden");

      if (data.success) {
        $("#loginModal").modal("hide");
        sessionStorage["customer"] = JSON.stringify(data.customer);
        setTimeout(() => {
          //   window.location.href = location.origin + "/profile";
          location.reload();
        }, 500);
      } else {
        signup_error_msgs.html(data.message);
      }
    })
    .catch(err => {
      console.log(err);
      $(".fa-spinner").addClass("hidden");
      signup_error_msgs.html("Network error!");
    });
};
//================================================================================================================================================
// REGISTER FORM MODAL FORM END
//================================================================================================================================================

//================================================================================================================================================
// NUMBER CHANGE MODAL FORM START
//================================================================================================================================================
$("#order_number_change_form").submit(function (e) {
  e.preventDefault();
  $("#number_change_err").html("");

  let user_number = $("#number_change_input").val();
  let order_code = localStorage.getItem("unactive_order");
  if(user_number.indexOf("3")!==0 || user_number.length !== 10){
    $("#number_change_err").html("Please enter valid mobile number");
    setTimeout(() => {
      $("#number_change_err").html("");},1500)
    return;
  }
  $("#number_change_loader").removeClass("hidden");

  let url, base_url;

  if (location.host == 'demo.creativedrop.com' ) base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/https://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/orders/otp/resend`;
  let form = `order_code=${order_code}&number=${user_number}` ;
  $('#modal_number').html(user_number)
  $("#user_number_input").val(user_number)
  fetch(url, {
    method: "POST",
    headers: {
      // Accept: "application/json",
      // "Content-Type": "application/json",
      'Content-Type': 'application/x-www-form-urlencoded',
      mode: "no-cors"
    },
    body: form,
    // body: JSON.stringify({ order_code: order_code, number: user_number })
  })
    .then(res => res.json())

    .then(data => {
      if (data.success) {
        $(".loading").addClass("hidden");
        $("#number_change_success").html(data.message);

        setTimeout(() => {
          $("#number_change_success").html("");
          resetTime();
          document.getElementById("modal_body_2").style.display="block";
          document.getElementById("modal_body_1").style.display="none";

        }, 2000);
      } else {
        $("#number_change_err").html(data.message);
        setTimeout(() => {
          $("#number_change_err").html("");
          resetTime();
          document.getElementById("modal_body_2").style.display="block";
          document.getElementById("modal_body_1").style.display="none";

        }, 2000);
      }
    })
    .catch(err => {
      console.log(err);
      $(".fa-spinner").addClass("hidden");
      $("#number_change_err").html("Network error!");
    });
});
//================================================================================================================================================
// NUMBER CHANGE MODAL FORM END
//================================================================================================================================================


//================================================================================================================================================
// OPT FORM MODAL FORM START
//================================================================================================================================================
$("#order_otp_verification_form").submit(function (e) {
  e.preventDefault();
  $("#order_otp_err").html("");

  let otp_code = $("#order_otp_code").val();
  let order_code = localStorage.getItem("unactive_order");

  $(".fa-spinner").removeClass("hidden");

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/orders/validate`;

  fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    },
    body: JSON.stringify({ order_code: order_code, otp: otp_code })
  })
    .then(res => res.json())

    .then(data => {
      $(".fa-spinner").addClass("hidden");

      if (data.success) {
        localStorage.removeItem("unactive_order");
        $("#otpModal").modal("toggle");
        setTimeout(() => {
          // $("#otpModal_not").modal("toggle");
          location.href = location.origin + '/track-order'
        }, 500);
      } else {
        $("#order_otp_err").html(data.message);
      }
    })
    .catch(err => {
      console.log(err);
      $(".fa-spinner").addClass("hidden");
      $("#order_otp_err").html("Network error!");
    });
});
//================================================================================================================================================
// OPT FORM MODAL FORM END
//================================================================================================================================================

//================================================================================================================================================
// CHECK ORDER JSON START
//================================================================================================================================================
const check_order = str => {
  try {
    let a = JSON.parse(str);
    if (!a.quantity) {
      return false;
    }
  } catch (e) {
    return false;
  }
  return true;
};
//================================================================================================================================================
// CHECK ORDER JSON END
//================================================================================================================================================

//================================================================================================================================================
// RESEND OTP VERIFICATION CODE START
//================================================================================================================================================
$("#resend_opt_order_verification").click(function () {
  let order_code = localStorage.getItem("unactive_order");
  let user_number = $("#user_number_input").val();

  $(".loading").removeClass("hidden");

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/orders/otp/resend`;

  fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    },
    body: JSON.stringify({ order_code: order_code, number: user_number })
  })
    .then(res => res.json())

    .then(data => {
      resetTime();
      if (data.success) {
        $(".loading").addClass("hidden");
        $("#order_otp_success").html(data.message);

        setTimeout(() => {
          $("#order_otp_success").html("");
        }, 3000);
      } else {
        $("#order_otp_err").html(data.message);
        setTimeout(() => {
          $("#order_otp_err").html("");
        }, 3000);
      }
    })
    .catch(err => {
      console.log(err);
      $(".fa-spinner").addClass("hidden");
      $("#order_otp_err").html("Network error!");
    });
});
//================================================================================================================================================
// RESEND OTP VERIFICATION CODE END
//================================================================================================================================================

//================================================================================================================================================
// FACEBOOK LOGIN START
//================================================================================================================================================
const facebook_login = () => {
  FB.login(
    function (res) {
      FB.api("/me", "GET", { fields: "id,name,email" }, function (response) {
        register_form(response.id, response.name, "", response.email, "", "");
      });
    },
    { scope: "public_profile,email" }
  );
};
//================================================================================================================================================
// FACEBOOK LOGIN END
//================================================================================================================================================

//================================================================================================================================================
// SET USER INFO IN LOCAL START
//================================================================================================================================================
const get_user_info_api_modal = data => {
  localStorage.setItem("user_name", data.user_name);
  localStorage.setItem("user_number", data.phone);
  localStorage.setItem("user_email", data.email);
};
//================================================================================================================================================
// SET USER INFO IN LOCAL END
//================================================================================================================================================

//================================================================================================================================================
// SET USER ADDRESSES IN LOCAL START
//================================================================================================================================================
const get_user_addressess_api_modal = data => {
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

  url = `${base_url}pizza_max/public/api/customer/addresses/${data.id}`;

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
        for (let i = 0; i < data.data.length; i++) {
          localStorage.setItem(
            "new_address_" + makeid(10),
            data.data[i].title +
            "~" +
            data.data[i].address +
            "~" +
            data.data[i].contact
          );
        }
      }

      localStorage.setItem("hasCodeRunBefore", true);
      return true
    }).then(res => {
      user_addresses();
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// SET USER ADDRESSES IN LOCAL END
//================================================================================================================================================
