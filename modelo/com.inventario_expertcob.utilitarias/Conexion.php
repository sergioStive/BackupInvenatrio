<?php

/**
 * Description of Conexion
 *
 * @author Erick Guzmán
 */
class Conexion {

    private $host = "localhost"; //servidor donde se encuentra la base de datos
    private $user = "inventario_admin"; //usuario de la base de datos
    private $password = "inventario_expertcob_ltda"; //contraseña de la base de datos
    private $db = "CO_Expertcob_Inventario"; //nombre de la base de datos
    private $link = null; //variable que contiene la conexion a la base de datos
    private $smtm = null; //variable que contiene el resultado de la ejecución del Query
    private static $_instance = null; //instancia de la clase

    /**
     *  Constructor de la clase Conexion con acceso private para uso del patron Singleton
     */

    private function __construct() {
        $this->conectar();
    }

    private function __clone() {
        
    }

    /**
     * Método encargado de conectar con la base de datos
     */
    private function conectar() {
        $this->link = mysql_connect($this->host, $this->user, $this->password) or die("No se puede conectar a MySql " . mysql_error());
        mysql_select_db($this->db, $this->link) or die("No existe la base de datos: " . mysql_error());
    }

    /**
     * 
     * @return Conexion
     */
    public static function get_instance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 
     * @param String $query Query a ejecutar en la base de datos
     * @return Variable con el resultado obtenido de la ejecución
     */
    public function ejecutar($query) {
        $this->smtm = mysql_query($query, $this->link) or die("Error en el Query $query " . mysql_error());
        return $this->smtm;
    }

}
