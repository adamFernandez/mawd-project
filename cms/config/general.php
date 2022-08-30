<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

return [
    // Craft config settings from .env variables
    'aliases' => [
        '@web' => App::env('SITE_URL'),
        '@webroot' => App::env('WEB_ROOT_PATH'),
    ],
    'allowUpdates' => (bool)App::env('ALLOW_UPDATES'),
    'allowAdminChanges' => (bool)App::env('ALLOW_ADMIN_CHANGES'),
    'backupOnUpdate' => (bool)App::env('BACKUP_ON_UPDATE'),
    'devMode' => (bool)App::env('DEV_MODE'),
    'enableTemplateCaching' => (bool)App::env('ENABLE_TEMPLATE_CACHING'),
    'resourceBasePath' => App::env('WEB_ROOT_PATH') . '/cpresources',
    'runQueueAutomatically' => (bool)App::env('RUN_QUEUE_AUTOMATICALLY'),
    'securityKey' => App::env('SECURITY_KEY'),
    // Craft config settings from constants
    'cacheDuration' => false,
    'defaultSearchTermOptions' => [
        'subLeft' => true,
        'subRight' => true,
    ],
    'defaultTokenDuration' => 'P2W',
    'enableCsrfProtection' => false,
    // ($_SERVER['HTTP_ORIGIN'] !=  App::env('CRAFT_API_URL') &&
    //   $_SERVER['HTTP_ORIGIN'] != App::env('FRONTEND_URL') &&
    //   $_SERVER['HTTP_ORIGIN'] != App::env('FRONTEND_URL_PORT')
    // )
    
    'generateTransformsBeforePageLoad' => true,
    'maxCachedCloudImageSize' => 3000,
    'maxUploadFileSize' => '100M',
    'omitScriptNameInUrls' => true,
    'useEmailAsUsername' => false,
    'usePathInfo' => true,
];
