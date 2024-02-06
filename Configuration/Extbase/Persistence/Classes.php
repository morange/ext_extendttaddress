<?php

declare(strict_types=1);

use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\Category;
use DerMatthesFrauHofer\ExtExtendttaddress\Domain\Model\ExtendTtAddress;

return [
    Category::class => [
        'tableName' => 'sys_category',
    ],
    ExtendTtAddress::class => [
        'tableName' => 'tt_address',
    ]
];