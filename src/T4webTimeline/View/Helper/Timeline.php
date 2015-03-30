<?php

namespace T4webTimeline\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\EventManager\EventManager;
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

    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        FinderService $finder,
        TimelineViewModel $viewModel,
        EventManager $eventManager)
    {
        $this->finder = $finder;
        $this->viewModel = $viewModel;
        $this->eventManager = $eventManager;
    }

    /**
     * @param integer $objectId
     * @return string
     */
    public function __invoke($objectId)
    {
        /** @var Collection $entries */
        $entries = $this->finder->findMany(['T4webTimeline' => ['Entry' => [
            'objectId' => $objectId,
            'OrderBy' => 'creation_date DESC',
        ]]]);

        $this->viewModel->setCollection($entries);

        $this->eventManager->trigger('render', $this, ['viewModel' => $this->viewModel]);

        return $this->getView()->render($this->viewModel);
    }
}