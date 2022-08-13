<?php
namespace Mabdulalmonem\Collection\Exceptions;

use Mabdulalmonem\Collection\Exceptions\View\ExceptionView;


class CollectionException extends \Exception{


    public function __toString(): string
    {
        return ExceptionView::html($this);
    }
}