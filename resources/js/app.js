/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

//***Panel navigation
$(document).ready(function(){
    var sidebar = $("#mySidebar");
    if(sidebar.length){
      console.log("Entro");
      var asideSpan = $(".aside_span");
      var main = $("main");
      var icons = $(".gg");
      asideSpan.hide();
      icons.hide();
      var x = window.matchMedia("(max-width: 450px)");
      if (x.matches) {// If media query matches (max-width: 450px)
        $(".closebtn").css("right","7px");
        icons.css("margin-left","19px");
        $(".gg-profile").css("margin-left","15px");
        $(".gg-home-alt").css("margin-left","17px")
                          .css("margin-top","4px");

        sidebar.css("width","50px");
        main.css("margin-left","2px");
      }else {
        icons.css("margin-left","15px")
                .css("margin-right","7px")
                .css("margin-top","7px");
        $(".gg-profile").css("margin-left","12px")
                    .css("margin-top","4px")
                    .css("margin-right","4px");
        $(".gg-home-alt").css("margin-top","10px")
                          .css("margin-left","14px");
        sidebar.css("width","135px");
        main.css("margin-left","90px");
        var x = window.matchMedia("(max-width: 768px)");
        if(x.matches){// If media query matches (max-width: 768px)
        }else{
          var x = window.matchMedia("(max-width: 1024px)");
          if(x.matches){// If media query matches (max-width: 1024px)
          }else{
            sidebar.css("width","190px");
            main.css("margin-left","250px");
          }
        }
        asideSpan.show();
      }
      icons.show();

    }
  });

  /* Set class active to current link */
  var pathname = window.location.pathname;
  $(".active").removeClass("active");
  switch (pathname) {
    case "/":
      $("#aside_home").addClass("active");

      break;
    case "/user/profile":
      $("#aside_profile").addClass("active");

      break;
    case "/user/barber/show":
      $("#aside_barber").addClass("active");

      break;
    default:

  }
  function showHourDay(divId) {
    let div = $(divId);

    div.addClass("border border-secondary py-1 bg-success");
    div.append("<div id='RowDay' class='row justify-content-center'></div>");
    div = $('#RowDay');
    div.append("<label>desde: </label>");
    div.append("<input type='time' name='open' min='08:00' max='22:00' step='1800' required>");
    div.append("<label>hasta: </label>");
    div.append("<input type='time' name='close' min='08:00' max='22:00' step='1800' required>");
    div.append("<label>desde(opc): </label>");
    div.append("<input type='time' name='open' min='08:00' max='22:00' step='1800'>");
    div.append("<label>hasta(opc): </label>");
    div.append("<input type='time' name='close' min='08:00' max='22:00' step='1800'>");

  }
  function hideHourDay(divId) {
    let div = $(divId);
    div.removeClass("border border-secondary py-1 bg-success");
    let save = div.children(".custom-checkbox").detach();
    div.empty().append(save);
  }
  $('input[type=checkbox]').on('change', function() {
    let divId = '#'+$(this).prop("id");

      if ($(this).is(':checked') ) {
        showHourDay(divId);
      }else {
        hideHourDay(divId);
      }
  });
