<?php 

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 2){

        header('Location: reservas.php');

    } elseif($_SESSION['rol_usuario'] == 3){

        header('Location: ordenes_delivery.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <h1 class="icon-eye-outline">Lista general de servicios</h1>
    <br> 
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="./servicios.php?g=nuevo" class="btn btn-success icon-crown-plus">Nuevo servicio</a>
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
                                    <th>Prenda</th>
                                    <th class="column-hidden_servicio">Precio</th>   
                                    <th class="column-hidden_servicio">Estado</th>                             
                                    <th>Acción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($dato)):
                                    foreach($dato as $key => $value)
                                        foreach($value as $v):?>
                                <tr>
                                    <td><?php echo $v['id_servicio']; ?></td>
                                    <td><?php echo $v['descripcion_prenda']; ?></td>
                                    <td class="column-hidden_servicio"><?php echo "S/. ".$v['precio_uni_prenda'];?></td>
                                    <td class="column-hidden_servicio"><?php if($v['estado_servicio'] == 0){
                                        echo "Inactivo"; ?>
                                        <td class="contenedor-btn_editar"><a class="btn_editar" href="servicios.php?g=editar&id_servicio=<?php echo $v['id_servicio'] ?>"><i class="icon-pencil"></a></td>
                                        <td></td>
                                    <?php } elseif($v['estado_servicio'] == 1){
                                        echo "Activo"; ?>
                                        <td class="contenedor-btn_editar"><a class="btn_editar" href="servicios.php?g=editar&id_servicio=<?php echo $v['id_servicio'] ?>"><i class="icon-pencil"></a></td>
                                        <td class="contenedor-btn_eliminar"><a class="btn_eliminar" onclick="confirmardeshabilitarServicio(<?php echo $v['id_servicio']; ?>)"><i class="icon-trash"></i></a></td>
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