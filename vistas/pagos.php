<?php
require_once '../models/pagosModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';


  

$con = new Conexion();
$db = $con->conectar();

 //le mandamos cuantos productos hay en el carrito al boton del carrito
        $query = "SELECT COUNT(*) AS contador FROM carrito";
        $reslts = $db->Execute($query);
        $fila= $reslts->FetchRow();
        $contador = $fila['contador'];


       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    
    
    <title>Municipio de Santiago Maravatío</title>

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
                <a class="nav-link" href="../index.html"><h3>Inicio</h3><span class="sr-only">(current)</span></a>
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
              <li>
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalInsert" >Insertar</button>
              </li>
              <li class="nav-item active">
                <button class="btn btn-outline-dark btnCarrito" onclick="irCarrito()">Carrito (<span id="cantidadCarrito"><?php echo $contador; ?></span>)</button>
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



<!--FORM Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar el pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form id="frmEdPago" >
        <input type="hidden"  id="hddid" name="hddid"> <!--Id que no se ve--> 
        <div class="form-group">
          <label for="txtpago">Titulo Pago</label>
          <input type="text" id="txtpago" name="txtpago" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtPrecio">Precio </label>
          <input type="text" id="txtPrecio" name="txtPrecio" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtDescripcion">Descripcion</label>
          <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtPeriodo">Periodo</label>
          <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" onclick=editar()>Editar</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

<!--MODAL INSERT-->
<div class="modal fade" id="ModalInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
      <form id="frmInPago" >
        <div class="form-group">
          <label for="txtpago">Titulo Pago</label>
          <input type="text" id="txtpago" name="txtpago" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtPrecio">Precio </label>
          <input type="text" id="txtPrecio" name="txtPrecio" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtDescripcion">Descripcion</label>
          <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control">
        </div>
        <div class="form-group">
          <label for="txtPeriodo">Periodo</label>
          <input type="text" id="txtPeriodo" name="txtPeriodo" class="form-control">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick=insertar()>Insertar</button>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>




    <div id='resajx' class="alert alert-primary"></div>

    <div class="row cartasmas" id="carta" >

        

      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

        function mandar(id){
          document.getElementById('hddid').value= id;
        }
    
    function irCarrito() {
      window.location.href = "./carrito.php";
    }

    function agregarCarrito(formId){
      var formData= $('#' + formId).serialize(); //serializamos los datos del from dandole un id dinamico al formulario 
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=1",
            data: formData,
            success: function(data){ //lo cachamos en data
              $('#cantidadCarrito').html(data); //al elemento con ese id le ponemos el contenido que se mande
            }
        })
        }

        function editar(){
      var formData= $('#frmEdPago').serialize(); //serializamos los datos del from 
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=2",
            data: formData,
            success: function(data){ //lo cachamos en data
              $('#carta').html(data); //al elemento con ese id le ponemos el contenido que se mande
            }
        });
        
        }

        function insertar(){
      var formData= $('#frmInPago').serialize(); //serializamos los datos del from 
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=4",
            data: formData,
            success: function(data){ //lo cachamos en data
              $('#carta').html(data); //al elemento con ese id le ponemos el contenido que se mande
            }
        });
        
        }

        function eliminar(id){
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=3",
            data: {idpago:id},
            success: function(data){ //lo cachamos en data
              $('#carta').html(data); //al elemento del titulo le ponemos el contenido
            },
        })
        }
  
</script>
    
</body>
</html>
<script>
  //hacer get
    $(document).ready(function() {
      $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=5",
            success: function(data){ //lo cachamos en data
              $('#carta').html(data); //al elemento del TableBody le ponemos las iteraciones del get
            },
        })
    });
  </script>