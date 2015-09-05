<?php

/**
 * Description of ResponsableDTO
 * Entidad representante de la tabla Responsables en la base de datos 
 *
 * @author Erick Guzmán
 */
class ResponsableDTO extends PersonaDTO {

    public function __construct($numeroDocumento, $nombre, $apellido) {
        parent::__construct($numeroDocumento, $nombre, $apellido);
    }

}
