<?php

declare(strict_types=1);
session_start();

// Enable full error reporting
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once('../../config/constants.php');

require_once('../../config/database.php');
// $conn = getConnection();
require_once(BASE_PATH . '/helper/helper.php');
require_once(BASE_PATH . '/server/single_service_server.php');
require_once(BASE_PATH . '/server/gallery_server.php');
require_once(BASE_PATH . '/server/contactform-server.php');
require_once(BASE_PATH . '/server/settings_server.php');
require_once(BASE_PATH . '/server/blog_server.php');


$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);


switch ($url) {
  case '/admin':
    handleDashboard();
    break;

  case '/admin/services':
    handleServicesView();
    break;

  case '/admin/services/create':
    viewAdmin('services/create');
    break;

  case '/admin/services/store':
    handleServiceStore();
    break;

  case '/admin/service/delete':
    handleServiceDestroy();
    break;

  case '/admin/services/edit':
    handleAdminServiceEdit();
    break;

  case '/admin/services/update':
    handleServiceUpdate();
    break;

  case '/admin/gallery':
    handleGalleryView();
    break;

  case '/admin/gallery/create':
    handleGalleryCreateView();
    break;

  case '/admin/gallery/store':
    handleGalleryStore();
    break;

  case '/admin/galleries/delete':
    handleGalleryDelete();
    break;

  case '/admin/galleries/edit':
    handleGalleryEditView();
    break;

  case '/admin/gallery/update':
    handleGalleryUpdate();
    break;

  case '/admin/contacts/store':
    handleContactFormStore();
    break;

  case '/admin/contacts':
    handleContactsView();
    break;

  case '/admin/contacts/delete':
    handleContactDelete();
    break;

  case '/admin/contacts/reply':
    replyRecipient();
    break;

  case '/admin/settings':
    handleSettingsView();
    break;

  case '/admin/settings/create':
    handleSettingsCreate();
    break;

  case '/admin/setting/edit':
    handleSettingsEdit();
    break;

  case '/admin/settings/update':
    handleSettingsUpdate();
    break;

  case '/admin/settings/store':
    handleSettingsStore();
    break;

  case '/admin/setting/delete':
    handleSettingDelete();
    break;

  case '/admin/blog':
    handleBlogView();
    break;

  case '/admin/blog/create':
    handleBlogCreate();
    break;

  case '/admin/blog/store':
    handleBlogStore();
    break;

  case '/admin/blog/delete':
    handleBlogDelete();
    break;

  case '/admin/blog/edit':
    handleBlogEditView();
    break;

    
  case '/admin/blog/update':
    handleBlogUpdate();
    break;




  default:
    die('Page not Found');
}
