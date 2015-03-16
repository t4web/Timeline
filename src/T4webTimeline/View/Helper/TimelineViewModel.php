<?php
namespace T4webTimeline\View\Helper;

use Zend\View\Model\ViewModel;
use T4webBase\Domain\Collection;

class TimelineViewModel extends ViewModel {

    /**
     * @var Collection
     */
    private $collection;

    public function __construct($variables = null, $options = null) {
        parent::__construct($variables, $options);

        $this->template = "t4web-timeline/helper/timeline";
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }



}