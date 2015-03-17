<?php

namespace T4webTimeline\View\Helper;

use Zend\View\Model\ViewModel;

class EntryRenderer extends ViewModel {

    private $creationDate;

    public function __construct($variables = null, $options = null) {
        parent::__construct($variables, $options);

        $this->template = "t4web-timeline/partials/timeline-entry";
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

}