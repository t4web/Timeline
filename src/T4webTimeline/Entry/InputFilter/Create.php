<?php

namespace T4webTimeline\Entry\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Date;

class Create extends InputFilter {
    
    public function __construct() {
        
        //id
        $id = new Id('id');
        $id->setRequired(false);
        $this->add($id);
        
        // creation_date
        $creationDate = new Date('creationDate');
        $creationDate->setRequired(true);
        $this->add($creationDate);

        // type
        $type = new Id('type');
        $type->setRequired(true);
        $this->add($type);

        // objectId
        $objectId = new Id('objectId');
        $objectId->setRequired(true);
        $this->add($objectId);

        // initiatorId
        $initiatorId = new Id('initiatorId');
        $initiatorId->setRequired(true);
        $this->add($initiatorId);
    }
}
