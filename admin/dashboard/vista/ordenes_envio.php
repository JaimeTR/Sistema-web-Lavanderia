<?php   

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <h1 class="icon-eye-outline">Lista general de órdenes de envío</h1>
<br>
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Código reserva</th>
                                    <th class="column-hidden_ordenesenvio">Recepcionista</th>
                                    <th class="column-hidden_ordenesenvio">Fecha envio</th>
                                    <th class="column-hidden_ordenesenvio">Cliente</th>
                                    <th class="column-hidden_ordenesenvio">Apellidos</th>
                                    <th class="column-hidden_ordenesenvio">Dirección</th>
                                    <th class="column-hidden_ordenesenvio">Estado</th>
                                    <th>Acciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($dato)):
                                    foreach($dato as $key => $value)
                                        foreach($value as $v):?>
                                <tr>
                                    <td><?php echo $v['codigo_reserva']; ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php echo $v['nombre_usuario']; ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php echo $v['fecha_envio'] ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php echo $v['nombre_cliente'] ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php echo $v['apellido_cliente'] ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php echo $v['direccion_cliente'] ?></td>
                                    <td class="column-hidden_ordenesenvio"><?php if($v['estado_envio'] == 0){ 
                                        echo "Pendiente de envío";
                                    } elseif($v['estado_envio'] == 1){ 
                                        echo "Enviado";                                      
                                    } ?>                                        
                                    </td>
                                <?php if($_SESSION['rol_usuario'] == 1){ ?>    
                                    <?php if($v['estado_envio'] == 0){ ?>
                                            <td class="contenedor-btn_editar">
                                            <a class="btn_editar" href="ordenes_envio.php?g=editar&id_envio=<?php echo $v['id_envio']; ?>"><i class="icon-pencil"></i></a>
                                            </td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_envio.php?g=detalle_envio&codigo_reserva=<?php echo $v['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                    <?php } elseif($v['estado_envio'] == 1){ ?>
                                            <td>Completo</td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_envio.php?g=detalle_envio&codigo_reserva=<?php echo $v['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                    <?php } ?>
                                <?php } elseif($_SESSION['id_usuario'] == $v['id_usuario']){ ?>    
                                    <?php if($v['estado_envio'] == 0){ ?>
                                            <td class="contenedor-btn_editar">
                                                <a class="btn_editar" href="ordenes_envio.php?g=editar&id_envio=<?php echo $v['id_envio']; ?>"><i class="icon-pencil"></i></a>
                                            </td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_envio.php?g=detalle_envio&codigo_reserva=<?php echo $v['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                    <?php } elseif($v['estado_envio'] == 1){ ?>
                                            <td>Completo</td>
                                            <td class="contenedor-btn_detalle">
                                            <a class="btn_detalle" href="ordenes_envio.php?g=detalle_envio&codigo_reserva=<?php echo $v['codigo_reserva']; ?>"><i class="icon-search"></i></a></td>
                                    <?php } ?>
                                <?php } else { ?>
                                        <td>Sin opción</td>
                                        <td>Sin opción</td>
                                <?php } ?>
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