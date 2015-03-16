<?php

namespace T4webTimeline\View\Helper;

use Zend\View\Helper\AbstractHelper;
use T4webBase\Domain\Service\BaseFinder as FinderService;
use T4webBase\Domain\Collection;

class Timeline extends AbstractHelper {

    /**
     * @var FinderService
     */
    private $finder;

    /**
     * @var TimelineViewModel
     */
    protected $viewModel;

    public function __construct(FinderService $finder, TimelineViewModel $viewModel)
    {
        $this->finder = $finder;
        $this->viewModel = $viewModel;
    }

    /**
     * @param integer $objectId
     * @return string
     */
    public function __invoke($objectId)
    {
        /** @var ollection $entries */
        $entries = $this->finder->findMany(['T4webTimeline' => ['Entry' => ['objectId' => $objectId]]]);

        $this->viewModel->setCollection($entries);

        return $this->getView()->render($this->viewModel);
    }
}