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
    <h1 class="icon-eye-outline">Lista general de usuarios del sistema</h1>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">     
        <a href="usuarios.php?g=nuevo" class="btn btn-success icon-user-plus">Nuevo usuario</a>    
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
                                    <th class="column-hidden">email</th>
                                    <th class="column-hidden">Celular</th>
                                    <th class="column-hidden">Dirección</th> 
                                    <th class="column-hidden">nick</th>  
                                    <th class="column-hidden">rol</th>
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
                                    <td class="column-hidden"><?php echo $v['nombre_usuario'] ?></td>
                                    <td class="column-hidden"><?php echo $v['apellido_usuario'] ?></td>
                                    <td class="column-hidden"><?php echo $v['email_usuario'] ?></td> 
                                    <td class="column-hidden"><?php echo $v['telefono_usuario'] ?></td>
                                    <td class="column-hidden"><?php echo $v['direccion_usuario'] ?></td>
                                    <td class="column-hidden"><?php echo $v['nick_usuario'] ?></td>
                                    <td class="column-hidden"><?php if($v['rol_usuario'] == 3){
                                        echo "Lavandero";                                     
                                    } elseif($v['rol_usuario'] == 2){
                                        echo "Recepcionista";
                                    } elseif ($v['rol_usuario'] == 1) {
                                        echo "Administrador"; } ?></td>
                                    <td class="column-hidden"><?php if($v['estado_usuario'] == 1){
                                            echo "Activo"; ?></td>
                                    <td class="contenedor-btn_editar"><a class="btn_editar" href="usuarios.php?g=editar&id_usuario=<?php echo $v['id_usuario']?>"><i class="icon-pencil"></i></a></td>                     
                                    <td class="contenedor-btn_eliminar"><a class="btn_eliminar" onclick="confirmareliminarUsuario(<?php echo $v['id_usuario'] ?>)"><i class="icon-trash"></i></a></td>
                                    <?php } elseif($v['estado_usuario'] == 0){
                                                echo "Inhabilitado"; ?>
                                                <td class="contenedor-btn_editar"><a class="btn_editar" href="usuarios.php?g=editar&id_usuario=<?php echo $v['id_usuario']?>"><i class="icon-pencil"></i></a></td>        
                                                <td></td>
                                    <?php } ?></td>  
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