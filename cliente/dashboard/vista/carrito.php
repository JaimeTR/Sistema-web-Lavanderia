<?php 
    require_once('includes/parte_superior.php');
?>
<?php

    // Utilidades

    $stats = array(

        'count' => 0,
        'total_servicios' => 0,
        'total' => 0

    );

    if(isset($_SESSION['carrito'])){

        $stats['count'] = count($_SESSION['carrito']);

        foreach($_SESSION['carrito'] as $service){

        $stats['total'] += $service['precio_uni_prenda'] * $service['cantidad'];

        $stats['total_servicios'] += $service['cantidad'];

        }

    } else {

        echo "";
        
    }

?>  
<!--Inicio de contenido principal-->
</script>
<div class="container">
    <h1 class="icon-basket-alt">Mi carrito de compras</h1>
    <br>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">     
            <a href="servicios.php" class="btn btn-success icon-left-big">Continuar (<?php echo $stats['count'] ?>)</a>
            <a href="servicios.php?g=eliminar_carrito" class="btn btn-success icon-trash">Vacear mi carrito</a>   
         </div>    
    </div>
</div>
<br>
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">   
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Aumentar</th>
                                    <th>Disminuir</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php if(!empty($_SESSION['carrito'])){
                                    foreach ($_SESSION['carrito'] as $indice => $value_car) { ?>
                                <tr>
                                    <td><?php echo $value_car['descripcion_prenda']; ?></td>
                                    <td><?php echo 'S/. '.$value_car['precio_uni_prenda']; ?></td>
                                    <td><?php echo $value_car['cantidad']; ?></td>
                                    <td><?php echo 'S/. '.$value_car['precio_uni_prenda'] ?></td>
                                    <td class="contenedor-btn_editar">
                                        <a class="btn_editar" href="servicios.php?g=up&indice=<?php echo $indice ?>"><i class="icon-up-big"></i></a>
                                    </td> 
                                    <td class="contenedor-btn_detalle">
                                        <a class="btn_detalle" href="servicios.php?g=down&indice=<?php echo $indice ?>"><i class="icon-down-open"></i></a>
                                    </td> 
                                    <td class="contenedor-btn_eliminar">
                                        <a class="btn_eliminar" href="servicios.php?g=delete&indice=<?php echo $indice ?>"><i class="icon-trash"></i></a>
                                    </td>
                                </tr><?php
                                    }                                                                       
                                }
                            ?>
                                <tbody class="filatotales_carrito"> 
                                    <tr>
                                        <form method="GET">                
                                            <td>Código de descuento: 
                                                <input type="number" name="codigodescuento" placeholder="Código">
                                            </td>
                                            <td>Totales</td>
                                            <td><?php echo $stats['total_servicios']; ?></td>
                                            <td><?php echo 'S/. '.$stats['total'].'.00' ?></td>
                                            <td colspan="3" align="center" class="container-btnconfimarCarrito">
                                                <input type="submit" class="container-btnconfimarCarrito_item" value="Continuar la compra" name="btnConfirmar">
                                                <input type="hidden" name="g" value="confirmar">
                                            </td>
                                        </form>                  
                                    </tr>
                                </tbody>
                            </tbody>
                        </table>          
                    </div>
                </div>
            </div>  
        </div>                      
<?php
    require_once('includes/parte_inferior.php');
?>