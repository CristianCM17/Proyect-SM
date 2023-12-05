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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/procesarPago.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AZnlm2WUZX47Nzx8inmVJNbeyonU95rEK-Exod_UtI14m53dOhgLD6PZmw8XTOlCKFDJd-RatI6jZKUS&currency=MXN"></script>
    <title>Municipio de Santiago Maravatío</title>
</head>
<body>





<div class="container">

	<div class="card">
  	<div class="card-body py-5 px-4">
    <h6 class="card-title text-muted">Municipio de Santiago Maravatio</h6>
    <h2 class="text">Completar los pagos</h2>
 	<h3 class="Price pt-3"><i class="fa fa-dollar mr-1"></i>$<?php echo $_SESSION['total'] ?></h3>
   <p class="card-text text-muted">Su pago esta protegido.<br>Sus datos estan seguros.</p>
    <div id="paypal-button-container"  class="container"></div>
    <footer class="footer text-muted pt-5"><p class="mytext mt-3">"El pueblo hace la historia"<br>H.Ayuntamiento 2021-2024</p></footer>
    </div>
	</div>

</div>

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
              value: <?php echo $_SESSION['total'] ?> //monto que va ser que se debe de pagar
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
        }).then(function() {
    // Redirigir a otra ventana después de la solicitud al servidor
    window.location.href = './historial.php';
});
        //window.location.href = "./historial.php";
    },

    onCancel: function(data){
      alert('Pago cancelado');
    }
  }).render('#paypal-button-container')
</script>                    

</body>

</html>