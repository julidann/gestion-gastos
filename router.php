
<?php
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/GestionController.php';
require_once __DIR__ . '/app/controllers/CotizacionController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

require_once __DIR__ . '/app/middlewares/session.middleware.php';
require_once __DIR__ . '/app/middlewares/guard.middleware.php';

session_start();

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

switch ($params[0]) {

    // --------- LOGIN / LOGOUT ---------
    case 'login':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;

    case 'do_login':
        $controller = new AuthController();
        $controller->doLogin($request);
        break;

    case 'logout':
        $request = (new GuardMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;

    // --------- HOME ---------
    case 'home':
        $request = (new GuardMiddleware())->run($request);
        $controller = new HomeController();
        $controller->showHome($request);
        break;

    // --------- GESTION ---------

  
    case 'tabla-gestion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        $controller->showGestion($request);
        break;

    //--------- ADD EDIT DELETE GESTION--------- //
    case 'agregar-gestion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->insertGestion($request);
        } else {
            $controller->showAddFormGestion($request);
        }
        break;
    case 'editar-gestion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        $id = $params[1] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->editGestion($id);
        } else {
            $controller->showEditFormGestion($id);
        }
        break;
    case 'eliminar-gestion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        $id = $params[1] ?? null;  
        $controller->deleteGestion($id);
        break;
    case 'buscar-gestiones':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        $controller->showFormFiltro($request);
        break;
    case 'filtrar-gestion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new GestionController();
        $controller->buscarGestiones($request);
        break;

    // --------- COTIZACIONES --------- //
     case 'tabla-cotizaciones':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CotizacionController();
        $controller->showCotizaciones($request);
        break;
    //--------- ADD EDIT DELETE COTIZACION--------- //
    case 'agregar-cotizacion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CotizacionController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->insertCotizacion($request);
        } else {
            $controller->showAddFormCotizacion($request);
        }
        break;
    case 'editar-cotizacion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CotizacionController();
        $id = $params[1] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->editCotizacion($id);
        } else {
            $controller->showEditFormCotizacion($id);
        }
        break;
    case 'eliminar-cotizacion':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CotizacionController();
        $id = $params[1] ?? null;
        $controller->deleteCotizacion($id);
        break;
        

    

    default:
        echo "404 Page Not Found// ALGO ESTAS HACIENDO MAL,";
        break;
}
