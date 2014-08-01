    /**
     * Create table via DOM
     * @param {Array} data
     */
    function nr_draw(data, p) {
        console.log(p);
        var container = document.querySelector('div.nr-default');
        console.log(container);

        var features = data.features;
        var plans = data.plans;
        var i, j, k, tr, td, th, a, span, item;
        var table = document.createElement('table');
        var tableBody = document.createElement('tbody');
        var tableHead = document.createElement('thead');
        var tableFoot = document.createElement('tfoot');

        //Print plans
        tr = document.createElement('tr');
        //th = document.createElement('th');
        //tr.appendChild(th);
        for (i = 0; i < plans.length; i++) {
            th = document.createElement('th');
            th.appendChild(document.createTextNode(plans[i].name));
            tr.appendChild(th);
        }
        tableHead.appendChild(tr);

        //Print prices
        tr = document.createElement('tr');
        //th = document.createElement('th');
        //th.innerHTML = p.label_price;
        //th.setAttribute('class', p.price_class);
        //tr.appendChild(th);
        for (i = 0; i < plans.length; i++) {
            td = document.createElement('td');
            td.appendChild(document.createTextNode(plans[i].price));
            td.innerHTML = p.label_before_price + td.innerHTML + p.label_after_price;
            td.setAttribute('class', p.price_class);
            tr.appendChild(td);
        }
        tableBody.appendChild(tr);

        //Print features
        for (i = 0; i < features.length; i++) {
            tr = document.createElement('tr');
            //th = document.createElement('th');
            //th.appendChild(document.createTextNode(features[i]));
            //tr.appendChild(th);
            for (j = 0; j < plans.length; j++) {
                td = document.createElement('td');
                var val = ''; //Val was hanging on to old values and repeating them where they should not be.
                for (k = 0; k < plans[j].features.length; k++) {
                    if (plans[j].features[k].name == features[i]) {
                        val = (plans[j].features[k].value === parseInt(plans[j].features[k].value))? 
                           plans[j].features[k].value + ' ' + features[i] : features[i];
                    } 
                }
                td.innerHTML = val; //document.createTextNode
                tr.appendChild(td);
            }
            tableBody.appendChild(tr);
        }

       
        //Print trials
        tr = document.createElement('tr');
        //th = document.createElement('th');
        //tr.appendChild(th);
        for (i = 0; i < plans.length; i++) {
            if (plans[i].discounts.length > 0) {
              td = document.createElement('td');
              td.setAttribute("class", "nr-discount");
              td.innerHTML = "<span class='nr-trial-days'>" +
                              (plans[i].discounts[0].discount.days_to_apply) +
                              " days</span><br>free " +
                              (plans[i].discounts[0].discount.discount_type);
              tr.appendChild(td);
            } else {
              th = document.createElement('th');
              tr.appendChild(th);
            }
        }
        tableFoot.appendChild(tr);

        //Print links
        tr = document.createElement('tr');
        //th = document.createElement('th');
        //tr.appendChild(th);
        for (i = 0; i < plans.length; i++) {
            td = document.createElement('td');

            if (p.select_url) {
                item = document.createElement('a');
                item.setAttribute('href', p.select_url + plans[i].id);
                item.setAttribute('class', 'nr-plan-select');
                item.setAttribute('target', '_blank');
                item.setAttribute('data-id', plans[i].id);
            }
            else {
                item = document.createElement('span');
            }
            if (typeof p.select_callback == 'function') {
                item.setAttribute('data-id', plans[i].id);
                item.onclick = function (e) {
                    e.stopPropagation();
                    p.select_callback(this.getAttribute('data-id'));
                    return false;
                }
            }
            item.innerHTML = p.label_select;

            td.appendChild(item);
            tr.appendChild(td);
        }
        tableFoot.appendChild(tr);
 
        table.appendChild(tableHead);
        table.appendChild(tableBody);
        table.appendChild(tableFoot);

        container.appendChild(table);
        
        // append signup button
        //signup_div = document.createElement('div');
        //signup_div.setAttribute('class', 'nr-signup-div');
        //signup = document.createElement('a');
        //signup.setAttribute('href', 'https://portal.nurego.com/sign-up?' + jQuery(this).data("id"));
        //signup.setAttribute('class', 'nr-signup');
        //signup.innerHTML = "Sign Up";
        
        // Email input area 
        //var signup_email = document.createElement('input');
        //signup_email.setAttribute('type', 'text');
        //signup_email.setAttribute('value', 'Email');
        //signup_div.appendChild(signup_email);
        //signup_div.appendChild(signup);
        //container.appendChild(signup_div);
        
        // handle select event
        //jQuery('.nr-plan-select').on('click', function(e) {
        //  jQuery('.nr-plan-selected').removeClass('nr-plan-selected');
          
        //  jQuery(this).addClass('nr-plan-selected');
          
          //e.preventDefault();
          return false;
        //});
        
        // handle signup click
        jQuery('.nr-signup').on('click', function(e) {
          // Old way of handling email
          //var email = "email+" + (new Date().getTime()) + "@example.com";
          // But we want an actual email now
          var email = jQuery( signup_email ).val();
          
          var xhr = new easyXDM.Rpc({
              remote: p.nurego_url + "/cors/"
          }, {
              remote: {
                  request: {} // request is exposed by /cors/
              }
          });
          
          xhr.request({
              url: "/v1/registrations/?api_key=" + p.api_key,
              method: "POST",
              data: { email: email, plan_id: jQuery('.nr-plan-selected').data("id") }
          }, function(response) {
              console.log(response.status);
              console.log(response.data);
              var reg_id = JSON.parse(response.data)["id"];
              xhr.request({
                  url: "/v1/registrations/" + reg_id + "/complete?api_key=" + p.api_key,
                  method: "POST",
                  data: { password: "hello" }
              }, function(response) {
                console.log(response.status);
                console.log(response.data);
              })
          });
          
          e.preventDefault();
          return false;
        })
    }


