<?php

class core_test_table extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->row = [ 'one' => 1, 'two' => 2, 'three' => 3 ];
        $this->table = [ 
            [ 'four' => 4, 'five' => 5, 'six' => 6 ],
            [ 'seven' => 1, 'eight' => 8, 'nine' => 9 ],
            [ 'ten' => 10, 'eleven' => 11, 'twelwe' => 12 ],
         ];
        $this->obj= new core_model_table;
        $this->obj->mass($this->table);
    }

    /**
     * @test
     */
    public function row()
    {
        $this->obj= new core_model_table;
        $this->obj->add($this->row);
        $this->assertEquals($this->row, $this->obj->row());
    }

    /**
     * @test
     */
    public function massTable()
    {
        $this->assertEquals($this->table, $this->obj->mass());
    }

    /**
     * @test
     */
    public function massTableGetRow()
    {
        $this->assertEquals($this->table[0], $this->obj->get());
    }

    /**
     * @test
     */
    public function massTableGetRowColumn()
    {
        $this->assertEquals($this->table[0]['four'], $this->obj->get('four'));
    }

    /**
     * @test
     */
    public function massTableGetNotExistingRowColumn()
    {
        $this->assertEquals(null, $this->obj->get('one'));
    }

    /**
     * @test
     */
    public function massTableGetSecondRow()
    {
        $this->assertEquals($this->table[1], $this->obj->get(null, 2));
    }

    public function providerGetSet()
    {
        $row = [ 'one' => 1, 'two' => 2, 'three' => 3 ];
        $table = [ 
            $row,
            $row,
            $row,
         ]; 

        $data = [
            [ $row,     null,   $row,     "row" ],
//            [ $row,     'one',  1,        'row: 1' ],
//
//            [ $table,   null,   $table,   "table" ],
//            [ $table,   'one',  1,        'table: 1 row: 1' ],
        ];
        
        return $data;
    }
}
