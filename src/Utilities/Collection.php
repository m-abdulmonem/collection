<?php


namespace Mabdulalmonem\Collection\Utilities;

use ArrayObject;
use JetBrains\PhpStorm\NoReturn;
use Mabdulalmonem\Collection\Exceptions\CollectionException;
use ReturnTypeWillChange;

class Collection  implements \IteratorAggregate, \Countable, \ArrayAccess
{
    public function __construct(protected $items = [])
    {
        $this->add($items);
    }


    public function __get(string $name) : mixed
    {
        if (array_key_exists($name,$this->items)){
            return $this->get($name);
        }
        
        return new CollectionException("key ($name) is not exists");
    }

    public function add($items) : Collection
    {
        if (! is_array($items)){
            $this->items[] = $items;
        }
        else if ($keys = array_keys($items)) {
            foreach ($keys as $key) {
                $this->items[$key] = $items[$key];
            }
        }
        else {
            $this->items = $items;
        }

        return $this;
    }


    public function put($key, $value): Collection
    {
        $this->items[$key] = $value;

        return $this;
    }


    public function get($val): mixed
    {
        if (is_array($val)) {
            $whereVal = array_intersect($this->items, $val);
            $whereKey = array_intersect_key($this->items, $this->flip($val));
            return array_merge($whereVal, $whereKey);
        }

        if (array_key_exists($val, $this->items)) {
            return $this->items[$val];
        }

        if ($key = array_search($val, $this->items)) {
            return [$key => $this->items[$key]];
        }

        return null;
    }

    public function flip($items = null): array
    {
        if ($items) {
            return array_flip($items);
        }
        return array_flip($this->items);
    }
    
    
    public function first(): mixed
    {
        return reset($this->items);
    }
    public function last(): mixed
    {
        return end($this->items);
    }
    
    public function all(): array
    {
        return $this->items;
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function key($item): string|int|false
    {
        return array_search($item, $this->items);
    }

    public function combine($values): array
    {
        return array_combine($this->items, $values);
    }

    public function merge($items): array
    {
        if (!is_array($items)) {
            $items = [$items];
        }
        return array_merge($this->items, $items);
    }

    public function mergeRecursive($items): array
    {
        if (!is_array($items)) {
            $items = [$items];
        }
        return array_merge_recursive($this->items, $items);
    }
    public function union($items)
    {
        return $this->items + $items;
    }

    public function unique(): array
    {
        return array_unique($this->items);
    }

    public function contains($key): bool
    {
        return in_array($key, array_keys($this->items));
    }

    public function expect($expect): array
    {
        $original = $this->items;

        if (!\is_array($expect)) {
            unset($original[$expect]);
        }
        else {
            foreach ($expect as $value) {
                unset($original[$this->extractKey($value)]);
            }
        }
        return $original;
    }

    public function only($val)
    {
        if (\is_array($val)) {
            $whereVal = array_intersect($this->items, $val);
            $whereKey = array_intersect_key($this->items, $this->flip($val));
            return array_merge($whereVal, $whereKey);
        }
        else if (array_key_exists($val, $this->items)) {
            return $this->items[$val];
        }
        return false;
    }

    public function extractKey($key): false|int|string
    {
        if (array_key_exists($key, $this->items)) {
            return $key;
        }
        else {
            return array_search($key, $this->items);
        }
    }

    public function map(callable $callback)
    {
        return array_map($callback, $this->items);
    }

    public function filter(callable $callback): array
    {
        return array_filter($this->items, $callback);
    }

    public function flatten($depth = INF): array
    {
        return Arr::flatten($this->items, $depth);
    }


    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }


    public function count(): int
    {
        return count($this->items);
    }

    public function __toString(): string
    {
        return json_encode($this->items);
    }

    #[NoReturn] public function dd(): void
    {
        dd($this->items,$this->all());
    }

    /**
     * @throws CollectionException
     */
    #[ReturnTypeWillChange] public function offsetExists(mixed $offset): bool|string
    {
        if (!array_key_exists($offset, $this->items)){
            return  new CollectionException("offset ($offset) is not exists");
        }
    }

    /**
     * @throws CollectionException
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!array_key_exists($offset, $this->items)){
            return  new CollectionException("offset ($offset) is not exists");
        }
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
//        if (!array_key_exists($offset, $this->items)){
//            echo  new CollectionException("offset ($offset) is not exists");
//            exit(0);
//        }
        $this->items[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        if (!array_key_exists($offset, $this->items)){
            echo  new CollectionException("offset ($offset) is not exists");
            exit(0);
        }
        $original = $this->items;

        unset($original[$offset]);

        $this->items = $original;
    }
}