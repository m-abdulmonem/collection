<?php
use Mabdulalmonem\Collection\Utilities\Collection;


require_once "vendor/autoload.php";


$collection = collect();

$obj =new \stdClass;
$obj->name = "Mohamed";
$obj->age = 23;

$collection->add($obj);
$collection->put('one', "first item");
$collection->put('ahmed' , 'aadasd');
$collection->put("last" , "im last item");


$collection->last;
//$collection->dd();

echo $collection[1] ="adasd";
dd($collection[1],$collection);
