<?php  

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 3){

        header('Location: ordenes_delivery.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <h1 class="icon-eye-outline">Lista general de reservas</h1> 
<br>   
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Código</th>
                                    <th class="column-hidden_reservas">Reserva</th>
                                    <th class="column-hidden_reservas">Recojo</th>
                                    <th class="column-hidden_reservas">Envío</th>
                                    <th class="column-hidden_reservas">Cliente</th>
                                    <th class="column-hidden_reservas">Dirección</th>                                
                                    <th class="column-hidden_reservas">Prenda</th>  
                                    <th class="column-hidden_reservas">Cupón</th>  
                                    <th class="column-hidden_reservas">Cantidad</th>
                                    <th class="column-hidden_reservas">Total</th>
                                    <th class="column-hidden_reservas">Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($dato)):
                                    foreach($dato as $key => $value)
                                        foreach($value as $v):?>
                                <tr>
                                    <td><?php echo $v['codigo_reserva'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['fecha_reserva'] ?></td>  
                                    <td class="column-hidden_reservas"><?php echo $v['fecha_recojo'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['fecha_envio'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['nombre_cliente'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['direccion_cliente'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['descripcion_prenda']; ?></td>
                                    <td class="column-hidden_reservas"><?php if ($v['id_descuento'] > 0) {
                                        echo $v['porcentaje_descuento']." %";
                                    } else {
                                        echo"No hay";
                                    } ?></td>
                                    <td class="column-hidden_reservas"><?php echo $v['cantidad_prenda'] ?></td>
                                    <td class="column-hidden_reservas"><?php echo "S/. ".$v['total_carrito'].".00" ?></td>
                                    <td class="column-hidden_reservas">
                                    <?php if($v['estado_reserva'] == 3){
                                        echo "Completo";
                                    } elseif($v['estado_reserva'] == 2){
                                        echo "Recepcionado";
                                    } elseif($v['estado_reserva'] == 1) {
                                        echo "Pendiente";
                                    } elseif($v['estado_reserva'] == 0 ){
                                        echo "Inhabilitado";
                                    } ?></td>
                                    <td class="contenedor-btn_editar">
                                        <a class="btn_editar" href="reservas.php?g=editar&id_reserva=<?php echo $v['id_reserva'] ?>"><i class="icon-pencil"></a></td>
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