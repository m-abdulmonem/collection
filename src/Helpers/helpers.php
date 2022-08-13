<?php

use Mabdulmonem\Utilites\Collection;


if (! function_exists("collection")) {
	function collection(array $arr = []) : Collection
	{
		return new Collection($arr);
	}
}