<?php

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_exceptions' => true,
        'display_not_found_reason' => true,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'timeline-init' => array(
                    'options' => array(
                        'route'    => 'timeline init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'T4webTimeline\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'db' => array(
        'tables' => array(
            't4webtimeline-entry' => array(
                'name' => 'timeline',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'creation_date' => 'creationDate',
                    'type' => 'type',
                    'object_id' => 'objectId',
                    'initiator_id' => 'initiatorId',
                ),
            ),
        ),
    ),
);
