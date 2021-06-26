<div style="display: flex;">
    <div style="flex: 6;">&nbsp;</div>
    <div style="flex: 1;"
         class="card-container card-container--shadow">
        <div class="card-container-content">
            <a href="index.php?application=ApplicationDeveloperSkeletonHistoryImport"
               class="btn btnSmall">{insert/language class="ApplicationDeveloperSkeletonHistory" path="/form/button/import"
                language-de_DE="Import"
                language-en_US="Import"}</a>
        </div>
    </div>
</div>

<div class="card-container-content">
    <CMS function="_table">
        {
        "_config": {
        "cssClass": "template-table-standard template-table-standard-small template-table-standard-monospace",
        "table": "HistoryTable",
        "source": "HistoryTable"
        },
        "button": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/crudId"
        language-de_DE="ID"
        language-en_US="ID"}"
        },
        "information": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/information"
        language-de_DE="Informationen"
        language-en_US="Informations"}"
        },
        "generated": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/generated"
        language-de_DE="Generiert"
        language-en_US="Generated"}"
        },
        "language": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/language"
        language-de_DE="Sprachdaten"
        language-en_US="Language Data"}"
        },
        "breadcrumb": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/breadcrumb"
        language-de_DE="Breadcrumb"
        language-en_US="Breadcrumb"}"
        },
        "router": {
        "titleHeader": "{insert/language class="ApplicationDeveloperSkeletonHistory" path="/table/router"
        language-de_DE="Router"
        language-en_US="Router"}"
        }
        }
    </CMS>
</div>
