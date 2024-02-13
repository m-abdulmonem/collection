<?php

use Mabdulalmonem\Collection\Utilities\Collection;


if (! function_exists("collect")) {
	function collect(array $arr = []) : Collection
	{
		return new Collection($arr);
	}
}