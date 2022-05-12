<?php
require_once "connection.php";

class GetModel
{
    static public function getData($table, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        if(empty(Connection::getColumnsData($table))){
            return null;
        }
        $sql = "SELECT $select FROM $table";
        if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
        {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
        }
        if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
        }
        if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table LIMIT $starAt, $endAt";
        }
        $stmt = Connection::connect()->prepare($sql);
        $stmt ->execute();

        return $stmt ->fetchAll(PDO::FETCH_CLASS);
    }


    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $starAt, $endAt)
    {
        $linkToArray = explode(',', $linkTo);
        $linkToText = "";

        $equalToArray = explode('_', $equalTo);

        if(count($linkToArray) > 1)
        {
            foreach($linkToArray as $key => $value)
            {
                if($key > 0){
                    $linkToText.="AND ".$value." = :".$value." ";
                }
            }
        }

        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

        if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
        }
        if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
        }
        if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText  LIMIT $starAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);
        
        foreach($linkToArray as $key => $value)
        {
            $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);
        }
        $stmt ->execute();

        return $stmt ->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);

        $innerJoinText = "";
        if(count($relArray) > 1)
        {
            foreach($relArray as $key => $value)
            {
                if($key > 0){
                    $innerJoinText.="INNER JOIN " . $value . " ON "  . $relArray[0] . ".id_".$typeArray[$key]."_".$typeArray[0] ."=". $value.".id_".$typeArray[$key]." ";
                }
            }
        
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText";
            
            if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode";
            }
            if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
            }
            if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText $starAt, $endAt";
            }
            $stmt = Connection::connect()->prepare($sql);
            $stmt ->execute();

            return $stmt ->fetchAll(PDO::FETCH_CLASS);
        }
        else 
        {
            return null;
        }
    }
    static public function getRelDataFilter($rel, $type, $linkTo, $equalTo, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $linkToArray = explode(',', $linkTo);
        $linkToText = "";

        $equalToArray = explode('_', $equalTo);

        if(count($linkToArray) > 1)
        {
            foreach($linkToArray as $key => $value)
            {
                if($key > 0){
                    $linkToText.="AND ".$value." = :".$value." ";
                }
            }
        }
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);

        $innerJoinText = "";
        if(count($relArray) > 1)
        {
            foreach($relArray as $key => $value)
            {
                if($key > 0){
                    $innerJoinText.="INNER JOIN " . $value . " ON "  . $relArray[0] . ".id_".$typeArray[$key]."_".$typeArray[0] ."=". $value.".id_".$typeArray[$key]." ";
                }
            }
        
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";
            
            if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
            }
            if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
            }
            if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM  $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $starAt, $endAt";
            }
            $stmt = Connection::connect()->prepare($sql);
            foreach($linkToArray as $key => $value)
            {
            $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);
            }
            $stmt ->execute();

            return $stmt ->fetchAll(PDO::FETCH_CLASS);
        }
        else 
        {
            return null;
        } 
    }
    static public function getDataSearch($table,$select, $linkTo, $search, $orderBy, $orderMode, $starAt, $endAt)
    {
        $linkToArray = explode(',', $linkTo);
        $linkToText = "";

        $searchToArray = explode('_', $search);

        if(count($linkToArray) > 1)
        {
            foreach($linkToArray as $key => $value)
            {
                if($key > 0){
                    $linkToText.="AND ".$value." = :".$value." ";
                }
            }
        }
        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText";
        if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode";
        }
        if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
        }
        if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText LIMIT $starAt, $endAt";
        }
        $stmt = Connection::connect()->prepare($sql);
        foreach($linkToArray as $key => $value)
            {
                if($key > 0)
                {
                    $stmt -> bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
                }
            
            }
        $stmt ->execute();

        return $stmt ->fetchAll(PDO::FETCH_CLASS);
    }
    static public function getRelDataSearch($rel, $type, $linkTo, $search, $select, $orderBy, $orderMode, $starAt, $endAt)
    {
        $linkToArray = explode(',', $linkTo);
        $linkToText = "";

        $searchToArray = explode('_', $search);

        if(count($linkToArray) > 1)
        {
            foreach($linkToArray as $key => $value)
            {
                if($key > 0){
                    $linkToText.="AND ".$value." = :".$value." ";
                }
            }
        }
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);

        $innerJoinText = "";
        if(count($relArray) > 1)
        {
            foreach($relArray as $key => $value)
            {
                if($key > 0){
                    $innerJoinText.="INNER JOIN " . $value . " ON "  . $relArray[0] . ".id_".$typeArray[$key]."_".$typeArray[0] ."=". $value.".id_".$typeArray[$key]." ";
                }
            }
        
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText";
            
            if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode";
            }
            if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
            }
            if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM  $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText LIMIT $starAt, $endAt";
            }
            $stmt = Connection::connect()->prepare($sql);
            foreach($linkToArray as $key => $value)
            {
                if($key > 0)
                {
                    $stmt -> bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);
                }
            
            }
            $stmt ->execute();

            return $stmt ->fetchAll(PDO::FETCH_CLASS);
        }
        else 
        {
            return null;
        } 
    }
    static public function getDataRange($table,$select, $linkTo, $between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo)
    {
        $filter = "";
        if($filterTo != null && $inTo != null)
        {
            $filter = 'AND '. $filterTo .' IN ('.$inTo.')';
        }
        $sql = "SELECT $select FROM $table WHERE $linkTo BETWEEN '$between1' AND '$between2'  $filter";
        if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkTo BETWEEN '$between1' $filter AND '$between2' ORDER BY $orderBy $orderMode";
        }
        if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkTo BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
        }
        if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
        {
            $sql = "SELECT $select FROM $table WHERE $linkTo BETWEEN '$between1' AND '$between2' $filter LIMIT $starAt, $endAt";
        }
      
        $stmt = Connection::connect()->prepare($sql);
        $stmt ->execute();

        return $stmt ->fetchAll(PDO::FETCH_CLASS);

    }

    static public function getRelDataRange($rel, $type,$select, $linkTo, $between1, $between2, $orderBy, $orderMode, $starAt, $endAt, $filterTo, $inTo)
    {
        $filter = "";
        if($filterTo != null && $inTo != null)
        {
            $filter = 'AND '. $filterTo .' IN ('.$inTo.')';
        }
        $relArray = explode(',', $rel);
        $typeArray = explode(',', $type);
        $innerJoinText = "";


        if(count($relArray) > 1)
        {
            foreach($relArray as $key => $value)
            {
                if($key > 0){
                    $innerJoinText.="INNER JOIN " . $value . " ON "  . $relArray[0] . ".id_".$typeArray[$key]."_".$typeArray[0] ."=". $value.".id_".$typeArray[$key]." ";
                }
            }
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkTo BETWEEN '$between1' AND '$between2'  $filter";
            if($orderBy != null && $orderMode != null && $starAt == null && $endAt == null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkTo BETWEEN '$between1' $filter AND '$between2' ORDER BY $orderBy $orderMode";
            }
            if($orderBy != null && $orderMode != null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkTo BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode LIMIT $starAt, $endAt";
            }
            if($orderBy == null && $orderMode == null && $starAt != null && $endAt != null)
            {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkTo BETWEEN '$between1' AND '$between2' $filter LIMIT $starAt, $endAt";
            }
        
            $stmt = Connection::connect()->prepare($sql);
            $stmt ->execute();

            return $stmt ->fetchAll(PDO::FETCH_CLASS);
        }
        else{
            return null;
        }
        

    }
}