<?php


class BiciElectrica
{
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)

    public function __construct(int $id, int $coordx, int $coordy, int $bateria, int $operativa)
    {
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->bateria = $bateria;
        $this->operativa = $operativa;

    }



     // Método mágico para obtener el valor de una propiedad
     public function __get($nombre) 
     {
        if (property_exists($this, $nombre)) {
            return $this->$nombre;
        } else {
            throw new Exception("La propiedad '$nombre' no existe.");
        }
    }

    // Método mágico para asignar el valor a una propiedad
    public function __set($nombre, $valor) 
    {
        if (property_exists($this, $nombre)) {
            $this->$nombre = $valor;
        } else {
            throw new Exception("La propiedad '$nombre' no existe.");
        }
    }

    public function __toString() 
    {
        return "Id: $this->id , Batería: $this->bateria%";
    }

    public function distancia($x,$y)
    {
        $distancia = sqrt(pow(($x - $this->coordx), 2) + pow(($y - $this->coordy), 2));
        return $distancia;
    }

}
