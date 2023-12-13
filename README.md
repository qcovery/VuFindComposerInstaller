# VuFindComposerInstaller
This module is used when installing VuFind modules via composer. It helps to install modules, associated themes and configuration files in the correct directories.

## Usage
Add Qcovery packages to the composer.local.json file of your VuFind code.

```
"require": {
        ...
        "qcovery/autocomplete-terms": "^0.5.0",
        "qcovery/availability-feedback": "^0.5.0",
        "qcovery/belugino-cover": "^0.5.0",
        "qcovery/calief": "^0.5.0",
        "qcovery/daia-plus": "^0.5.0",
        "qcovery/delivery": "^0.5.0",
        "qcovery/delivery-microform": "^0.5.0",
        "qcovery/dependent-works": "^0.5.0",
        "qcovery/dismax-munge": "^0.5.0",
        "qcovery/extended-facets": "^0.5.0",
        "qcovery/extended-feedback": "^0.5.0",
        "qcovery/fulltext-finder": "^0.5.0",
        "qcovery/help-tooltips": "^0.5.0",
        "qcovery/libraries": "^0.5.0",
        "qcovery/list-admin": "^0.5.0",
        "qcovery/lms": "^0.5.0",
        "qcovery/paia-plus": "^0.5.0",
        "qcovery/publication-suggestion": "^0.5.0",
        "qcovery/record-driver": "^0.5.0",
        "qcovery/relevance-picker": "^0.5.0",
        "qcovery/result-feedback": "^0.5.0",
        "qcovery/rvk": "^0.5.0",
        "qcovery/search-keys": "^0.5.0",
        "qcovery/storage-info": "^0.5.0",
        ...
    }
```

The modules will be installed in `[VUFIND_DIR]/modules`, the templates in `[VUFIND_DIR]/themes` and the configurations files in `[VUFIND_DIR]/local/config/vufind`.
