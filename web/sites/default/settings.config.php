<?php

use Drupal\Core\Installer\InstallerKernel;

/**
 * Set the config sync directory to the profile's config dir during site install.
 *
 * This fixes an error with config validation while installing from config if
 * the config/sync directory is empty.
 */
$is_installer_url = (strpos($_SERVER['SCRIPT_NAME'], '/core/install.php') !== FALSE);
if (InstallerKernel::installationAttempted() || $is_installer_url) {
  $settings['config_sync_directory'] = '../config/profile';
} else {
  $settings['config_sync_directory'] = '../config/sync';
}

/**
 * Configuration overrides
 */

// Email
if (getenv('SMTP_HOST')) {
  $config['symfony_mailer.transport']['smtp_host'] = getenv('SMTP_HOST');
  $config['symfony_mailer.transport']['smtp_credentials']['swiftmailer']['username'] = getenv('SMTP_USERNAME');
  $config['symfony_mailer.transport']['smtp_credentials']['swiftmailer']['password'] = getenv('SMTP_PASSWORD');
  $config['symfony_mailer.transport']['smtp_port'] = getenv('SMTP_PORT');
  $config['symfony_mailer.transport']['smtp_encryption'] = getenv('SMTP_ENCRYPTION');
}

// Twitter
if (getenv('TWITTER_KEY')) {
  $config['twitter_feed.settings']['twitter_feed_api_key'] = getenv('TWITTER_KEY');
  $config['twitter_feed.settings']['twitter_feed_api_secret'] = getenv('TWITTER_SECRET');
}

// SOLR
if (getenv('SOLR_ENABLED')) {
  $config['search_api.server.solr']['backend_config']['connector_config']['scheme'] = getenv('SOLR_SCHEME');
  $config['search_api.server.solr']['backend_config']['connector_config']['host'] = getenv('SOLR_HOST');
  $config['search_api.server.solr']['backend_config']['connector_config']['port'] = getenv('SOLR_PORT');
  $config['search_api.server.solr']['backend_config']['connector_config']['path'] = getenv('SOLR_PATH');
  $config['search_api.server.solr']['backend_config']['connector_config']['core'] = getenv('SOLR_CORE');
  $config['search_api.server.solr']['status'] = TRUE;
  $config['search_api.index.content_index']['server'] = 'solr';
}
else {
  $config['search_api.server.solr']['status'] = FALSE;
  $config['search_api.server.database']['status'] = TRUE;
  $config['search_api.index.content_index']['server'] = 'database';
}

/**
 * Set configuration split directories.
 */
$config['config_split.config_split.development']['status'] = TRUE;
$config['config_split.config_split.staging']['status'] = TRUE;
$config['config_split.config_split.production']['status'] = TRUE;

/**
 * Lock any configuration changes done via the Drupal admin UI on the production environment.
 */
if (getenv('ENVIRONMENT') === 'prod') {
  $settings['config_readonly'] = TRUE;
}
