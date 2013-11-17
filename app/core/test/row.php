<?php

class core_test_row extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->row = new core_model_row;
    }

    /**
     * @test
     */
    public function setAndGetWorks()
    {
        $row = [ 'one' => 1, 'two' => 2, 'three' => 3 ];

        $this->row->mass($row);
        $this->assertEquals($row, $this->row->mass(), 1);

        $this->row->set('two', 22);
        $this->row->set('boolean', false);

        $this->assertEquals(1, $this->row->get('one'), 2);
        $this->assertEquals(false, $this->row->get('boolean'), 4);
        $this->assertEquals(22, $this->row->get('two'), 6);

        $this->assertEquals(true, $this->row->is('three'), 3);
        $this->assertEquals(false, $this->row->is('foo'), 3);
        $this->assertEquals(true, $this->row->is('boolean'), 5);
        $this->assertEquals(false, $this->row->flag('boolean'), 5);

        $this->assertEquals(false, $this->row->flag('foo'), 3);
    }
}
