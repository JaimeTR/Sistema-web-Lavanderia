<?php

if(!empty($_SESSION['active'])){

    class Modelo{

        private $Modelo;

        private $db;

        private $datos;

        public function __construct(){

            $this->Modelo = array();

            $this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess',"root","");

        }

        //Mostrar usuarios

        public function mostrar_usuarios($tabla, $id_usuario){

            $consul="select * from ".$tabla." where ".$id_usuario.";";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                    $this->datos[]=$filas;

            }

            return $this->datos;

        }

        //Nuevo usuario

        public function nuevo_usuario($tabla, $data){

            $consul="insert into ".$tabla." ".$data;

            $resu=$this->db->query($consul);
            
            if($resu){

                return true;

            } else {

                return false;

            }

        }

        //Validar si el nick de usuario se repite en la base de datos

        public function usuario_repetido($tabla, $nick_usuario){

            $consul="select * from ".$tabla." where ".$nick_usuario.";";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)){

                $this->datos[]=$filas;

            }

            return $this->datos;

        }

        //Actualizar usuario

        public function actualizar_usuario($tabla, $data, $id_usuario){

            $consulta="update ".$tabla." set ".$data." where ".$id_usuario.";";

            $resultado=$this->db->query($consulta);

            if ($resultado) {

                return true;

            } else {

                return false;

            }

        }

        //Eliminar usuario

        public function eliminar_usuario($tabla, $data, $id_usuario){

            $consulta = "update ".$tabla." set ".$data." where ".$id_usuario.";";

            $resultado = $this->db->query($consulta);

            if($resultado){

                return true;

            } else {

                return false;

            }

        }

    }

} else {

    header('Location: ../');

}

?>