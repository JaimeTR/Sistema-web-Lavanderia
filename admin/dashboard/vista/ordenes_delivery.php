<?php   

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <h1 class="icon-basket-1">Lista general de órdenes de delivery</h1>   
<br> 
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Reserva</th>
                                    <th class="column-hidden_ordenesdelivery">Recepcionista</th>
                                    <th class="column-hidden_ordenesdelivery">Recojo</th>
                                    <th class="column-hidden_ordenesdelivery">Envío</th>
                                    <th class="column-hidden_ordenesdelivery">Estado</th>
                                    <th>Acciones</th>
                                    <?php if($_SESSION['rol_usuario'] == 3){
                                    echo ""; ?>
                                    <?php } else { ?>
                                        <th>Acciones</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($ordenes_delivery)):
                                    foreach($ordenes_delivery as $key => $v_ordenes_delivery)
                                        foreach($v_ordenes_delivery as $vd):?>
                                <tr>
                                    <td><?php echo $vd['codigo_reserva'] ?></td>
                                    <td class="column-hidden_ordenesdelivery"><?php echo $vd['nombre_usuario'] ?></td>
                                    <td class="column-hidden_ordenesdelivery"><?php echo $vd['fecha_recojo'] ?></td>
                                    <td class="column-hidden_ordenesdelivery"><?php echo $vd['fecha_envio'] ?></td>
                                    <td class="column-hidden_ordenesdelivery"><?php if($vd['estado_delivery'] == 0){ 
                                        echo "Pendiente de recojo";
                                    } elseif($vd['estado_delivery'] == 1){ 
                                        echo "Recojido y en proceso de lavado"; 
                                    } elseif($vd['estado_delivery'] == 2){
                                        echo "Lavado y sin orden de envío";
                                    } elseif($vd['estado_delivery'] == 3){
                                        echo "Con orden de envío";
                                    } ?></td>
                                    <?php if($_SESSION['rol_usuario'] == 1){ ?>
                                        <?php if($vd['estado_delivery'] == 0 || $vd['estado_delivery'] == 1 || $vd['estado_delivery'] == 2){ ?>
                                            <td class="contenedor-btn_editar">
                                            <a class="btn_editar" href="ordenes_delivery.php?g=editar&id_delivery=<?php echo $vd['id_delivery']?>"><i class="icon-pencil"></i></a></td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_delivery.php?g=detalle_orden_delivery&codigo_reserva=<?php echo $vd['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                        <?php } elseif($vd['estado_delivery'] == 3){?>
                                            <td>Completo</td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_delivery.php?g=detalle_orden_delivery&codigo_reserva=<?php echo $vd['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                        <?php } 
                                    } elseif($_SESSION['rol_usuario'] == 3){ ?>
                                        <?php if($vd['estado_delivery'] == 0){ ?>
                                            <td>Sin opción</td>
                                        <?php } elseif($vd['estado_delivery'] == 1 || $vd['estado_delivery'] == 2){ ?>
                                            <td class="contenedor-btn_editar">
                                            <a class="btn_editar" href="ordenes_delivery.php?g=editar&id_delivery=<?php echo $vd['id_delivery']?>"><i class="icon-pencil"></i></a></td>
                                        <?php } elseif($vd['estado_delivery'] == 3){ ?>
                                            <td>Completo</td>
                                        <?php }
                                    } elseif($_SESSION['id_usuario'] != $vd['id_usuario']){ ?>
                                        <?php if($vd['estado_delivery'] == 0){ ?>
                                            <td>Sin opción</td>
                                            <td>Sin opción</td>
                                        <?php } elseif($vd['estado_delivery'] == 1 || $vd['estado_delivery'] == 2 || $vd['estado_delivery'] == 3){ ?>
                                            <td>Sin opción</td>
                                            <td>Sin opción</td>
                                        <?php }
                                    } elseif($_SESSION['id_usuario'] == $vd['id_usuario']){ ?>
                                        <?php if($vd['estado_delivery'] == 0 || $vd['estado_delivery'] == 1 || $vd['estado_delivery'] == 2){ ?>
                                            <td class="contenedor-btn_editar">
                                            <a class="btn_editar" href="ordenes_delivery.php?g=editar&id_delivery=<?php echo $vd['id_delivery']?>"><i class="icon-pencil"></i></a></td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_delivery.php?g=detalle_orden_delivery&codigo_reserva=<?php echo $vd['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                        <?php } elseif($vd['estado_delivery'] == 3){?>
                                            <td>Completo</td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_delivery.php?g=detalle_orden_delivery&codigo_reserva=<?php echo $vd['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                        <?php }
                                    } ?>
                                </tr>   
                                <?php endforeach; ?>
                            <?php else: ?>                           
                            </tbody>   
                            <?php endif ?>     
                       </table>                    
                    </div>
                </div>
            </div>  
        </div>             
    </div>
<!--FIN del cont principal-->
<?php require_once "includes/parte_inferior.php"?>
<?php } ?>