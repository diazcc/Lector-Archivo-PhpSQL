<?php
//Conexion a la base de datos
class Database
{
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $base_datos = "datosdb";
    public $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_datos);

        if ($this->conexion->connect_error) {
            throw new Exception("Error de conexión: " . $this->conexion->connect_error);
        } else {
        }
    }
    public function cerrarConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
    public function obtenerData($pagina_actual, $resultados_por_pagina)
    {
        $indice_inicial = ($pagina_actual - 1) * $resultados_por_pagina;

        $query = "SELECT * FROM informacion LIMIT $indice_inicial, $resultados_por_pagina";
        $result = $this->conexion->query($query);

        if ($result) {
            $datos = array();
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
            return $datos;
        } else {
            return array();
        }
    }
}
