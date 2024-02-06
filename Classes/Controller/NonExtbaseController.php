<?php

use TYPO3\CMS\Core\Service\FlexFormService;

final class NonExtbaseController
{

    // Inject FlexFormService
    public function __construct(
        private readonly FlexFormService $flexFormService,
	) {
    }

    // ...

    private function loadFlexForm($flexFormString): array
    {
        return $this->flexFormService
            ->convertFlexFormContentToArray($flexFormString);
    }
}


var_export(
    $this->flexFormService->convertFlexFormContentToArray($flexFormString)
);