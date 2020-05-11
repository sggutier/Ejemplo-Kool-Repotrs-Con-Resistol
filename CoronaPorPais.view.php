<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\GeoChart;
?>
<div class='report-content'>
    <div class="text-center">
        <h1>Reporte de COVID-19</h1>
        <p class="lead">Casos confirmados, muertes, y recuperados país</p>
    </div>

    <div class="row">
        <div class="col-lg-4">
    <?php
    GeoChart::create(array(
        "dataStore"=>$this->dataStore("casos"),
        "columns"=>array(
            "iso2"=>array(
                "label"=>"País"
            ),
            "confirmados"=>array(
                "label"=>"Casos Confirmados",
                "type"=>"number",
                "prefix"=>""
            ),
        ),
        "width"=>"100%",
        "options"=>array(
            "showTooltip"=> true,
            "showInfoWindow"=> true,
            "colorAxis" => ["colors"=> ['white', 'yellow']]
        )
    ));
    ?>
            <p class="lead">Confirmados</p>
        </div>

        <div class="col-lg-4">
            <?php
            GeoChart::create(array(
                "dataStore"=>$this->dataStore("casos"),
                "columns"=>array(
                    "iso2"=>array(
                        "label"=>"País"
                    ),
                    "muertes"=>array(
                        "label"=>"Muertes",
                        "type"=>"number",
                        "prefix"=>""
                    ),
                ),
                "width"=>"100%",
                "options"=>array(
                    "showTooltip"=> true,
                    "showInfoWindow"=> true,
                    "colorAxis" => ["colors"=> ['white', 'red']]
                )
            ));
            ?>
            <p class="lead">Muertes</p>
        </div>

        <div class="col-lg-4">
            <?php
            GeoChart::create(array(
                "dataStore"=>$this->dataStore("casos"),
                "columns"=>array(
                    "iso2"=>array(
                        "label"=>"País"
                    ),
                    "recuperados"=>array(
                        "label"=>"Recuperados",
                        "type"=>"number",
                        "prefix"=>""
                    ),
                ),
                "width"=>"100%",
                "options"=>array(
                    "showTooltip"=> true,
                    "showInfoWindow"=> true,
                    "colorAxis" => ["colors"=> ['white', 'green']]
                )
            ));
            ?>
            <p class="lead">Recuperados</p>
        </div>
    </div>

    <?php
    Table::create(array(
        "dataStore"=>$this->dataStore("casos")->sort(array("confirmados"=>"desc")),
        "columns"=>array(
            "nombre"=>array(
                "label"=>"País"
            ),
            "confirmados"=>array(
                "label"=>"Casos confirmados",
                "type"=>"number",
                "prefix"=>"",
            ),
            "muertes"=>array(
                "label"=>"Muertes",
                "type"=>"number",
                "prefix"=>"",
            ),
            "recuperados"=>array(
                "label"=>"Recuperados",
                "type"=>"number",
                "prefix"=>"",
            )
        ),
        "paging"=>array(
            "pageSize"=>10,
        ),
        "cssClass"=>array(
            "table"=>"table table-bordered table-striped"
        )
    ));
    ?>
</div>
