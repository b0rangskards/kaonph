//Index one block height
function setHeiHeight() {
    "use strict";
  $('#promo_head').css({
    height: $(window).height() + 'px'
  });
}

$(document).ready(function () {
    "use strict";

  // Register Public Modal
  $('#register_btn').on('click', function () {
    $('#modal_register').removeClass("none");
  });

  // Register Resturant Owners Modal
  $('#register_owner_btn').on('click', function () {
      $('#modal_register_owner').removeClass("none");
  });

 // New Restaurant Modal
//$('.add-restaurant-btn').on('click', function () {
//   $('#modal_new_restaurant').removeClass('none');
//});


  $('.close_modal').on('click', function () {
    var modal_container = $(this).parentsUntil('.modal_container').parent();
    modal_container.addClass("none");
  });

  //////Autorization//////
  $('.log_btn').on('click', function () {
    $('#modal_login').removeClass("none");
  })

  //////Page load//////
  $("body").css("display", "none");
  $("body").fadeIn(500);
  $("a.transition").click(function(event){
    event.preventDefault();
    var linkLocation = this.href;

    $("body").fadeOut(900, function(){
        window.location = linkLocation;
    });
  });

  //////Mobile menu in map page (01.html)//////
  $('.mobile_menu').on('click', function () {
    $('.container-fluid.menu').removeClass("mobile");
  });
  $('#close_menu').on('click', function () {
    $('.container-fluid.menu').addClass("mobile");
  });
  $('.container-fluid.menu a').on('click', function () {
    $('.container-fluid.menu').addClass("mobile");
  });
});
