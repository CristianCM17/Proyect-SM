<?php
require_once '../models/CarritoModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

//$carritoModel= new CarritoModel();
//$carrito=$carritoModel->getAll();
$con = new Conexion();
$db = $con->conectar();

    $query = "SELECT SUM(subtotal) AS suma FROM carrito";
    $reslts = $db->Execute($query);
    $fila= $reslts->FetchRow();
    $contador = $fila['suma'];
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Municipio de Santiago Maravatío</title>
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
                                <span class="visually-hidden">(current)</span>
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
                            <a class="nav-link" href="../vistas/pagos.php"><h3>Pagos</h3></a>
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
    
            

<main>  
    <div  class="alert alert-dismissible alert-secondary">
    <strong id="resAJAX"></strong>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <h2 style="margin-top: 50px;">Mi carrito</h2>
            <hr/>
        <table  class="table table-hover table-bordered">
            <thead>
            <tr class="table-primary">
                
                <th class="text-center" width="40%" scope="col">Descripcion</th>
                <th class="text-center" width="15%" scope="col">Cantidad</th>
                <th class="text-center" width="20%" scope="col">Precio</th>  
                <th class="text-center" width="20%" scope="col">Subtotal</th>  
                <th class="text-center" width="10%" scope="col"></th>      
            </tr>
            </thead>
            <tbody id="body">  

              </tbody>
          </table>
        </div>
    </div>
    </div>
     
    <div class="container" id="contador">     
            <h2>Total: $<b id="total"><?php echo $contador; ?></b></h2>    
    </div>
    
</main> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
            function eliminar(id){
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlCarrito.php?carr=2",
            data: {idcarro:id},
            success: function(data){ //lo cachamos en data
              $('#body').html(data); //al elemento del titulo le ponemos el contenido
            },
        })
        }

       
            function actualizarCant(){
      var formData= $('#ocCarrito').serialize(); //serializamos los datos del from 
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlCarrito.php?carr=3",
            data: formData,
            success: function(data){ //lo cachamos en data
              $('#body').html(data); //al elemento con ese id le ponemos el contenido que se mande
            }
        });
        
        }       
</script>

</body>
</html>
<script>
  //hacer get
    $(document).ready(function() {
      $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlCarrito.php?carr=1",
            success: function(data){ //lo cachamos en data
              $('#body').html(data); //al elemento del TableBody le ponemos las iteraciones del get
            },
        })
    });
  </script>