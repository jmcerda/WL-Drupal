# WL Distro

A Composer-based Drupal distribution.

## Get Started

### For server deployments on Azure

See: https://github.com/jmcerda/server-scripts

### For local deployments

Clone code from your forked repository.

Copy .env.example to .env and adjust variables if needed.

## Build the site

Install dependencies from project directory

    composer install

Add composer.lock file to your repo.

    git add -f composer.lock
    git commit -m 'compser.lock add'
    git push

Install the site

    ./vendor/bin/drush site:install --account-mail=[SITE-EMAIL] --site-mail=[DEV-EMAIL] --site-name="[PROJECT_NAME]"

