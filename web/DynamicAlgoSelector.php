<?php
    function getClasses(): array{
        $code = file_get_contents('./security.php');
        preg_match_all('/class\s+(\w+)/', $code, $matches);
        
        $classes = $matches[1];
        return $classes;
    }
    class DynamicAlgoSelect{
        function select(){
            $classArr=getClasses();
            $maxIndex=count($classArr)-1;
            $randIndex=mt_rand(0,$maxIndex);
            return $classArr[$randIndex];
        }
    }
?>