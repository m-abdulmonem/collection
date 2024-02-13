<?php
use PHPUnit\Framework\TestCase;
use Mabdulalmonem\Collection\Utilities\Collection;

class CollectionTest extends TestCase{

    private array $arr;
    private Collection $collection;

    public function __constuct()
    {
        $this->collection = new Collection($this->arr);
    }

    public function test_add_item()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value'
        ];

        $collection = new Collection($arr);
        
        $add = $collection->add(["index3" => "im added form add method"]);

        $this->assertEquals($add,$collection);
    }

    public function test_put_item()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value'
        ];

        $collection = new Collection($arr);
        
        $add = $collection->put("index3", "im added form put method");

        $this->assertEquals($add,$collection);
    }

    public function test_get_where_arg_is_array_and_items_is_values_of_array()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value',
            
            'index3' => 'index3 value',
            
            'index4' => 'index4 value',
            
            'index5' => 'index5 value',
        ];

        $collection = new Collection($arr);
        
        $get = $collection->get(['index5 value','im a value of index1']);

        $this->assertEquals($get,['index5' => $arr['index5'],'index1' => $arr['index1']]);
    }
    public function test_get_where_arg_is_array_and_items_is_keys_of_array()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value',
            
            'index3' => 'index3 value',
            
            'index4' => 'index4 value',
            
            'index5' => 'index5 value',
        ];

        $collection = new Collection($arr);
        
        $get = $collection->get(['index5','index1']);

        $this->assertEquals($get,['index5' => $arr['index5'],'index1' => $arr['index1']]);
    }
    public function test_get_where_arg_is_array_and_items_is_keys_and_values_of_array()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value',
            
            'index3' => 'index3 value',
            
            'index4' => 'index4 value',
            
            'index5' => 'index5 value',
        ];

        $collection = new Collection($arr);
        
        $get = $collection->get(['index5 value','index1']);

        $this->assertEquals($get,['index5' => $arr['index5'],'index1' => $arr['index1']]);
    }
    public function test_get_where_arg_is_index_of_item_in_array()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value'
        ];

        $collection = new Collection($arr);
        
        $data = $collection->get("index2");

        $this->assertEquals($data,'index2 value');
    }
    public function test_get_where_arg_is_value_of_item_in_array()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value'
        ];

        $collection = new Collection($arr);
        
        $data = $collection->get('im a value of index1');

        $this->assertEquals($data,['index1' => 'im a value of index1']);
    }

    public function test_get_all()
    {
        $arr = [
            'index1' => 'im a value of index1',
            
            'index2' => 'index2 value'
        ];

        $collection = new Collection($arr);
        
        $this->assertIsArray($collection->all());
    }



}