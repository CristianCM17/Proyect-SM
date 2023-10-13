<?php
require_once '../models/pagosModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

  $pagos= new PagosModel();
  echo $pagos->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    
    
    <title>Document</title>

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="../index.html"><img src="../assets/img/logo-SM.png" height="200px" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#"><h3>Inicio</h3><span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                  <a class="nav-link" href="../index.html#servicios"><h3>Servicios</h3></a>
              </li>
              <li class="nav-item active" >
                <a class="nav-link" href="../index.html#noticias"><h3>Noticias</h3></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="./aboutUs.html"><h3>Acerca de nosotros</h3></a>
              </li>
              <li class="nav-item active">
                <button class="btn btn-outline-dark btnCarrito">Carrito(0)</button>
              </li>
              
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
          </div>
        </nav>
  
            <div class="escudos">
                <div><img class="sm1" src="../assets/img/logo-SM.png" alt=""></div>
                <div><img class="guanajuato" src="../assets/img/logo-gto-200.png" alt=""></div>
                <div><img class="sm2" src="../assets/img/antiguo escudo.png" alt=""></div>
            </div>
      </header>

    <!--Pagos disponibles-->
    <div class="row">
        <div class="col-sm-6 cartas">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Special title treatment</h5>
              <h3 class="card-subtitle mb-2 text-muted">$250</h6>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Agregar al carrito</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 cartas">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">Special title treatment</h5>
              <h3 class="card-subtitle mb-2 text-muted">$2500</h6>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Agregar al carrito</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 cartas">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Special title treatment</h5>
                <h3 class="card-subtitle mb-2 text-muted">$2500</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Agregar al carrito</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 cartas">
            <div class="card">
              <div class="card-body">
                <h2 class="card-title">Special title treatment</h5>
                <h3 class="card-subtitle mb-2 text-muted">$2500</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Agregar al carrito</a>
              </div>
            </div>
          </div>
      </div>



    
</body>
</html>