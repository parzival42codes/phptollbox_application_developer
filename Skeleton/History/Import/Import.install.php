<?php declare(strict_types=1);

/**
 * History
 *
 * Import a History Export to History
 *
 * @author  Stefan Schlombs
 * @version 1.0.0
 * @modul   versionRequiredSystem 1.0.0
 * @modul   hasCSS
 */
class ApplicationDeveloperSkeletonHistoryImport_install extends ContainerFactoryModulInstall_abstract
{


    public function install(): void
    {
        $this->setGroupAccess(Core::getRootClass(__CLASS__),
                              [
                                  4
                              ]);
        $this->importMetaFromModul('_app');
    }

    public function uninstall(): void
    {

        $this->removeStdEntities();

    }

    public function update(): void
    {

    }

    public function refresh(): void
    {

    }

    public function activate(): void
    {
        $this->importLanguage();
        $this->importRoute();
    }

    public function deactivate(): void
    {

        $this->removeStdEntitiesDeactivate();

    }

    public function repair(): void
    {

    }
}
