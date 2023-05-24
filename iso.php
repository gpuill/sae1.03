#!/usr/bin/php 

<?php

$input = fopen ("$argv[1]","r"); 
$iso = fopen("iso.data", "w");

while(!feof($input)){
    $line=fgets($input);
    if ((preg_match('/^Code=/', $line))||(preg_match('/^CODE=/', $line))) { 
        $line=explode("=",$line);
        $line=$line[1];
        $line=strtoupper($line);
        fwrite($iso, $line);
    }
}
?>