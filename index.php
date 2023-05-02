<?php  
require_once __DIR__ . '/vendor/autoload.php';


$router = new AltoRouter();

$router->map('GET', '/', function() {
    echo '<h1>Bienvenue sur l\'accueil</h1>';
});

$router->map('GET', '/users', function() {
    echo '<h1>Bienvenue sur la liste des utilisateurs</h1>';
});

$router->map('GET', '/users/[i:id]', function($id) {
    echo '<h1>Bienvenue sur la page de l\'utilisateur ' . $id . '</h1>';
});

$match = $router->match();

if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
}



?>