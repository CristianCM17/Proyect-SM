<?php 
/*session_start();
if (isset($_SESSION['login']) && $_SESSION['login']['rol'] == 2) {
  
}else {
  header('Location: ../index.html');

}*/
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
    <script src="https://www.paypal.com/sdk/js?client-id=AZnlm2WUZX47Nzx8inmVJNbeyonU95rEK-Exod_UtI14m53dOhgLD6PZmw8XTOlCKFDJd-RatI6jZKUS&currency=MXN"></script>
    <title>Municipio de Santiago Maravatío</title>
</head>
<body>




<!--<div class="pagoCompletado" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
  <div class="card-body">
    <div class="wrapper"  style="text-align: center;">
      <h2>TU PAGO</h2>
      <h2 class="display-3">$</h2>
      <button class="btn btn-primary mt-3" onclick="showSwal('success-message')">Completar Pago</button>
    </div>
  </div>
</div>-->

<div id="paypal-button-container"  class="container"></div>
<script>
  paypal.Buttons({
    style:{
      color: "blue",
      shape: "pill",
      label: "pay" 
    },
    createOrder: function(data, actions){
        return actions.order.create({
          purchase_units:[{
            amount: {
              value: 100 //monto que va ser que se debe de pagar
            }
          }]
        })
    },
    //cuando se complete el pago
    onApprove: function(data, actions){
        actions.order.capture().then(function(detalles){
            console.log(detalles);
            let idTransaccion= detalles.id;
            let url= "../controlers/ctrlVenta.php?pro=2";
            return fetch(url,{
              method: 'post',
              headers: {
                'content-type': 'application/json'
              },
              body: JSON.stringify({
                idTransaccion: idTransaccion
              })
            })
        });
    },

    onCancel: function(data){
      alert('Pago cancelado');
    }
  }).render('#paypal-button-container')
</script>                    

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