<?php 
    function validation($stack){
        $tempArr=[];
        foreach ($stack as $key => $value) {
            if(empty($value)){
                $tempArr[] = 'ERROR: '.$key.' is required';
            }
        }
        return $tempArr;
    }
?>