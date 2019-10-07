//================================================================================================================================================
// GET DEAL DETAILS START
//================================================================================================================================================
const get_deal_details = id => {
  const base_url = location.origin;
  $("#featured_deal_details").html("");

  fetch(`${base_url}/get_deals`)
    .then(response => response.json())

    .then(contents => {
      const data = [];

      for (let i = 0; i < contents.length; i++) {
        if (contents[i].id == id) {
          data.push(contents[i]);
        }
      }

      return data[0];
    })
    .then(deal => {
      deal_ = JSON.stringify(deal);

      $("#featured_deal_details").append(
        `<div class="deal-modal-padding px-3"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button><h5 class="pmax-h5 pmax-extra-bold text-center mb-1">${deal.name}</h5><p class="pmax-light-grey text-center">${deal.description}</p></div><input type="hidden" id="deal_detail" value='${deal_}'>`
      );

      $("#featured_deal_details").append(
        `<div style="width: 100%; margin: 30% 42%;" class="lds-ripple"><div></div><div></div></div>`
      );
      fetch(`${base_url}/get_deals_items`)
        .then(response => response.json())
        .then(responseJson => {
          let a = [];

          for (let i = 0; i < responseJson[0].length; i++) {
            if (responseJson[0][i].deal_id == id) {
              a.push(responseJson[0][i]);
            }
          }

          return a;
        })
        .then(a => {
          let Marr = [];
          let arr = [];
          let old_list_id = -1;
          var arrI = 0;

          a.sort((a, b) => {
            return a.list_id - b.list_id;
          }).forEach((d, i) => {
            if (i === 0) {
              Marr[arrI] = [];
              Marr[arrI].push(d);
              old_list_id = d.list_id;
            } else {
              if (d.list_id === old_list_id) {
                Marr[arrI].push(d);
              } else {
                arrI++;
                Marr[arrI] = [];
                Marr[arrI].push(d);
              }
            }
            old_list_id = d.list_id;
          });
          let c_list = [];
          Marr.forEach(m => {
            let found = false,
              max = 1;
            m.forEach(a => {
              max = a.max;
            });
            for (let i = 1; i <= max; i++) {
              c_list.push(m);
            }
          });

          const number_list = ["First", "Second", "Third", "Fourth"];
          $(".lds-ripple").css("display", "none");

          for (let i = 0; i < c_list.length; i++) {
            $("#featured_deal_details").append(`
                            <div id="deal_step_${i}" class="deal-steps">
                                <div class="row">
                                <div class="col-8">
                                    <h6 class="pmax-h6 pmax-extra-bold m-0 px-3">Select Your ${
                                      number_list[i]
                                    } Item</h6>
                                </div>
                                <div class="col-4">
                                    <h6 class="pmax-h6 pmax-extra-bold m-0 px-3 text-right">${[
                                      i + 1
                                    ]} <span>of ${c_list.length}</span></h6>
                                </div>
                                </div>
                            </div>
                        `);

            for (let j = 0; j < c_list[i].length; j++) {
              let item_details = JSON.stringify(c_list[i][j]);

              $("#featured_deal_details").append(`
                                <div class="deal-modal-padding px-3" style="display: grid;">
                                    <label>
                                        <div class="card mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-sm-3 col-4">
                                                    <img class="card-img-top img-fluid" src="${base_url +
                                                      "/" +
                                                      c_list[i][j]
                                                        .image}" alt="Card image cap">
                                                </div>
                                                <div class="col-sm-9 col-8">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-10 col-9">
                                                                <h6 class="pmax-h6 pmax-grey mb-2">${
                                                                  c_list[i][j]
                                                                    .item_name
                                                                }</h6>
                                                                <p class="card-para pmax-light-grey">${
                                                                  c_list[i][j]
                                                                    .description
                                                                }</p>
                                                            </div>
                                                            <div class="col-sm-2 col-3 text-right ml-0 align-self-center">
                                                                <input type="radio" onchange="switch_second_item(${i})" id="item_${i}" name="item_${i}" value='${item_details}' required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            `);
            }
          }
        })
        .catch(err => console.error(err));
    })
    .catch(err => console.log(err));
};
//================================================================================================================================================
// GET DEAL DETAILS END
//================================================================================================================================================

//================================================================================================================================================
// SWITCH SECOND ITEM START
//================================================================================================================================================
const switch_second_item = num => {
  num = Number(num);
  location.href =
    location.origin + location.pathname + "#deal_step_" + (num + 1);
};
//================================================================================================================================================
// SWITCH SECOND ITEM END
//================================================================================================================================================
