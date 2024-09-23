$(".number-input").keyup(function(e){
    if($(this).val().length >= 6) {
      $(".call-button").addClass("show");  
    }
    if(e.which == 8 && $(this).val().length < 6) {
      $(".call-button").removeClass("show");
    }
  });
  
  $(".number-input").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false; // Permitir solo dígitos
    }
  });
  
  $("[data-number]").on('click', function(){
    if ($(".number-input").val().length < 6) {
      var phoneNumber = $(".number-input").val() + $(this).data("number");
      $(".number-input").val(phoneNumber);
    }
    if ($(".number-input").val().length == 6) {
      $(".call-button").addClass("show");
    }
  });
  
  $(".delete").on('click', function(){
    var phoneNumber = $(".number-input").val().slice(0, -1);
    $(".number-input").val(phoneNumber);
    if ($(".number-input").val().length < 6) {
      $(".call-button").removeClass("show");
    }
  });

  $(document).ready(function () {
    $("#verifyButton").on('click', function () {
      var claveIngresada = $("#numberInput").val();
      console.log("Clave ingresada:", claveIngresada);

      $.ajax({
          type: "POST",
          url: "http://localhost:3000/admin/huella/dinamica/verificar_clave",
          data: { clave: claveIngresada },
          success: function (response) {
              $("#resultMessage").html(`<div class="success-message">${response}</div>`);
          },
          error: function () {
              $("#resultMessage").html(`<div class="error-message">Error en la verificación.</div>`);
          }
      });
  });
});


