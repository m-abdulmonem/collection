<?php


namespace Mabdulalmonem\Collection\Utilites;


class Collection implements \IteratorAggregate, \Countable
{


    public function __construct(protected $items = [])
    {
        $this->add($items);
    }


    public function add($items) : Collection
    {
        if ($keys = array_keys($items)) {
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
        if (\is_array($val)) {
            $whereVal = array_intersect($this->items, $val);
            $whereKey = array_intersect_key($this->items, $this->flip($val));
            return array_merge($whereVal, $whereKey);
        }
        else if (array_key_exists($val, $this->items)) {
            return $this->items[$val];
        }
        else {
            $key = array_search($val, $this->items);
            if ($key) {
                return [$key => $this->items[$key]];
            }
        }
    }

    public function flip($items = null): array
    {
        if ($items) {
            return \array_flip($items);
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
    
    public function all()
    {
        return $this->items;
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function key($item): mixed
    {
        return array_search($item, $this->items);
    }

    public function combine($values)
    {
        return array_combine($this->items, $values);
    }

    public function merge($items)
    {
        if (!is_array($items)) {
            $items = [$items];
        }
        return array_merge($this->items, $items);
    }

    public function mergeRecursive($items)
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

    public function unqiue()
    {
        return array_unique($this->items);
    }

    public function contains($key)
    {
        return in_array($key, array_keys($this->items));
    }

    public function excpet($excpet)
    {
        $orginal = $this->items;

        if (!\is_array($excpet)) {
            unset($orginal[$excpet]);
        }
        else {
            foreach ($excpet as $value) {
                unset($orginal[$this->extractKey($value)]);
            }
        }
        return $orginal;
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

    public function extractKey($key)
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

    public function filter(callable $callback)
    {
        return array_filter($this->items, $callback);
    }

    public function flatten($depth = INF)
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
}