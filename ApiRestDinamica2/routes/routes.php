<?php
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

if(count($routesArray) == 1){
    $json = array(
        'status'=>404,
        'result'=> 'not found'
    );
    echo json_encode($json, http_response_code($json['status']));
    return;
}

if(count($routesArray) == 2 && isset($_SERVER['REQUEST_METHOD']))
{
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        include "services/get.php";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $json = array(
            'status'=>200,
            'result'=> 'solicitud post'
        );
        echo json_encode($json, http_response_code($json['status']));
    }

    if($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        $json = array(
            'status'=>200,
            'result'=> 'solicitud put'
        );
        echo json_encode($json, http_response_code($json['status']));
    }

    if($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        $json = array(
            'status'=>200,
            'result'=> 'solicitud delete'
        );
        echo json_encode($json, http_response_code($json['status']));
    }
     
}


