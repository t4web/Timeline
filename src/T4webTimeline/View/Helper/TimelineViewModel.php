<?php
namespace T4webTimeline\View\Helper;

use Zend\View\Model\ViewModel;
use T4webBase\Domain\Collection;

class TimelineViewModel extends ViewModel {

    /**
     * @var Collection
     */
    private $collection;

    private $renderers;

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

    public function addRenderer($entryId, $renderer)
    {
        $this->renderers[$entryId] = $renderer;
    }

    public function getRenderer($entry)
    {
        if (!isset($this->renderers[$entry->getId()])) {
            $this->renderers[$entry->getId()] = new EntryRenderer();
            $this->renderers[$entry->getId()]->setCreationDate($entry->getCreationDate());
        }

        return $this->renderers[$entry->getId()];
    }

}