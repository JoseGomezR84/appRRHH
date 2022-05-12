<?php

require_once "controllers/get.controller.php";
$table =  $routesArray = explode("?", $routesArray[2])[0];
$select = $_GET['select'] ?? "*";
$orderBy = $_GET['orderBy'] ?? null;
$orderMode = $_GET['orderMode'] ?? null;
$starAt = $_GET['starAt'] ?? null;
$endAt = $_GET['endAt'] ?? null;
$filterTo = $_GET['filterTo'] ?? null;
$inTo = $_GET['inTo'] ?? null;
$response =  new GetController();

if(isset($_GET['linkTo']) && isset($_GET['equalTo']) && !isset($_GET['rel']) && !isset($_GET['type']))
{
    $response -> getDataFilter($table, $select,$_GET['linkTo'], $_GET['equalTo'], $orderBy, $orderMode, $starAt, $endAt);
}
#peticiones entre tablas relacionadas
else if(isset($_GET['rel']) && isset($_GET['type']) && $table=="relations" && !isset($_GET['linkTo']) && !isset($_GET['equalTo']) && !isset($_GET['search']))
{
    $response -> getRelData($_GET['rel'], $_GET['type'], $select, $orderBy, $orderMode, $starAt, $endAt);
}
else if(isset($_GET['rel']) && isset($_GET['type']) && $table=="relations" && isset($_GET['linkTo']) && isset($_GET['equalTo']))
{
    $response -> getRelDataFilter($_GET['rel'], $_GET['type'], $_GET['linkTo'], $_GET['equalTo'], $select, $orderBy, $orderMode, $starAt, $endAt);
}
#peticiones para buscar
else if(isset($_GET['linkTo']) && isset($_GET['search']) && !isset($_GET['rel']) && !isset($_GET['type']))
{
    $response -> getDataSearch($table, $select,$_GET['linkTo'], $_GET['search'], $orderBy, $orderMode, $starAt, $endAt);
}
else if(isset($_GET['rel']) && isset($_GET['type']) && $table=="relations" && isset($_GET['linkTo']) && isset($_GET['search']))
{
    $response -> getRelDataSearch($_GET['rel'], $_GET['type'], $_GET['linkTo'], $_GET['search'], $select, $orderBy, $orderMode, $starAt, $endAt);
}
else if(!isset($_GET['rel']) && !isset($_GET['type']) && isset($_GET['linkTo']) && isset($_GET['between1'])  && isset($_GET['between2']))
{
    $response -> getDataRange($table,$select,  $_GET['linkTo'], $_GET['between1'], $_GET['between2'], $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo);
}
else if(isset($_GET['rel']) && isset($_GET['type']) && isset($_GET['linkTo']) && isset($_GET['between1'])  && isset($_GET['between2']))
{
    $response -> getRelDataRange($_GET['rel'] ,$_GET['type'] ,$select,  $_GET['linkTo'], $_GET['between1'], $_GET['between2'], $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo);
}
else
{
    $response -> getData($table, $select, $orderBy, $orderMode, $starAt, $endAt);
}



 