<?php
require_once __DIR__ . '/vendor/autoload.php';

class CoronaPorPais extends \koolreport\KoolReport
{
    // Descomentar linea de abajo despues de comprar version pagada
    // use \koolreport\export\Exportable;

    public function settings()
    {
        $this->dia = date('Y-m-d H:i:s');
        return array(
            "dataSources" => array(
                "coronachan" => array(
                "connectionString" => "mysql:host=localhost;dbname=coronachan",
                "username" => "root",
                "password" => "root",
                "charset" => "utf8"
                )
            )
        );
    }

    public function setup()
    {
        $this->src('coronachan')
            ->query("
            select p.clave_pais, rd.confirmados, rd.muertes, rd.recuperados, p.iso2, p.nombre
            from paises as p join registro_dia rd on p.clave_pais = rd.clave_pais
            where date(rd.fecha) = (select max(date(fecha)) from registro_dia where date(fecha) < date('{$this->dia}'));
        ")
            ->pipe($this->dataStore("casos"));
    }
}
