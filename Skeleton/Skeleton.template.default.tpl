{$header}

<div style="display: flex;">
    <div style="flex: 6;">&nbsp;</div>
    <div style="flex: 1;"
         class="card-container card-container--shadow">
        <div class="card-container-content">
            <a href="index.php?application=ApplicationDeveloperSkeletonHistory"
               class="btn btnSmall">{insert/language class="ApplicationDeveloperSkeleton" path="/form/button/history"
                language-de_DE="Vorherige Versionen"
                language-en_US="History"}</a>
        </div>
    </div>
</div>

<div class="flex-container"
     style="flex-direction: row;">
    <div class="flex-container"
         style="flex: 2;flex-direction: column;">
        <div class="card-container card-container--shadow">
            <div class="card-container-header">
                {insert/language class="ApplicationDeveloperSkeleton" path="/form/information/title"
                language-de_DE="Informationsdaten"
                language-en_US="Information Data"}
            </div>
            <div class="card-container-content">
                {$information}
            </div>
        </div>
        <div class="card-container card-container--shadow">
            <div class="card-container-header">
                {insert/language class="ApplicationAdministrationContentEdit" path="/form/additional/title"
                language-de_DE="Zu Generieren"
                language-en_US="Generate"}
            </div>
            <div class="card-container-content">
                {$additional}
            </div>
        </div>
    </div>
    <div class="flex-container"
         style="flex: 2;flex-direction: column;">
        <div class="card-container card-container--shadow">
            <div class="card-container-header">
                {insert/language class="ApplicationDeveloperSkeleton" path="/form/language/title"
                language-de_DE="Sprachdaten"
                language-en_US="Language Data"}
            </div>
            <div class="card-container-content">
                {$language}
            </div>
        </div>
    </div>

    <div class="flex-container"
         style="flex: 2;flex-direction: column;">
        <div class="card-container card-container--shadow">
            <div class="card-container-header">
                {insert/language class="ApplicationDeveloperSkeleton" path="/form/breadcumbs/title"
                language-de_DE="Breadcumbs"
                language-en_US="Breadcumbs"}
            </div>
            <div class="card-container-content">
                {$breadcrumbs}
            </div>
        </div>
        <div class="card-container card-container--shadow">
            <div class="card-container-header">
                {insert/language class="ApplicationAdministrationContentEdit" path="/form/routerPath/title"
                language-de_DE="Router Pfade"
                language-en_US="Router Paths"}
            </div>
            <div class="card-container-content">
                {$routerPath}
            </div>
        </div>

    </div>
</div>

{$footer}
