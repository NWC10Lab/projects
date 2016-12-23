<?php


class Lead {
    
    private $id, $nombre, $apellidos, $email, $dni,$telefono ,$empresa; 

    
    function __construct($id, $nombre, $apellidos, $email, $dni,$telefono ,$empresa) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->empresa = $empresa;
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getDni() {
        return $this->dni;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmpresa() {
        return $this->empresa;
    }
    function imprimirDatosTabla(){
        $filaLeads= '<tr class="gradeX" >    
                                <td>'.$this->nombre.'</td>
                                <td>'.$this->apellidos.'</td>
                                <td>'.$this->email.'</td>
                                <td>'.$this->dni.'</td>
                                <td>'.$this->telefono.'</td>
                                <td>'.$this->empresa.'</td>
                                <td class="right">
                                    <a href="" class="btn btn-success btn-xs"><i class="fa fa-envelope"></i></a> 
                                    <a class="btn btn-danger btn-xs" href=""> <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            ';
    }

    
    
    
}


