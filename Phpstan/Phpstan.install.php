<?php

class ApplicationDeveloperPhpstan_install extends ContainerFactoryModulInstall_abstract
{

    public function install():void
    {
        $this->importLanguage();
        $this->readLanguageFromFile('default');
        $this->importMetaFromModul('_app');
    }

}
