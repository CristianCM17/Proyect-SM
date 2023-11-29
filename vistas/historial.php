<?php
/*session_start();
if (isset($_SESSION['login']) && $_SESSION['login']['rol'] == 2) {
        echo "Bienvenido compañero ".$_SESSION['login']['email'];
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
    <link rel="stylesheet" href="../assets/css/historial.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<header>
              <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" >
                    <div class="container-fluid">
                        <a class="navbar-brand" href="../index.html"><img src="../assets/img/logo-SM.png" height="150px"/></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                            <a class="nav-link active" href="../index.html"><h3>Inicio</h3>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../index.html#servicios"><h3>Servicios</h3></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../index.html#noticias"><h3>Noticias</h3></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="./aboutUs.html"><h3>Acerca de nosotros</h3></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../vistas/pagosCliente.php"><h3>Pagos</h3></a>
                            </li>

                            <li class="nav-item">
                            <button class="nav-link" onclick="cerrarSesion()"><h3>Cerrar sesión</h3></button>
                            </li>

                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-sm-2" type="search" placeholder="Search" wfd-id="id0">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        </div>
                    </div>
            </nav>
            <div style="background-color: #FFF;" class="escudos">
                <div><img class="sm1" src="../assets/img/logo-SM.png" alt=""></div>
                <div><img class="guanajuato" src="../assets/img/logo-gto-200.png" alt=""></div>
                <div><img class="sm2" src="../assets/img/antiguo escudo.png" alt=""></div>
            </div>
</header>      
<div  class="container">          
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="card-title m-b-0">Historial de pagos</h2>
                            </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>

                                                </th>
                                                <th scope="col"><h3>IDVENTA</h3></th>
                                                <th scope="col"><h3>TOTAL</h3></th>
                                                <th scope="col"><h3>FECHA</h3></th>
                                                <th scope="col"><h3>STATUS</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla" class="customtable">

                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
</div> 



</body>
</html>
<script>
  //hacer get
    $(document).ready(function() {
      $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlHistorial.php?opc=1",
            success: function(data){ //lo cachamos en data
              $('#tabla').html(data); //al elemento del TableBody le ponemos las iteraciones del get
            },
        })
    });
  </script>