//================================================================================================================================================
// WHEN DOC READY START
//================================================================================================================================================
$(document).ready(function () {
  cart_items();
  user_details();
});
//================================================================================================================================================
// WHEN DOC READY END
//================================================================================================================================================

//================================================================================================================================================
// CONSTANTS START
//================================================================================================================================================
const base_url = location.origin;
//================================================================================================================================================
// CONSTANTS END
//================================================================================================================================================

//================================================================================================================================================
// RENDER CART ITEM START
//================================================================================================================================================
const cart_items = () => {
  var values = [],
    keys = Object.keys(localStorage),
    i = keys.length,
    newKeys = [];
  while (i--) {
    if (IsJsonString(localStorage.getItem(keys[i]))) {
      $("#order_data_submit").css("display", "block")
      newKeys.push(keys[i]);
      values.push(localStorage.getItem(keys[i]));
    }
  }

  var place_order_btn;

  if (location.pathname == "/checkout") {
    if (auth().success) {
      place_order_btn = `<a href="javascript:void(0);" class="btn pmax-btn pmax-btn-lg w-100 mt-3" type="submit" id="order_data_submit">Place Order</a>`;
    } else {
      place_order_btn = `<a href="javascript:void(0);" class="btn pmax-btn pmax-btn-lg w-100 mt-3" data-toggle="modal" data-target="#placeOrderModal">Checkout</a>`;
    }
    place_order_btn = ``;
  } else if (auth().success) {
    place_order_btn = `<a href="${location.origin +
      "/checkout"}" class="btn pmax-btn pmax-btn-lg w-100 mt-3">Checkout</a>`;
  } else {
    place_order_btn = `<a href="javascript:void(0);" class="btn pmax-btn pmax-btn-lg w-100 mt-3" data-toggle="modal" data-target="#placeOrderModal">Checkout</a>`;
  }

  if (auth().success) {
    $("#add_new_address_box").css("display", "none");
  }

  const cart_head = `<h4 class="pmax-h4 mb-3">Checkout</h4><div class="side-cart-scroll">`;
  const cart_body = [];
  const cart_footer = `</div>
            <div class="input-group location-search mt-3">
                <input type="text" class="form-control" placeholder="Enter promo code">
                <div class="input-group-append">
                <button class="btn btn-secondary" type="button">Apply</button>
                </div>
            </div>
            <div class="card gt-card my-3">
                <div class="card-body">
                <div class="row">
                    <div class="col-6">
                    <h6 class="pmax-h6 m-0">Item Total</h6>
                    </div>
                    <div class="col-6 text-right">
                    <h6 class="pmax-h6 m-0">PKR <span class="grand_total">0</span></h6>
                    </div>
                </div>
                </div>
                <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                    <h6 class="pmax-h6 m-0">Grand Total</h6>
                    </div>
                    <div class="col-6 text-right">
                    <h6 class="pmax-h6 m-0">PKR <span class="grand_total">0</span></h6>
                    </div>
                </div>
                </div>
            </div>
            <!--Card End-->
            <h6 class="pmax-h6 mb-3">Order Instructions</h6>
            <div class="form-group side-cart-textarea m-0">
                <textarea class="form-control" rows="3" placeholder="Write here..."></textarea>
            </div>
            ${place_order_btn}`

  if (values.length) {
    for (let i = 0; i < values.length; i++) {
      cart_item = JSON.parse(values[i]);

      if (cart_item.deal) {
        cart_body.push(`
        <div class="card mb-3">
          <div class="row no-gutters">
            <div class="col-3">
              <img class="card-img-top img-fluid" src="${cart_item.image}" alt="Card image cap">
            </div>
            <div class="col-9">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h6 class="pmax-h6 pmax-grey m-0">${cart_item.name}</h6>
                  </div>
                  <div class="col-4">
                    <!--ATC Spinner Start-->
                    <div class="input-group number-spinner ml-2"> 
                      <span class="input-group-btn">
                        <button onclick="onchanged_qty_items('${newKeys[i]}')" class="btn pmax-btn-minus" data-dir="dwn"><i class="fas fa-minus"></i></button>
                      </span>
                      <input readonly type="text" class="form-control text-center ${newKeys[i]}" id="order_qty_${i}" value="${cart_item.quantity}">
                      <span class="input-group-btn">
                        <button onclick="onchanged_qty_items('${newKeys[i]}')" class="btn pmax-btn-plus" data-dir="up"><i class="fas fa-plus"></i></button>
                      </span>
                    </div>
                    <!--ATC Spinner End--> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-8 align-self-end">
                    <input type="hidden" id="order_price_${i}" value="${cart_item.price}">
                    <h6 class="pmax-h6 pmax-grey m-0">PKR ${cart_item.price}</h6>
                  </div>
                  <div class="col-4 align-self-end text-right">
                    <!--ATC Spinner Start-->
                    <button onclick="delete_order('${newKeys[i]}')" class="btn del-btn"><i class="far fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `);
      } else {
        let my_variation = cart_item.my_variation
          ? `<h6 class="m-0 p-0">${cart_item.my_variation.name}</h6>`
          : "";
        let my_extras = [];

        if (cart_item.my_extras.length) {
          for (let mx = 0; mx < cart_item.my_extras.length; mx++) {
            my_extras.push(
              `<h6 class="m-0 p-0">${cart_item.my_extras[mx].name}</h6>`
            );
          }
        }

        cart_body.push(`
        <div class="card mb-3">
          <div class="row no-gutters">
            <div class="col-3">
              <img class="card-img-top img-fluid" src="${
          cart_item.image
          }" alt="Card image cap">
            </div>
            <div class="col-9">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h6 class="pmax-h6 pmax-grey m-0">${cart_item.name}</h6>
                    ${my_variation}
                    ${my_extras.length ? my_extras.join(" ") : ""}
                  </div>
                  <div class="col-4">
                    <!--ATC Spinner Start-->
                    <div class="input-group number-spinner ml-2"> 
                      <span class="input-group-btn">
                        <button onclick="onchanged_qty_items('${
          newKeys[i]
          }')" class="btn pmax-btn-minus" data-dir="dwn"><i class="fas fa-minus"></i></button>
                      </span>
                      <input readonly type="text" class="form-control text-center ${
          newKeys[i]
          }" id="order_qty_${i}" value="${cart_item.quantity}">
                      <span class="input-group-btn">
                        <button onclick="onchanged_qty_items('${
          newKeys[i]
          }')" class="btn pmax-btn-plus" data-dir="up"><i class="fas fa-plus"></i></button>
                      </span>
                    </div>
                    <!--ATC Spinner End--> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-8 align-self-end">
                    <input type="hidden" id="order_price_${i}" value="${
          cart_item.price
          }">
                    <h6 class="pmax-h6 pmax-grey m-0">PKR ${
          cart_item.price
          }</h6>
                  </div>
                  <div class="col-4 align-self-end text-right">
                    <!--ATC Spinner Start-->
                    <button onclick="delete_order('${
          newKeys[i]
          }')" class="btn del-btn"><i class="far fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `);
      }
    }

    $("#checkout_cart_div").html(cart_head + cart_body.join(" ") + cart_footer);
  } else {
    $("#checkout_cart_div").html(`
      <h4 class="pmax-h4 mb-3">My Cart</h4>
  
      <div class="empty-cart my-3">
          <p class="text-center my-3">You have not added anything yet to cart!</p>
          <img src="${base_url}/statics/images/empty-cart.png" class="img-fluid" alt="Empty Cart">
      </div>
    `);
  }

  grand_total();
  $(".orders_count_header_icon").html(values.length);
};
//================================================================================================================================================
// RENDER CART ITEM END
//================================================================================================================================================

//================================================================================================================================================
// CART ITEM QTY TOGGLING START
//================================================================================================================================================
const onchanged_qty_items = id => {
  setTimeout(() => {
    grand_total();

    let updated_qty = $("." + id).val();

    let item = JSON.parse(localStorage.getItem(id));

    item.quantity = updated_qty;

    localStorage.setItem(id, JSON.stringify(item));
  }, 50);
};
//================================================================================================================================================
// CART ITEM QTY TOGGLING END
//================================================================================================================================================

//================================================================================================================================================
// CART ITEM GRAND TOTAL START
//================================================================================================================================================
const grand_total = () => {
  total = [];

  for (let i = 0; i < 10; i++) {
    if ($(`#order_price_${i}`).val()) {
      total.push(
        Number($(`#order_price_${i}`).val()) *
        Number($(`#order_qty_${i}`).val())
      );
    } else {
      break;
    }
  }

  let grand_total = total.reduce((a, b) => a + b, 0);

  $(".grand_total").html(grand_total);
};
//================================================================================================================================================
// CART ITEM GRAND TOTAL END
//================================================================================================================================================

//================================================================================================================================================
// CART ITEM DEL START
//================================================================================================================================================
const delete_order = id => {
  localStorage.removeItem(id);
  cart_items();
};
//================================================================================================================================================
// CART ITEM DEL END
//================================================================================================================================================

//================================================================================================================================================
// CHECK ORDER JSON START
//================================================================================================================================================
const IsJsonString = str => {
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
// RENDER USER INFO START
//================================================================================================================================================
const user_details = () => {
  if (auth().success) $("#edit_user_btn").css("display", "none");

  let user_name = localStorage.getItem("user_name");
  let user_number = localStorage.getItem("user_number");
  let user_email = localStorage.getItem("user_email");

  $(`#user_name`).val(user_name);
  $(`#user_email`).val(user_email);

  if (user_number) {
    $(`#user_number_input`).val(Number(user_number));
  }
};
//================================================================================================================================================
// RENDER USER INFO END
//================================================================================================================================================

//================================================================================================================================================
// RENDER USER ADDRESSES START
//================================================================================================================================================
const user_addresses = () => {

  var values = [],
    keys = Object.keys(localStorage),
    i = keys.length,
    newKeys = [];

  while (i--) {
    if (is_address(localStorage.getItem(keys[i]))) {

      $("#new_addresses").css("display", "none")
      $("#add_new_address_box").css("display", "block")

      newKeys.push(keys[i]);

      let address = localStorage.getItem(keys[i]).split("~");
      values.push(
        `<div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-10 align-self-center">
                <h6 class="pmax-h6 pmax-grey mb-2">${address[0]}</h6>
                <p class="card-para pmax-light-grey m-0">${address[1]}</p>
                <p class="card-para pmax-light-grey m-0">Contact: ${
        address[2]
        }</p>
              </div>
              <div class="col-2 align-self-center text-right">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="delivered_address_${i}" name="delivered_address" value="${address}" checked="checked">
                  <label class="custom-control-label" for="delivered_address_${i}">&nbsp;</label>
                </div>
              </div>
            </div>
          </div>
        </div>`
      );
    }
  }

  setTimeout(() => {
    $("#addresses_render_div").html(values.join(" "));
  }, 500);
};
//================================================================================================================================================
// RENDER USER ADDRESSES END
//================================================================================================================================================

//================================================================================================================================================
// CHECK ADDRESS JSON START
//================================================================================================================================================
const is_address = str => {
  let address = str.split("~");

  if (address.length == 3) return true;
  else return false;
};
//================================================================================================================================================
// CHECK ADDRESS JSON END
//================================================================================================================================================

//================================================================================================================================================
// ORDER SUBMIT PROCCESS START
//================================================================================================================================================
$("#order_data_submit").click(function () {

  $(".loading").removeClass("hidden");

  var user_name, user_email, user_number, total, delivered_address, code;

  try {
    user_name = $("#user_name").val();
    user_email = $("#user_email").val();
    user_number = $("#user_number_input").val();
    total = $(".grand_total").html();

    if (auth().success) {
      if (document.querySelector('input[name="delivered_address"]:checked')) {
        delivered_address = document.querySelector('input[name="delivered_address"]:checked').value;
      } else {
        delivered_address = $("#new_address").val()
        add_new_add($("#new_address_title").val(), $("#new_address").val(), $("#new_address_contact").val(), auth().customer.id)
      }
    } else {
      delivered_address = $("#new_address").val()
    }
    code = "PM" + makeid(10);

  } catch (err) {
    $(".loading").addClass("hidden");
    alert("Please check your order details OR your cart is empty");
    return;
  }

  var keys = Object.keys(localStorage),
    i = keys.length,
    values = [];

  while (i--) {
    if (IsJsonString(localStorage.getItem(keys[i]))) {
      values.push(JSON.parse(localStorage.getItem(keys[i])));
    }
  }

  values = JSON.stringify(values);

  let url, base_url;

  if (location.host == 'demo.creativedrop.com') base_url = '/'
  else base_url = 'https://cors-anywhere.herokuapp.com/http://demo.creativedrop.com/'

  url = `${base_url}pizza_max/public/api/customer/orders`;

  fetch(url, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      mode: "no-cors"
    },
    body: JSON.stringify({
      full_name: user_name,
      email: user_email,
      address: delivered_address,
      mobile: user_number,
      content: values,
      code: code,
      total: total,
      user_id: auth().success ? auth().customer.id : null
    })
  })
    .then(res => res.json())
    .then(data => {
      console.log(data);
      $(".loading").addClass("hidden");

      if (data.success) {
        var keys = Object.keys(localStorage),
          i = keys.length;

        while (i--) {
          if (IsJsonString(localStorage.getItem(keys[i]))) {
            localStorage.removeItem(keys[i]);
          }
        }

        if (data.otp_check) {
          localStorage.setItem("unactive_order", code);
          localStorage.setItem("track_order", code);

          $("#otpModal").modal({ backdrop: "static", keyboard: false });
        } else {
          // $("#otpModal_not").modal("toggle");
          localStorage.setItem("track_order", code);
          setTimeout(() => {
            location.href = location.origin + '/track-order'
          }, 500);
        }
      } else {
        $(".loading").addClass("hidden");
        alert("Please check your order details OR your cart is empty");
      }
    })
    .catch(err => {
      $(".loading").addClass("hidden");
      alert(err);
    });
});
//================================================================================================================================================
// ORDER SUBMIT PROCCESS END
//================================================================================================================================================

//================================================================================================================================================
// ADD NEW ADDRESS START
//================================================================================================================================================
const add_new_add = (title, address, contact, user_id) => {

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
      console.log(data)
    })
    .catch(err => {
      console.log(err);
    });
};
//================================================================================================================================================
// ADD NEW ADDRESS END
//================================================================================================================================================

if (location.pathname != "/checkout") {
  (".pmax-btn-lg ").css("display", "none")
}

//================================================================================================================================================
// GET CURRENT LOCATION START
//================================================================================================================================================
const current_location = async () => {

  const result = [];

  await new Promise((res, rej) => {
    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        function success(position) {
          res(position.coords);
        },
        function error(error_message) {
          rej(error_message);
        }
      )
    } else {
      rej('geolocation is not enabled on this browser')
    }

  }).then(async res => {
    await fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${res.latitude},${res.longitude}&key=AIzaSyD5l0xa-Mwl5_PEPL86c5t3G-0VT_NdT1c`)
      .then(res => res.json())

      .then(data => {
        result.push(data)
      })
      .catch(err => {
        result.push(err)
        console.log(err);
      });
  }).catch(err => {
    result.push(err)
    console.log(err);
  })

  return result;
}
//================================================================================================================================================
// GET CURRENT LOCATION END
//================================================================================================================================================

$("#current_loc").click(function () {
  current_location().then(res => {
    let address = res[0].results[0].formatted_address;

    $("#new_address").val(address)
  })
})