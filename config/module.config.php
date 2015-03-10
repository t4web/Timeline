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
                            '__NAMESPACE__' => 'Timeline\Controller\Console',
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
            'timeline-timeline' => array(
                'name' => 'timeline',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'avatar' => 'avatar',
                ),
            ),
        ),
    ),
);
