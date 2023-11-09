<?php 
require_once '../models/CarritoModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';
session_start();



    if( isset($_GET['carr']) ){
         $CarritoModel= new CarritoModel();

        switch($_GET['carr']){
            case 1: // mostrar
                obtenerCarrito();//cuando se cargue la pagina esto se va a mostrar
                break;
            case 2: //eliminar
                $idcarro= $_POST['idcarro'];

                //buscamos el id en la session y al encontrarlo eliminamos el indice
                foreach($_SESSION['carrito'] as $indice => $pago){
                    if ($pago['idpago']==$idcarro) {
                        unset($_SESSION['carrito'][$indice]);
                    }
                }
                obtenerCarrito();
                break;
            case 3: //actualizar
                $idcarro= $_POST['idcarro']; 
                 $cantidad= $_POST['cantidad'];

                   //buscamos el id en la session y al encontrarlo actualizamos la cantidad
                   //con el & atras de pago lo asignamos al array original y no a una copia
                   foreach($_SESSION['carrito'] as $indice => &$pago){
                    if ($pago['idpago']==$idcarro) {
                        $pago['cantidad']= $cantidad;
                    }
                }
                
              
               obtenerCarrito(); //se muestra la tabla actualizada cuando termine la peticion ajax
            
                break;
            case 4:
             
                break;


    }
}else{
    header('Location: ./carrito.php');
}
    
    function obtenerCarrito(){
        //si esta vacia la session da esa adverencia
        if (empty($_SESSION['carrito'])) {
            echo '<div class="alert alert-dismissible alert-primary">       
           <h3 class="text-center"> <strong>Oh, parece que no has agregado productos en el carrito!</strong> </h2>
          </div>';

          //hacer el mapeo de la tabla carrito
        }else{
        $obtenerIteraciones='';
        //el total
        $total=0;
       // $carrito=$CarritoModel->getAll();
        //hacer las iteraciones necesarias para mapear lo de la base de datos e incrustarlo en el html
        foreach($_SESSION['carrito'] as $indice => $servicios) {
              $total+= $servicios['precio']*$servicios['cantidad']; 
              $obtenerIteraciones.=       
           '<tr class="table-secondary">               
            <td class="text-center" width="40%">'.$servicios['pago'].'</td>
            <td class="text-center" width="10%">
            <form id="oc'.$servicios['idpago'].'">
             <input type="hidden" name="idcarro" id="idcarro" value="'.$servicios['idpago'].'">  
             <input type="hidden" name="pago" id="pago" value="'.$servicios['pago'].'"> 
             <input type="number" name="cantidad" id="cantidad" value="'.$servicios['cantidad'].'"> 
             <input type="hidden" name="precio" id="precio" value="'.number_format($servicios['precio']*$servicios['cantidad'],2).'"> 
            
            
             <input type="hidden" name="subtotal" id="subtotal" value="'.$servicios['pago'].'"> 
             </form>
            </td>
            <td class="text-center" width="20%">$'.$servicios['precio'].'</td>
            <td class="text-center" width="20%">$'.number_format($servicios['precio']*$servicios['cantidad'],2).'</td>
            <td class="text-center" width="10%">

            <button type="button" class="btn btn-danger" onclick="eliminar('.$servicios['idpago'].')">Eliminar</button>
            <button style="margin-top: 5px;" type="button" class="btn btn-primary" onclick="actualizarCant('.$servicios['idpago'].')">Actualizar</button>
            
            </td>
        </tr>';
       
        }
        
         echo '<div class="row justify-content-center">
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
                '.$obtenerIteraciones.'
          </tbody>

      </table>
      <div class="container" id="contador">     
      <h2>Total: '.number_format($total,2).'</h2>
</div>
    </div>
</div>';
    }
    }


?>