<?php
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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