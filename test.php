<?php

    /**
     * [GET] 
     * array
     * value
     * value null
     * row n 
     * value of row n 
     * 
     *
     * [SET] 
     */

    $object->row();           // array
    $object->row('id');       //
    $object->row('id', 123);  //
    $object->row('id', null); // works as get
    $object->erase('id');
    
    $object->get(); 
    $object->get('id'); 
    $object->get('id'); 
    $object->get('id', 2); 
    $object->get('id', 2); 

    $data = [
        [ 'id' => 1, 'question' => 'Hello Question',        'category_id' => 10, 'answer_id' => [ 1,2,3,4 ] ],
        [ 'id' => 2, 'question' => 'Hello App Question',    'category_id' => 10, 'answer_id' => [ 3,4 ] ], 
        [ 'id' => 2, 'question' => 'Hello Simple Question', 'category_id' => 10, 'answer_id' => [ 4 ] ], 
    ];

    $question->get('id');             // 1 
    $question->get('category_id');    // 10 
    $question->category()->get('id'); // object
    $question->answer();              // array 
    $question->answer()->get();       // obejct
    $question->answer()->get(4);      // obejct

    $answer = [
        [ 'id' => 1, 'value' => 'Answer one', 'is_valid' => true ],
        [ 'id' => 2, 'value' => 'Answer two', 'is_valid' => false], 
    ];

    $category = [
        [ 'id' => 1, 'value' => 'Core',         subcategory_id => null ],
        [ 'id' => 2, 'value' => 'Request',      subcategory_id => null ],
        [ 'id' => 3, 'value' => 'Request core', subcategory_id => [ 1, 2 ]  ], 
    ];


    $data = [
        [ 
            'id' => 1,
            'question' => 'Hello Question',
            'category_id' => [ ],
            'answer_id' => [ 1,2,3,4 ]
        ],
        [ 'id' => 2, 'question' => 'Hello App Question',    'category_id' => 10, 'answer_id' => [ 3,4 ] ], 
        [ 'id' => 2, 'question' => 'Hello Simple Question', 'category_id' => 10, 'answer_id' => [ 4 ] ], 
    ];
?>
