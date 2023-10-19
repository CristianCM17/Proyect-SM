<?php 
require_once '../models/CarritoModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

    if( isset($_GET['carr']) ){
         $CarritoModel= new CarritoModel();

        switch($_GET['carr']){
            case 1: // mostrar
                obtenerCarrito($CarritoModel);//cuando se cargue la pagina esto se va a mostrar
                break;
            case 2: //eliminar
                $idcarro= $_POST['idcarro'];
                $CarritoModel->delete($idcarro);
                obtenerCarrito($CarritoModel);//se muestra la tabla actualizada cuando termine la peticion ajax
                break;
            case 3: //actualizar
                $idcarro= $_POST['idcarro'];
                $pago= $_POST['pago'];
                $cantidad= $_POST['cantidad'];
                $precio= $_POST['precio'];
                $subtotal= $_POST['subtotal'];
               $CarritoModel->ActCantidad($idcarro,$pago,$cantidad,$precio,$subtotal);

               obtenerCarrito($CarritoModel); //se muestra la tabla actualizada cuando termine la peticion ajax
                break;


    }
}else{
    header('Location: ./carrito.php');
}
    //hacer el mapeo de la tabla carrito
    function obtenerCarrito( $CarritoModel){
        $obtenerIteraciones='';
        $carrito=$CarritoModel->getAll();
        //hacer las iteraciones necesarias para mapear lo de la base de datos e incrustarlo en el html
         while(!$carrito->EOF){   
                
              $obtenerIteraciones.=       
           '<tr class="table-secondary">               
            <td class="text-center" width="40%">'.$carrito->fields[4].'</td>
            <td class="text-center" width="10%">
            <form id="ocCarrito">
             <input type="hidden" name="idcarro" id="idcarro" value="'.$carrito->fields[0].'">  
             <input type="hidden" name="pago" id="pago" value="'.$carrito->fields[4].'"> 
             <input type="number" name="cantidad" id="cantidad" value="'.$carrito->fields[1].'"> 
             <input type="hidden" name="precio" id="precio" value="'.$carrito->fields[2].'"> 
             <input type="hidden" name="subtotal" id="subtotal" value="'.$carrito->fields[3].'"> 
             </form>
            </td>
            <td class="text-center" width="20%">$'.$carrito->fields[2].'</td>
            <td class="text-center" width="20%">$'.$carrito->fields[3].'</td>
            <td class="text-center" width="10%">

            <button type="button" class="btn btn-danger" onclick="eliminar('.$carrito->fields[0].')">Eliminar</button>
            <button style="margin-top: 5px;" type="button" class="btn btn-primary" onclick="actualizarCant()">Actualizar</button>
            
            </td>
        </tr>';
       
             $carrito->MoveNext();
        }

        echo $obtenerIteraciones;
    }
?>