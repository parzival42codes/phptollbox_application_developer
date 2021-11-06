/** @var ContainerExtensionTemplateParseCreateForm_helper $formHelper */
$formHelper = new ContainerExtensionTemplateParseCreateForm_helper(
'',
'');

$formHelperResponse = $formHelper->getResponse();
if (
$formHelperResponse->isHasResponse()  && !$formHelperResponse->hasError()
) {
$this->formResponse($formHelper);
}
