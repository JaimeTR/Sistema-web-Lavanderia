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
    <h1 class="icon-eye-outline">Lista de cupones de descuento</h1>
<br>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="./descuentos.php?g=nuevo" class="btn btn-success icon-list-add">Nuevo descuento</a>    
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
                                    <th>Código</th>
                                    <th>Porcentaje</th>
                                    <th>Estado</th>
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
                                    <td><?php echo $v['id_descuento']; ?></td>
                                    <td><?php if($v['codigo_descuento'] > 0) { echo $v['codigo_descuento']; } else { echo "Inactivo"; } ?></td>
                                    <td><?php if($v['porcentaje_descuento'] > 0) { echo $v['porcentaje_descuento']." %"; } else { echo "Inactivo"; } ?></td>
                                    <td><?php if($v['estado_descuento'] > 0){ echo "Habilitado"; } elseif($v['estado_descuento'] == 0 ) { echo "Inactivo"; } ?></td>
                                    <td class="contenedor-btn_editar">
                                        <a class="btn_editar" href="descuentos.php?g=editar&id_descuento=<?php echo $v['id_descuento'] ?>"><i class="icon-pencil"></a></td>
                                    <?php if($v['estado_descuento'] == 1){ ?>
                                    <td class="contenedor-btn_eliminar">
                                        <a class="btn_eliminar" onclick="confirmardeshabilitarDescuento(<?php echo $v['id_descuento']; ?>)"><i class="icon-trash"></i></a></td>
                                    <?php } else {
                                        echo "<td></td>";
                                    }?>
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