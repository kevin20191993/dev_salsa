<?php

class conexion {

    public $host;
    public $user;
    public $pass;
    public $dbName;
    public $db;

    public function __construct() {
        //abrimos la conexion
        $this->host = 'localhost';
        $this->user = 'base';
        $this->pass = 'base';
        $this->dbName = 'exam';
        $this->db = mysqli_connect($this->host, $this->user, $this->pass, $this->dbName);
        if ($this->db) {
            //echo "Conexión abierta exitosamente";
        } else {
            //echo "Falló la conexión en el archivo config2.php";
        }
        return $this->db;
    }

    public function cerrar_conexion($db) {
        //cerramos la conexion
        if ($db) {
            $db->close();
        }
    }
    
    public function actualiza_pass($id,$new,$tabla) {
        $sql="UPDATE ".$tabla." SET password='".$new."' WHERE id=".$id;
        
        return $this->db->query($sql);
    }

    public function insert_inicia($datos, $tabla) {
        //sacamos los datos
        $flag = 0;
        
        $sql_insert = "INSERT INTO " . $tabla;
        if (is_array($datos)) {
            foreach ($datos as $key => $dat) {
                if ($flag == 0) {
                    //$sql .= $key . "=" . "'$dat'";
                    $sql_insert .= " SET " . $key . "=" . "'$dat'";
                } else {
                    //$sql .= " AND " . $key . "=" . "'$dat'";
                    $sql_insert .= " , " . $key . "=" . "'$dat'";
                }
                $flag = 1;
            }
        }
        if (isset($datos["username"])&&isset($datos["email"])) {
            $sql = "SELECT *FROM " . $tabla . " WHERE username='".$datos["username"]."' OR email='" . $datos["email"]."'";
            
        } else {
            $sql = '';
        }
        $res_sql = $this->db->query($sql);

        if ($res_sql) {
            $val = mysqli_fetch_array($res_sql);
            if (isset($val["id"])) {
                return "Este usuario ya existe";
            } else {
                //Insertamos el usuario
                $res_sql = $this->db->query($sql_insert);
                if ($res_sql) {
                    return "Usuario registrado correctamente";
                } else {
                    return "Error al registrar el usuario";
                }
            }
        } else {
            //Insertamos el usuario
            $res_sql = $this->db->query($sql_insert);
            if ($res_sql) {
                return "Usuario registrado correctamente";
            } else {
                return "Error al registrar el usuario";
            }
        }
        $this->cerrar_conexion($db);
    }

    public function inicia_sesion($datos, $tabla) {

        //arreglo para devolver datos de sesion
        $datos_sesion = array();
        //sacamos los datos
        $flag = 0;

        $sql = "SELECT *FROM " . $tabla . " WHERE ";
        if (is_array($datos)) {
            foreach ($datos as $key => $dat) {
                if ($flag == 0) {
                    $sql .= $key . "=" . "'$dat'";
                } else {
                    $sql .= " AND " . $key . "=" . "'$dat'";
                }
                $flag = 1;
            }
        }
        //verificamos que los datos sean correctos
        $res_sql = $this->db->query($sql);

        if ($res_sql) {
            $val = mysqli_fetch_array($res_sql);
            if (isset($val["id"])) {
                $datos_sesion["id"] = $val["id"];
                $datos_sesion["username"] = $val["username"];
                $datos_sesion["email"] = $val["email"];

                return $datos_sesion;
            } else {
                //Insertamos el usuario
                return false;
            }
        } else {
            return false;
        }
        
        $this->cerrar_conexion($db);
    }

}
