<div style="display: flex;">
    <div style="flex: 1;"
         class="card-container card-container--shadow">
        <div class="card-container-header">
            {insert/language class="ApplicationDeveloperPhpstan" path="/information/title"
            language-de_DE="Phpstan Information"
            language-en_US="Phpstan Information"}
        </div>
        <div class="card-container-content">
            <p>
                {insert/language class="ApplicationDeveloperPhpstan" path="/information/errors"
                language-de_DE="Errors"
                language-en_US="Errors"}: <strong>{$errors}</strong>
            </p>

            <p>
                {insert/language class="ApplicationDeveloperPhpstan" path="/information/file_errors"
                language-de_DE="Datei Errors"
                language-en_US="FileErrors"}: <strong>{$file_errors_count}</strong> / <strong>{$file_errors}</strong>

                ( {insert/language class="ApplicationDeveloperPhpstan" path="/information/errorsListCount"
                language-de_DE="Anzahl Dateien"
                language-en_US="Count Files"}: <strong>{$errorsListCount}</strong>)
            </p>
        </div>
    </div>

    <div style="flex: 1;"
         class="card-container card-container--shadow">
        <div class="card-container-header">
            {insert/language class="ApplicationDeveloperPhpstan" path="/information/title"
            language-de_DE="Phpstan Information"
            language-en_US="Phpstan Information"}
        </div>
        <div class="card-container-content">
            {$errorsList}
        </div>
    </div>

</div>

<div class="card-container card-container--shadow">
    <div class="card-container-header">
        {insert/language class="ApplicationDeveloperPhpstan" path="/header/title"
        language-de_DE="Phpstan Auswertung"
        language-en_US="Phpstan result"}
    </div>
    <div class="card-container-content">
        <CMS function="_table">
            {
            "_config": {
            "cssClass": "template-table-standard template-table-standard-small template-table-standard-monospace",
            "table": "Table",
            "source": "Table"
            },
            "countAll": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/countAll"
            language-de_DE="Zähler Alle"
            language-en_US="Counter All"}"
            },
            "count": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/counter"
            language-de_DE="Zähler"
            language-en_US="Counter"}"
            },
            "filesName": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/filesName"
            language-de_DE="Dateiname"
            language-en_US="Filename"}"
            },
            "line": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/line"
            language-de_DE="Zeile"
            language-en_US="Line"}"
            },
            "message": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/message"
            language-de_DE="Nachricht"
            language-en_US="Message"}"
            },
            "ignorable": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/ignorable"
            language-de_DE="Ignorierbar"
            language-en_US="Ignorable"}",
            "rowParameter": "Yesno"
            },
            "note": {
            "titleHeader": "{insert/language class="ApplicationDeveloperPhpstan" path="/table/note"
            language-de_DE="Hinweis"
            language-en_US="Note"}"
            }
            }
        </CMS>
    </div>
</div>
