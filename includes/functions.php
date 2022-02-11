<?php
    function isAString($value){
        $value = trim($value);
        if(!empty($value)){
            return $value;
        } else {
            return false;
        }
    }

    function isAGoodNumber($value){
        return $value >= 5 && $value <= 20;
    }
?>