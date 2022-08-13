<?php
use Mabdulalmonem\Collection\Utilites\Collection;


require_once "vendor/autoload.php";


$collection = new Collection();

$collection->put('one', "first item");
$collection->put('ahmed' , 'aadasd');
$collection->put("last" , "im last item");



echo $collection->test;
