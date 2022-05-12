<?php
require_once "models/get.model.php";
class GetController
{
    static public function getData($table,$select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getData($table, $select, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);
    }

    static public function getDataFilter($table,$select, $linkTo, $equalTo, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        
        $return -> fncResponse($response);
    }
    
    static public function getRelData($rel, $type ,$select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);
    }

    static public function getRelDataFilter($rel, $type , $linkTo, $equalTo, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getRelDataFilter($rel, $type, $linkTo, $equalTo, $select, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);
    }

    static public function getDataSearch($table,$select, $linkTo, $search, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        
        $return -> fncResponse($response);
    }


    static public function getRelDataSearch($rel, $type, $linkTo, $search, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $response = GetModel::getRelDataSearch($rel, $type, $linkTo, $search, $select, $orderBy, $orderMode, $starAt, $endAt);
        $return = new GetController();
        
        $return -> fncResponse($response);
    }

    static public function getDataRange($table,$select, $linkTo,$between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo)
    {
        
        $response = GetModel::getDataRange($table,$select, $linkTo, $between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo);
        $return = new GetController();
        
        $return -> fncResponse($response);
    }

    static public function getRelDataRange($rel, $type,$select, $linkTo,$between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo)
    {
        
        $response = GetModel::getRelDataRange($rel, $type,$select, $linkTo, $between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo);
        $return = new GetController();
        
        $return -> fncResponse($response);
    }

    // Se encarga de validar si hay datos y devolver la respuesta en formato json
    public function fncResponse($response)
    {
        if(!empty($response))
        {
            $json = array(
                'status'=>200,
                'Total' => count($response),
                'result'=> $response
            );
        }
        else
        {
            $json = array(
                'status'=>404,
                'result'=> 'not found'
            );
        }
        
        echo json_encode($json, http_response_code($json['status']));
    }
}