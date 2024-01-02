<?php
require ('../xcrud/xcrud.php');
require ('html/pagedata.php');
session_start();
$theme = isset($_GET['theme']) ? $_GET['theme'] : 'default';
switch ($theme)
{
    case 'bootstrap':
        Xcrud_config::$theme = 'bootstrap';
        Xcrud_config::$load_bootstrap5 = false;
        Xcrud_config::$load_bootstrap4 = false;
        Xcrud_config::$load_bootstrap = true;
        $title_2 = 'Bootstrap theme';
        break;
	case 'bootstrap4':
        Xcrud_config::$theme = 'bootstrap4';
        Xcrud_config::$load_bootstrap4 = true;
        Xcrud_config::$load_bootstrap5 = false;
        Xcrud_config::$load_bootstrap = false;
        $title_2 = 'Bootstrap 4.5 theme';
        break;
    case 'bootstrap5':
        Xcrud_config::$theme = 'bootstrap5';
        Xcrud_config::$load_bootstrap5 = true;
        Xcrud_config::$load_bootstrap4 = false;
        Xcrud_config::$load_bootstrap = false;
        
        $title_2 = 'Bootstrap 5 theme';
        break;     
    case 'semantic':
        Xcrud_config::$theme = 'semantic';
        Xcrud_config::$load_bootstrap5 = false;
        Xcrud_config::$load_bootstrap4 = false;
        Xcrud_config::$load_bootstrap = false;
        Xcrud_config::$load_semantic = true;
        
        $title_2 = 'Semantic UI theme';
        break;         
    case 'minimal':
        Xcrud_config::$theme = 'minimal';
        $title_2 = 'Minimal theme';
        break;
    default:
        Xcrud_config::$theme = 'default';
        $title_2 = 'Default theme';
        break;
}

$page = (isset($_GET['page']) && isset($pagedata[$_GET['page']])) ? $_GET['page'] : 'default';
extract($pagedata[$page]);

$file = dirname(__file__) . '/pages/' . $filename;
$code = file_get_contents($file);
include ('html/template.php');
