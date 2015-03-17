<?php

namespace T4webTimeline\Entry;

use T4webBase\Domain\Entity;

class Entry extends Entity {
    
    protected $creationDate;
    protected $type;
    protected $objectId;
    protected $initiatorId;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

}
