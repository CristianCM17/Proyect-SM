
<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']['rol'] == 2) {
     header('Location: ./carrito.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <title>Municipio de Santiago Maravatío</title>
</head>
<body>
    <section class="vh-100 backlog" style="background: linear-gradient(#735caa,#ead3ef);">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-6 col-lg-5 d-none d-md-block ">
                    <img src="../assets/img/paralogingrande.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;   height: 100%; "/>
                  </div>
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form id="loginPrin">

                      <div id='resajax' class="container alert alert-primary" style="display:none;"></div>

                        <div class="d-flex align-items-center mb-3 pb-1">
                         <img src="../assets/img/logo-SM.png" height="150px">
                          <span class="h1 fw-bold mb-0">Iniciar sesión</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Acceder a tu cuenta</h5>
      
                        <div class="form-outline mb-4">
                          <input type="text" name="email"  class="form-control form-control-lg" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Ingrese una dirección de correo electrónico válida" />
                          <label class="form-label" for="form2Example17">Correo electrónico</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" name="contrasena"  class="form-control form-control-lg" pattern=".{8,}" title="Debe contener al menos 8 caracteres" />
                          <label class="form-label" for="form2Example27">Contraseña</label>
                        </div>


      
                        <div class="pt-1 mb-4">
                          <button type="button" class="btn btn-dark btn-lg btn-block"onclick="acceder()">Acceder</button>
                        </div>
      
                       <!-- <a class="small text-muted" href="#!">Olvidaste tu contraseña?</a>
                       --> <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes cuenta? <a href="./signup.php"
                            style="color: #393f81;">Registrate aquí</a></p>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script>
        function acceder() {
          var formData= $('#loginPrin').serialize();
          $("#resajax").show();
          $.ajax({
            type: "POST",
            url: "../controlers/ctrlLogin.php?log=1",
            data: formData ,
            success: function(data){
                switch (parseInt(data)) {
                  case 1:
                    window.location.href="../vistas/pagos.php";
                    break;
                  case 2:
                    window.location.href="../vistas/carrito.php";
                    break;
                
                  default:
                  $('#resajax').html(data);
                    break;
                }
            }
          });
         
        }
      </script>
      
</body>
</html>