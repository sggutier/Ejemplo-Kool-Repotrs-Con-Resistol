<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\GeoChart;
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Pagina con reportes del coronavirus :v">
    <meta name="author" content="German Gutierrez">
    <meta name="keywords" content="php reportes framework">
    <title>Reporte de Coronavirus</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>
<body>
<html>
    <div class="text-center">
        <h1>Reporte de COVID-19</h1>
        <h4>Casos confirmados, muertes, y recuperados país</h4>
    </div>

    <hr/>

    <div class="row">
        <div class="col-12">
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

        <div class="col-12">
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

        <div class="col-12">
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
        "cssClass"=>array(
            "table"=>"table table-bordered table-striped"
        )
    ));
    ?>
</body>
</html>