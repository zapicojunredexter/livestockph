<?php
    function containsString($string, $substrings){
        foreach($substrings as $substring){
            if (strpos($string, $substring) !== false) {
                return true;
            }
        }
        return false;
    }
?>