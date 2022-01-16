<?php
require_once 'autoload.php';

$action = 'action_';
$action .=(isset($_GET['action'])) ? $_GET['action'] : 'index';

switch ($_GET['controller'])
{
	case 'page':
		$controller = new Page();
        break;
    case 'goods':
        $controller = new Catalog();
        break;
    case 'good':
        $controller = new Product();
        break;
	case 'user':
		$controller = new User();
		break;
    case 'cart':
        $controller = new Cart();
        break;
	default:
		$controller = new Page();
}

$controller->Request($action);
