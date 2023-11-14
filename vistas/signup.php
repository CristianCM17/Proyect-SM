
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Municipio de Santiago Maravatío</title>
</head>
<body>
    <section class="vh-100" style="background: linear-gradient(#735caa,#ead3ef);">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registro</p>
      
                      <form class="mx-1 mx-md-4" id="frmRegistro" method="POST" action="../controlers/ctrlUsario.php?action=1">
                     <?php
                          if (isset($_GET['err']) ) {
                            if ($_GET['err'] == 1) {
                              echo '<div class="alert alert-primary">Llena todos los campos</div>';
                            }elseif ($_GET['err'] == 2) {
                              echo '<div class="alert alert-primary">Ya existe ese correo registrado</div>';
                            }
                           
                          } 
                     ?> 
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="bi bi-person-fill fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" name="nombre" class="form-control" pattern="[A-Za-z]+" title="Ingrese un nombre válido (solo letras)" />
                            <label class="form-label" for="form3Example1c" >Nombre</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" name="email" class="form-control"   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Ingrese una dirección de correo electrónico válida" />
                            <label class="form-label" for="form3Example3c">Correo electrónico</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" name="contrasena" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" title="La contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial"/>
                            <label class="form-label" for="form3Example4c">Contraseña</label>
                          </div>
                        </div>
      
                     <!--   <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="form3Example4cd" class="form-control" />
                            <label class="form-label" for="form3Example4cd">Repite tu contraseña</label>
                          </div>
                        </div>-->

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="number" name="latitud" class="form-control"/>
                              <label class="form-label" for="form3Example4cd" >Latitud</label>
                            </div>
                          </div>

                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="number" name="longitud" class="form-control"  />
                              <label class="form-label" for="form3Example4cd" >Longitud</label>
                            </div>
                          </div>

                          <div class="d-flex flex-row align-items-center mb-4"">
                          <div class="g-recaptcha" data-sitekey="6LdLcAgpAAAAAAMNnV4Yy1KnBFv0zjiDugRPHqcI"></div>
                        </div>
      
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" class="btn btn-dark btn-lg btn-block">Registrar</button>
                        </div>
      
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="../assets/img/pararesgistro2.jpg"
                        class="img-fluid" alt="Sample image" style="border-radius: 1rem 0 0 1rem;   height: 100%; ">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script>      
   /*   function insertar(){
          var formData= $('#frmRegistro').serialize(); //serializamos los datos del from 
          $('#resajx').show();
          $.ajax({ // peticion post de ajax
            type: "POST",
            url: "../controlers/ctrlUsario.php?action=1",
            data: formData,
            success: function(data){ //lo cachamos en data
             $('#resajx').html(data); //al elemento con ese id le ponemos el contenido que se mande
            }
        });
        
        }*/</script>
</body>
</html>