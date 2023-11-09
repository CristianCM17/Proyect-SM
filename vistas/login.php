<?php 

if(isset($_POST['acceder'])){
    $secret ="6LdLcAgpAAAAAFZwxYUkr47-gW8G6zTlpW3S6QLp";
    $response= $_POST['g-recaptcha-response'];
    $remoteip=$_SERVER['REMOTE_ADDR'];
    $url= "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row=json_decode($data, true);

   // echo $row['success'];

    if ($row['success'] == "true") {
     echo "<script>alert('parece que no eres un robot');</script>";
    }else echo "<script>alert('parece que si eres un robot')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
      
                      <form method="post">
      
                        <div class="d-flex align-items-center mb-3 pb-1">
                        
                         <img src="../assets/img/logo-SM.png" height="150px">
                          <span class="h1 fw-bold mb-0">Iniciar sesión</span>
                        </div>
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Acceder a tu cuenta</h5>
      
                        <div class="form-outline mb-4">
                          <input type="email" id="form2Example17" class="form-control form-control-lg" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Ingrese una dirección de correo electrónico válida" />
                          <label class="form-label" for="form2Example17">Correo electrónico</label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="form2Example27" class="form-control form-control-lg" pattern=".{8,}" title="Debe contener al menos 8 caracteres" />
                          <label class="form-label" for="form2Example27">Contraseña</label>
                        </div>

                        <div class="form-outline mb-4">
                          <div class="g-recaptcha" data-sitekey="6LdLcAgpAAAAAAMNnV4Yy1KnBFv0zjiDugRPHqcI"></div>
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" type="submit" name="acceder">Acceder</button>
                        </div>
      
                       <!-- <a class="small text-muted" href="#!">Olvidaste tu contraseña?</a>
                       --> <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes cuenta? <a href="#!"
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>