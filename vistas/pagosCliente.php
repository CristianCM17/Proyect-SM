
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
                <a class="nav-link" href="../index.html"><h3>Inicio</h3></a>
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
                <a class="nav-link" href="../vistas/historial.php"><h3>Historial de pagos</h3></a>
              </li>
              <li class="nav-item active">
                <form action="../controlers/alogin.php" method="post">
                <button class="btn btn-outline-dark btnCarrito" type="submit" name="ircarrito">Carrito (<span id="cantidadCarrito"><?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']); ?></span>)</button>
                </form>
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



    <div id='resajx' class="alert alert-primary"></div>

    <div class="row cartasmas" id="carta" >

        

      </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    


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
 
</script>	
    
</body>
</html>
<script>
  //hacer get
    $(document).ready(function() {
      $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlPagos.php?opc=6",
            success: function(data){ //lo cachamos en data
              $('#carta').html(data); //al elemento del TableBody le ponemos las iteraciones del get
            },
        })
    });
  </script>