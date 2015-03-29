<?php

namespace T4webTimeline\Entry\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class OrderByDate extends AbstractCriteria {

    protected $field = 'creation_date DESC';
    protected $table = 'timeline';
    protected $buildMethod = 'order';

    public function __construct($field = 'creation_date DESC') {
        $this->field = $field;
    }
    
}
