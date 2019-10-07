//================================================================================================================================================
// GET FOOD ITEMS START
//================================================================================================================================================
const get_foods_items = id => {
  const base_url = location.origin;

  fetch(`${base_url}/get_foods`)
    .then(response => response.json())
    .then(contents => {
      const data = [];

      for (let i = 0; i < contents.length; i++) {
        if (contents[i].id == id) {
          data.push(contents[i]);
        }
      }

      return data;
    })
    .then(res => {
      let data = res[0];
      let size, extras;

      if (data.size) {
        let size_head = `<h6 class="pmax-h6 pmax-extra-bold">Sizes</h6><div class="card"><div class="card-body p-3">`;
        let size_body = [];
        let size_footer = `</div></div>`;

        for (let i = 0; i < data.size.length; i++) {
          let food_size = JSON.stringify(data.size[i]);

          size_body.push(`
              <div class="custom-control custom-checkbox">
                <input type="radio" class="custom-control-input" name="food_size" id="${data.size[i].id}" value='${food_size}'>
                <label class="custom-control-label w-100" for="${data.size[i].id}">
                <div class="row">
                  <div class="col-8"> <span class="modal-price">${data.size[i].name}</span> </div>
                  <div class="col-4 text-right ml-0"> <span class="modal-price pmax-bold">+ PKR ${data.size[i].price}</span> </div>
                </div>
                </label>
              </div>
            `);
        }

        size = size_head + size_body.join("") + size_footer;
      }

      if (data.extras) {
        let extras_head = `<h6 class="pmax-h6 pmax-extra-bold">Extra Toppings</h6><div class="card"><div class="card-body p-3">`;
        let extras_body = [];
        let extras_footer = `</div></div>`;

        for (let i = 0; i < data.extras.length; i++) {
          let food_extras = JSON.stringify(data.extras[i]);

          extras_body.push(`
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="food_extras_${i}" id="food_extras_${i}" value='${food_extras}'>
                <label class="custom-control-label w-100" for="food_extras_${i}">
                <div class="row">
                  <div class="col-8"> <span class="modal-price">${data.extras[i].name}</span> </div>
                  <div class="col-4 text-right ml-0"> <span class="modal-price pmax-bold">+ PKR ${data.extras[i].price}</span> </div>
                </div>
                </label>
              </div>
            `);
        }

        extras = extras_head + extras_body.join("") + extras_footer;
      }

      let food_json = JSON.stringify(data);

      $("#food_details").html(
        `<div class="modal-food-item"> <img src="${base_url +
          "/" +
          data.path}" class="img-fluid" alt="pizza-img"></div>
          <h5 class="pmax-h5 pmax-extra-bold text-center">${data.name}</h5>
          <p class="pmax-light-grey text-center">${data.description}</p>

          <input type="hidden" id="food_data" name="food_data" value='${food_json}'>

          ${size ? size : ""}

          ${extras ? extras : ""}`
      );
    })
    .catch(err => console.log(err));
};
//================================================================================================================================================
// GET FOOD ITEMS END
//================================================================================================================================================
