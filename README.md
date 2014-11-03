[![Build Status](https://travis-ci.org/nachinius/aCrawler.svg?branch=master)](https://travis-ci.org/nachinius/aCrawler)
[![Code Coverage](https://scrutinizer-ci.com/g/nachinius/aCrawler/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/nachinius/aCrawler/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nachinius/aCrawler/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nachinius/aCrawler/?branch=master)

### purpose
A playing project (no clear objective), except to quickly try some technologies.

- some symfony components in isolation (not using the symfony framework)
    - console
    - filesystem
    - dependency injection
- unit test with vfsStream
- phpunit coverage
- coveralls
- scrutinizer
- phpDocumentator

### Run 

    php app/app.php

### Test

    vendor/bin/phpunit -c app/

### Generate Docs

    vendor/bin/phpdoc -d ./src -t ./docs/api --template="clean"

### Install

    composer install
    

