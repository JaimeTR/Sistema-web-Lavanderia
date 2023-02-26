<?php 

	require_once('includes/parte_superior.php');

?>

<!--Inicio de contenido principal-->
<div class="container">
    <h1 class="icon-eye-outline">Mis reservas</h1>
<br>
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Código reserva</th>
                                    <th>Fecha reserva</th>
                                    <th>Recojo</th>
                                    <th>Envío</th>
                                    <th>Prendas</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                </tr>                                            
                            </thead>
                            <tbody>
                            <?php if(!empty($listaReservas)){
                                foreach ($listaReservas as $key => $value_lr) {
                                    foreach ($value_lr as $v_lr) { ?>
                                <tr>
                                    <td><?php echo $v_lr['codigo_reserva']; ?></td>
                                    <td><?php echo $v_lr['fecha_reserva']; ?></td>
                                    <td><?php echo $v_lr['fecha_recojo']; ?></td>
                                    <td><?php echo $v_lr['fecha_envio']; ?></td>
                                    <td><?php echo $v_lr['descripcion_prenda']; ?></td>
                                    <td><?php echo $v_lr['cantidad_prenda']; ?></td>
                                    <?php if($v_lr['estado_reserva'] == 1){ ?>
                                    <td>Pendiente de recojo</td>
                                    <?php }elseif($v_lr['estado_reserva'] == 2){ ?>
                                    <td>Recepcionado</td>  
                                    <?php }elseif($v_lr['estado_reserva'] == 3){ ?>
                                    <td>Completo</td>
                                    <?php } ?>
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