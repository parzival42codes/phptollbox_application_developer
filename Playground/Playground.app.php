<?php
declare(strict_types=1);

/**
 * Developer Playground
 *
 * Test Environment for Developer
 *
 * @modul author Stefan Schlombs
 * @modul version 1.0.0
 * @modul versionRequiredSystem 1.0.0
 *
 */
class ApplicationDeveloperPlayground_app extends Application_abstract
{

    /**
     * @return string
     */
    public function setContent(): string
    {
        $templateCache = new ContainerExtensionTemplateLoad_cache_template(Core::getRootClass(__CLASS__),
                                                                           'default');

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['default']);

        $template->parseQuote();
        $template->parse();
        return $template->get();

    }


}
