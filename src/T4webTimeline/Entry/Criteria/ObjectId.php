<?php

namespace T4webTimeline\Entry\Criteria;

use T4webBase\Domain\Criteria\AbstractCriteria;

class ObjectId extends AbstractCriteria {
    
    protected $field = 'object_id';
    protected $table = 'timeline';
    protected $buildMethod = 'addFilterEqual';

}
