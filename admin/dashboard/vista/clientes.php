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
    <h1 class="icon-eye-outline">Listado de clientes</h1>
<br>
<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <a href="./clientes.php?g=nuevo" class="btn btn-success icon-user-add">Nuevo cliente</a>    
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
                                    <th class="column-hidden">Nombre</th>
                                    <th class="column-hidden">Apellido</th>                                
                                    <th class="column-hidden">Email</th> 
                                    <th class="column-hidden">Celular</th> 
                                    <th class="column-hidden">Dirección</th>
                                    <th class="column-hidden">Nick</th>  
                                    <th class="column-hidden">Tipo</th>
                                    <th class="column-hidden">Estado</th>
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
                                    <td class="column-hidden"><?php echo $v['nombre_cliente'] ?></td>
                                    <td class="column-hidden"><?php echo $v['apellido_cliente'] ?></td>
                                    <td class="column-hidden"><?php echo $v['email_cliente'] ?></td>
                                    <td class="column-hidden"><?php echo $v['telefono_cliente'] ?></td> 
                                    <td class="column-hidden"><?php echo $v['direccion_cliente'] ?></td>
                                    <td class="column-hidden"><?php echo $v['usuario_cliente']; ?></td>
                                    <td class="column-hidden"><?php if($v['tipo_cliente'] == 1){
                                        echo "Socio";
                                    } elseif($v['tipo_cliente'] == 2){
                                        echo "Cliente";
                                    } ?></td>
                                    <td class="column-hidden"><?php if($v['estado_cliente'] == 0){
                                                echo "Inhabilitado"; ?>
                                                <td class="contenedor-btn_editar"><a class="btn_editar" href="clientes.php?g=editar&id_cliente=<?php echo $v['id_cliente']?>"><i class="icon-pencil"></a></td>
                                                <td></td>
                                    <?php } elseif($v['estado_cliente'] == 1){
                                                echo "Activo"; ?>
                                                <td class="contenedor-btn_editar"><a class="btn_editar" href="clientes.php?g=editar&id_cliente=<?php echo $v['id_cliente']?>"><i class="icon-pencil"></a></td>
                                                <td class="contenedor-btn_eliminar"><a class="btn_eliminar" onclick="confirmareliminarCliente(<?php echo $v['id_cliente']; ?>)"><i class="icon-trash"></i></a></td></td>
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