<?php
namespace Mabdulalmonem\Collection\Exceptions\View;
use PhpParser\Node\Stmt\TryCatch;
use Mabdulalmonem\Collection\Utilites\Collection;
use Mabdulalmonem\Collection\Exceptions\CollectionException;


class ExceptionView
{

    public function __construct(protected $file)
    {
        try {
            $file = fopen("index.php", "w");
        }
        catch (\Throwable $th) {
            throw new \Exception("Error opening file");
        }
    }

    public static function html(CollectionException $excp)
    {
        \ob_start();
        include_once __DIR__ . "\index.php";
        // echo "<h1>{$excp->getMessage()} in file {$excp->getFile()} in line {$excp->getLine()}</h1>";
        $html = ob_get_contents();
        \ob_end_clean();
        return $html;
    }

    public function view(string $message)
    {
        fwrite($this->file, \file_get_contents("header.php", true));
        fwrite($this->file, $message);
        fwrite($this->file, \file_get_contents("footer.php", true));
        fclose($this->file);

        require_once $this->file;
    }

    private static function methods(): array
    {
        $arr = [];

        $class_methods = (new Collection(get_class_methods(CollectionException::class)))
            ->excpet(['__toString', '__construct', '__wakeup']);

        foreach ($class_methods as $method_name) {
            $arr[lcfirst(str_replace("get", "", $method_name))] = $method_name;
        }

        return $arr;
    }

}