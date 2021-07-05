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
 * @modul hasCSS
 * @modul groupAccess 1,2,3,4
 * @modul language_path_de_DE Benutzerdefiniert/Entwickler
 * @modul language_name_de_DE Custom/Developer
 * @modul language_path_en_US Phpstan
 * @modul language_name_en_US Phpstan
 *
 */
class ApplicationDeveloperPhpstan_app extends Application_abstract
{

    # Console:
    # docker run --rm -v /home/stefan/git/devilbox/data/www/phpcraftbox:/app ghcr.io/phpstan/phpstan analyse --configuration phpstan.neon --error-format=json > /home/stefan/git/devilbox/data/www/phpcraftbox/Storage/phpstan.json

    # docker run --rm -v C:\Users\stefa\git\devilbox\data\www\phpcraftbox:/app ghcr.io/phpstan/phpstan analyse --configuration phpstan.neon --error-format=json > C:\Users\stefa\git\devilbox\data\www\phpcraftbox/Storage/phpstan.json

    # docker run --rm -v $(pwd):/data cytopia/phpcs

    private array $ignoreStringContain
        = [
            'Console_abstract',
            'class PHPMailer\PHPMailer\PHPMailer',
        ];

    /**
     * @return string
     * @throws DetailedException
     */
    public function setContent(): string
    {
        $this->pageData();

        /** @var ContainerExtensionTemplateLoad_cache_template $templateCache */
        $templateCache = Container::get('ContainerExtensionTemplateLoad_cache_template',
                                        Core::getRootClass(__CLASS__),
                                        'default');

        /** @var ContainerExtensionTemplate $template */
        $template = Container::get('ContainerExtensionTemplate');
        $template->set($templateCache->getCacheContent()['default']);

        $phpStanJson = file_get_contents(CMS_ROOT . 'Storage/phpstan.json');

//        $phpStanJson = mb_convert_encoding($phpStanJson,'UTF-8','UTF-16LE');

        if (empty($phpStanJson)) {
            throw new DetailedException('phpstanNoInput');
        }

        $phpStanJsonDecoded = json_decode($phpStanJson,
                                          true);

        $template->assign('errors',
                          $phpStanJsonDecoded['totals']['errors']);
        $template->assign('errorsList',
                          var_export($phpStanJsonDecoded['errors'],
                                     true));
        $template->assign('errorsListCount',
                          count($phpStanJsonDecoded['files']));
        $template->assign('file_errors',
                          $phpStanJsonDecoded['totals']['file_errors']);

        $tableTcs = [];

//        d($phpStanJsonDecoded['files']);
//        eol();

        $counter    = 0;
        $counterAll = 0;
        foreach ($phpStanJsonDecoded['files'] as $filesName => $files) {

            foreach ($files['messages'] as $count => $message) {
                foreach ($this->ignoreStringContain as $item) {
                    if (
                        str_contains($message['message'],
                                     $item) === true
                    ) {
                        break 2;
                    }
                }

                $counterAll++;

                $note = '';

                if (
                    str_contains($message['message'],
                                 'typehint') === true
                ) {
                    $note = '<span class="note info">&nbsp;</span>';
                }

                if (
                    str_contains($message['message'],
                                 'PHPDoc tag') === true
                ) {
                    $note = '<span class="note info">&nbsp;</span>';
                }

                $tableTcs[] = [
                    'countAll'  => ++$counter,
                    'count'     => (++$count) . ' / ' . $files['errors'],
                    'filesName' => $filesName,
                    'line'      => $message['line'],
                    'message'   => $message['message'],
                    'ignorable' => $message['ignorable'],
                    'note'      => $note,
                ];
            }
        }

        $template->assign('Table_Table',
                          $tableTcs);

//        d($tableTcs);
//
//        eol();

        $template->assign('file_errors_count',
                          $counter);


        $template->parse();
        return $template->get();
    }

    private function pageData(): void
    {
        /** @var ContainerIndexPage $page */
        $page = Container::getInstance('ContainerIndexPage');
        $page->setPageTitle(ContainerFactoryLanguage::get('/' . $this->___getRootClass() . '/breadcrumb'));

        /** @var ContainerFactoryRouter $router */
        $router = Container::get('ContainerFactoryRouter');
        $router->analyzeUrl('index.php?application=' . $this->___getRootClass() . '');

        $breadcrumb = $page->getBreadcrumb();

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/ApplicationDeveloper/breadcrumb'),
                                       'index.php?application=ApplicationDeveloper');

        $breadcrumb->addBreadcrumbItem(ContainerFactoryLanguage::get('/' . $this->___getRootClass() . '/breadcrumb'),
                                       'index.php?application=' . $this->___getRootClass() . '');

        /** @var ContainerFactoryMenu $menu */
        $menu = $this->getMenu();
        $menu->setMenuClassMain($this->___getRootClass());
    }


}
