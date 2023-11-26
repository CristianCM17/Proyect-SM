<?php 
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']['rol'] == 2) {
  
}else {
  header('Location: ../index.html');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <title>Municipio de Santiago Maravatío</title>
</head>
<body>




<div class="pagoCompletado" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
  <div class="card-body">
    <div class="wrapper"  style="text-align: center;">
      <h2>TU PAGO</h2>
      <h2 class="display-3">$<?php echo number_format($_SESSION['total'],2); ?></h2>
      <button class="btn btn-primary mt-3" onclick="showSwal('success-message')">Completar Pago</button>
    </div>
  </div>
</div>

<div class="container"><h2  id="ajax"></h2></div>
                    

</body>
<script>
(function($) {
  showSwal = function(type) {
    'use strict';
    if (type === 'success-message') {
      swal({
        title: 'Felicidades!',
        text: 'Has pagado tus servicios correctamente',
        type: 'success',
        buttons: {
          pagar: {
            text: "Aceptar",
            value: true,
            visible: true,
            className: "btn btn-primary",
          }
        }
      }, function(value) {
        if (value) {
            $.ajax({
                type: "POST",
                url: "../controlers/ctrlVenta.php?pro=2",
                success: function(data){
                   window.location.href = "./pagosCliente.php";
                  // $('#ajax').html(data);
                }
            });
        }
      });
    } else {
      swal("Error occurred!");
    } 
  };
})(jQuery);



</script>
</html>