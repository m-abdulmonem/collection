<?php

namespace Mabdulalmonem\Collection\Utilities;

class Arr
{

    public static function flatten(array $array, $depth = INF): array
    {
        $result = [];

        foreach ($array as $item) {
            $items = $item instanceof Collection ? $item->all() : $item;

            if (!\is_array($items)) {
                $result[] = $item;
            }
            else {
                $values = $depth == 1 ? array_values($item) : static::flatten($item, $depth - 1);

                foreach ($values as $value) {

                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}