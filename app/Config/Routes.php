<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
/*$routes->setDefaultController('Front');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);*/

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Authentication Routing ---- Removed 
$routes->match(['GET', 'POST'], 'auth-login', 'AuthController::login');
$routes->match(['GET', 'POST'], 'auth-register', 'AuthController::register');
$routes->get('auth-logout', 'AuthController::logout');
// $routes->match(['get', 'post'], 'auth-recoverpw', 'AuthController::recoverpw');
// $routes->match(['get', 'post'], 'auth-updatepw', 'AuthController::updatepw');
// $routes->get('auth-logout', 'AuthController::logout');

$routes->get('/', 'Front::index');
$routes->get('/home', 'Front::index');

//Dashbboard section routing
$routes->get('dashboard-saas', 'Front::show_dashboard_saas');
$routes->get('dashboard-crypto', 'Front::show_dashboard_crypto');
$routes->get('dashboard-blog', 'Front::show_dashboard_blog');

//Multi-language functionality 
$routes->get('/lang/{locale}', 'Language::index');

//Layout section routing
$routes->get('layouts-horizontal', 'Front::show_layouts_horizontal');
$routes->get('layouts-vertical', 'Front::show_layouts_vertical');
$routes->get('layouts-light-sidebar', 'Front::show_layouts_light_sidebar');
$routes->get('layouts-compact-sidebar', 'Front::show_layouts_compact_sidebar');
$routes->get('layouts-icon-sidebar', 'Front::show_layouts_icon_sidebar');
$routes->get('layouts-boxed', 'Front::show_layouts_boxed');
$routes->get('layouts-preloader', 'Front::show_layouts_preloader');
$routes->get('layouts-colored-sidebar', 'Front::show_layouts_colored_sidebar');
$routes->get('layouts-scrollable', 'Front::show_layouts_scrollable');

//Horizontal Layout option section routing
$routes->get('layouts-hori-topbar-light', 'Front::show_layouts_hori_topbar_light');
$routes->get('layouts-hori-boxed-width', 'Front::show_layouts_hori_boxed_width');
$routes->get('layouts-hori-preloader', 'Front::show_layouts_hori_preloader');
$routes->get('layouts-hori-colored-header', 'Front::show_layouts_hori_colored_header');
$routes->get('layouts-hori-scrollable', 'Front::show_layouts_hori_scrollable');

//Pages section routing
/*$routes->get('auth-login', 'AuthController::login');
$routes->post('auth-login', 'AuthController::login');
$routes->get('auth-register', 'AuthController::register');
$routes->post('auth-register', 'AuthController::register');*/

$routes->get('auth-login-2', 'PageController::show_login_2');
$routes->get('auth-register', 'PageController::show_register');
$routes->get('auth-register-2', 'PageController::show_register_2');
$routes->get('auth-recoverpw', 'PageController::show_auth_recoverpw');
$routes->get('auth-recoverpw-2', 'PageController::show_auth_recoverpw_2');
$routes->get('auth-lock-screen', 'PageController::show_auth_lock_screen');
$routes->get('auth-lock-screen-2', 'PageController::show_auth_lock_screen_2');
$routes->get('auth-confirm-mail', 'PageController::show_auth_confirm_mail');
$routes->get('auth-confirm-mail-2', 'PageController::show_auth_confirm_mail_2');
$routes->get('auth-email-verification', 'PageController::show_auth_email_verification');
$routes->get('auth-email-verification-2', 'PageController::show_auth_email_verification_2');
$routes->get('auth-two-step-verification', 'PageController::show_auth_two_step_verification');
$routes->get('auth-two-step-verification-2', 'PageController::show_auth_two_step_verification_2');


//User
//$routes->get('user-update-document-password', 'UserController::show_user_update_document_password');
$routes->get('user-change-password', 'UserController::show_user_change_password');
$routes->post('user-change-password', 'UserController::show_user_change_password');
$routes->get('user-list', 'UserController::show_user_list');
$routes->post('user-list', 'UserController::show_user_list');
$routes->get('user-create', 'UserController::show_user_create');
$routes->post('user-create', 'UserController::show_user_create');
$routes->get('user-edit/(:any)', 'UserController::show_user_edit/$1');
$routes->post('user-edit/(:any)', 'UserController::show_user_edit/$1');
$routes->get('user-delete/(:any)', 'UserController::show_user_delete/$1');
$routes->get('user-enable/(:any)', 'UserController::show_user_enable/$1');

$routes->get('user-settings', 'UserController::show_user_settings');
$routes->post('user-settings', 'UserController::show_user_settings');

//MAIN
$routes->get('bond-list', 'MainController::show_bond_list');
$routes->get('bond-get-by-id', 'MainController::bond_get_by_id');
$routes->post('bond-create', 'MainController::bond_create');
$routes->post('bond-edit', 'MainController::bond_edit');
$routes->post('bond-issue', 'MainController::bond_issue');
$routes->get('bond-purchase/(:any)', 'MainController::bond_purchase/$1');;
$routes->post('bond-delete', 'MainController::bond_delete');
$routes->get('cash-flow-list', 'MainController::show_cash_flow_list');

//SUPPORT
$routes->get('user-manual', 'SupportController::show_user_manual');
$routes->get('faq', 'SupportController::show_faq');
$routes->match(['GET', 'POST'],'support-request', 'SupportController::support_request');


//Component section routing
$routes->get('ui-alerts', 'ComponentController::show_ui_alerts');
$routes->get('ui-buttons', 'ComponentController::show_ui_buttons');
$routes->get('ui-cards', 'ComponentController::show_ui_cards');
$routes->get('ui-carousel', 'ComponentController::show_ui_carousel');
$routes->get('ui-dropdowns', 'ComponentController::show_ui_dropdowns');
$routes->get('ui-grid', 'ComponentController::show_ui_grid');
$routes->get('ui-images', 'ComponentController::show_ui_images');
$routes->get('ui-lightbox', 'ComponentController::show_ui_lightbox');
$routes->get('ui-modals', 'ComponentController::show_ui_modals');
$routes->get('ui-offcanvas', 'ComponentController::show_ui_offcanvas');
$routes->get('ui-rangeslider', 'ComponentController::show_ui_rangeslider');
$routes->get('ui-session-timeout', 'ComponentController::show_ui_session_timeout');
$routes->get('ui-progressbars', 'ComponentController::show_ui_progressbars');
$routes->get('ui-placeholders', 'ComponentController::show_ui_placeholders');
$routes->get('ui-toasts', 'ComponentController::show_ui_toasts');
$routes->get('ui-sweet-alert', 'ComponentController::show_ui_sweet_alert');
$routes->get('ui-tabs-accordions', 'ComponentController::show_ui_tabs_accordions');
$routes->get('ui-typography', 'ComponentController::show_ui_typography');
$routes->get('ui-video', 'ComponentController::show_ui_video');
$routes->get('ui-general', 'ComponentController::show_ui_general');
$routes->get('ui-colors', 'ComponentController::show_ui_colors');
$routes->get('ui-rating', 'ComponentController::show_ui_rating');
$routes->get('ui-notifications', 'ComponentController::show_ui_notifications');

$routes->get('form-elements', 'ComponentController::show_form_elements');
$routes->get('form-layouts', 'ComponentController::show_form_layouts');
$routes->get('form-validation', 'ComponentController::show_form_validation');
$routes->get('form-advanced', 'ComponentController::show_form_advanced');
$routes->get('form-editors', 'ComponentController::show_form_editors');
$routes->get('form-uploads', 'ComponentController::show_form_uploads');
$routes->get('form-xeditable', 'ComponentController::show_form_xeditable');
$routes->get('form-repeater', 'ComponentController::show_form_repeater');
$routes->get('form-wizard', 'ComponentController::show_form_wizard');
$routes->get('form-mask', 'ComponentController::show_form_mask');

$routes->get('tables-basic', 'ComponentController::show_tables_basic');
$routes->get('tables-datatable', 'ComponentController::show_tables_datatable');
$routes->get('tables-responsive', 'ComponentController::show_tables_responsive');
$routes->get('tables-editable', 'ComponentController::show_tables_editable');

$routes->get('charts-apex', 'ComponentController::show_charts_apex');
$routes->get('charts-echart', 'ComponentController::show_charts_echart');
$routes->get('charts-chartjs', 'ComponentController::show_charts_chartjs');
$routes->get('charts-flot', 'ComponentController::show_charts_flot');
$routes->get('charts-knob', 'ComponentController::show_charts_knob');
$routes->get('charts-sparkline', 'ComponentController::show_charts_sparkline');
$routes->get('charts-tui', 'ComponentController::show_charts_tui');

$routes->get('icons-unicons', 'ComponentController::show_icons_unicons');
$routes->get('icons-boxicons', 'ComponentController::show_icons_boxicons');
$routes->get('icons-materialdesign', 'ComponentController::show_icons_materialdesign');
$routes->get('icons-dripicons', 'ComponentController::show_icons_dripicons');
$routes->get('icons-fontawesome', 'ComponentController::show_icons_fontawesome');

$routes->get('maps-google', 'ComponentController::show_maps_google');
$routes->get('maps-vector', 'ComponentController::show_maps_vector');
$routes->get('maps-leaflet', 'ComponentController::show_maps_leaflet');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}