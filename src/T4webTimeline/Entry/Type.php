<?php

namespace T4webTimeline\Entry;

use T4webBase\Domain\Enum;

class Type extends Enum {
    
    const USER_CREATED = 1;
    const USER_UPDATED = 2;
    const USER_DELETED = 3;

    /**
     * @var array
     */
    protected static $constants = array(
        self::USER_CREATED => 'User created',
        self::USER_UPDATED => 'User updated',
        self::USER_DELETED => 'User deleted',
    );

}