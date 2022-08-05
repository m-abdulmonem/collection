<?php
use Mabdulalmonem\Collection\Utilites\Collection;


require_once "vendor/autoload.php";



echo "<pre>";


$collection = new Collection();

$collection->put('one', "first item");
$collection->put('ahmed' , 'aadasd');
$collection->put("last" , "im last item");

var_dump($collection->excpet(["first item","ahmed"]));