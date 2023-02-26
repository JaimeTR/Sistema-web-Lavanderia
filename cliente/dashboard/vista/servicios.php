<?php

    require_once('includes/parte_superior.php'); 

    require_once('includes/parte_superior.php');

    //Utilidades

    $stats = array(

        'count' => 0

    );

    if(isset($_SESSION['carrito'])){

        $stats['count'] = count($_SESSION['carrito']);

    }

?>  
<!--Inicio de contenido principal-->
</script>
<div class="container">
    <h1 class="icon-login">Servicios de lavandería</h1>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">     
            <a href="servicios.php?g=carrito" class="btn btn-success icon-basket">Ver mi carrito (<?php echo $stats['count']; ?>)</a>    
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
                                    <th>Id</th>
                                    <th>Descripción</th>
                                    <th>Precio unitario</th>
                                    <th>Acción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>                                
                        <?php if(!empty($listado_servicios)){
                                foreach ($listado_servicios as $key => $value_ls) {
                                    foreach ($value_ls as $v_ls) { ?>
                                    <tr>
                                        <td><?php echo $v_ls['id_servicio']; ?></td>
                                        <td><?php echo $v_ls['descripcion_prenda']; ?></td>
                                        <td><?php echo 'S/. '.$v_ls['precio_uni_prenda']; ?></td>
                                        <td class="contenedor-btn_editar">
                                        <a class="btn_editar" href="servicios.php?g=agregar&id_servicio=<?php echo $v_ls['id_servicio']; ?>"><i class="icon-basket"></i></a></td>
                                        <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="servicios.php?g=ver_detalle&id_servicio=<?php echo $v_ls['id_servicio']; ?>"><i class="icon-eye-outline"></i></a>
                                        </td>
                                    </tr>                                               
                                        <?php 
                                    }
                                }
                            }
                        ?>
                            </tbody>
                        </table>                    
                    </div>
                </div>
            </div>  
        </div>             
    </div>                                
<?php
    require_once('includes/parte_inferior.php');
?>