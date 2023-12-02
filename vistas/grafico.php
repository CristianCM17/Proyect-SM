<?php 
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']['rol'] == 1) {
        echo "Bienvenido compañero ".$_SESSION['login']['email'];
 }else {
  header('Location: ../index.html');

  }

    $con = new Conexion();
    $db = $con->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fechaInicio = $_POST['fechaInicio'];
      $fechaFin = $_POST['fechaFin'];

      // Convertir al formato 'YYYY-MM-DD'
      $fechaInicioFormato = date('Y-m-d', strtotime($fechaInicio));
      $fechaFinFormato = date('Y-m-d', strtotime($fechaFin));
    $query = "SELECT p.pago, COUNT(p.pago) as contador
    FROM pagos p
    JOIN venta_detalle vd ON vd.idpago = p.idpago
    JOIN venta v ON v.idventa = vd.idventa
    WHERE v.fecha BETWEEN '$fechaInicioFormato' AND '$fechaFinFormato'
    GROUP BY 1";
                    $reslts = $db->Execute($query);
    }else {
      $query = "SELECT p.pago, COUNT(p.pago) as contador
    FROM pagos p
    JOIN venta_detalle vd ON vd.idpago = p.idpago
    JOIN venta v ON v.idventa = vd.idventa
    GROUP BY 1";

    $reslts = $db->Execute($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
    
    
    <title>Municipio de Santiago Maravatío</title>

</head>
<body>
  

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
          <a class="navbar-brand" href="../index.html"><img src="../assets/img/logo-SM.png" height="200px" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="../index.html"><h3>Inicio</h3><span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="./pagos.php"><h3>Pagos</h3></a>
              </li>
              <li class="nav-item active">
                <button type="button" class="btn btn-outline-dark ml-2" class="nav-link" onclick="cerrarSesion()">Cerrar sesión</button>
              </li>
            </ul>
          </div>
        </nav>
            <div class="escudos">
                <div><img class="sm1" src="../assets/img/logo-SM.png" alt=""></div>
                <div><img class="guanajuato" src="../assets/img/logo-gto-200.png" alt=""></div>
                <div><img class="sm2" src="../assets/img/antiguo escudo.png" alt=""></div>
            </div>
      </header>

        <div class="container mt-5">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <label for="fechaInicio">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
              </div>
              <div class="col-md-4">
                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
              </div>
            </div>
            <div class="row justify-content-center mt-3">
           <button type="submit" class="btn btn-primary">Enviar</button>
           </div>
          </form>
        </div>
        
         <div class="container" id="piechart" style="width: 900px; height: 500px;"></div>

      

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
         <script type="text/javascript">
                        function cerrarSesion(){
      $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlCarrito.php?carr=4",
            success: function(response){  
                    location.reload(); //recargamos la pagina
                    alert("Sesión cerrada exitosamente");
            }
        });
    }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Pagos', 'Cantidad'],
          <?php

            while ($fila = $reslts->FetchRow()) {
                echo "['".$fila["pago"]."',".$fila["contador"]."],";
            }
          ?>
        ]);

        var options = {
          title: 'Cantidad de pagos completados',
          is3D: true
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>
