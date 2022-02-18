require('./bootstrap');
import 'slick-carousel/slick/slick';

//const Swal = require('sweetalert2')

$(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(document).ready(function(e){
  $('[data-toggle="tooltip"]').tooltip();
});