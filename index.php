<?php  
require_once 'vendor/autoload.php';


$router = new AltoRouter();

$router->setBasePath('/super-week');

$router->map('GET', '/',function() {
    echo '<h1>Bienvenue sur l\'accueil</h1>';
});


$router->map('GET', '/users', function() {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=super-week', 'root', '');

    // Tableau d'utilisateurs
    $users = [
        [
            'id' => 1,
            'email' => 'john.doe@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe'
        ],
        [
            'id' => 2,
            'email' => 'jane.doe@example.com',
            'first_name' => 'Jane',
            'last_name' => 'Doe'
        ],
        [
            'id' => 3,
            'email' => 'bob.smith@example.com',
            'first_name' => 'Bob',
            'last_name' => 'Smith'
        ]
    ];

    // Insertion des utilisateurs dans la base de données
    foreach ($users as $user) {
        $stmt = $pdo->prepare("INSERT INTO `user`(`id`, `email`, `first_name`, `last_name`) VALUES (:id, :email, :first_name, :last_name)");
        $stmt->execute([
            'id' => $user['id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name']
        ]);
    }
    echo '<h1>liste des users</h1>';

    echo '<h1>Les utilisateurs ont été ajoutés à la base de données avec succès !</h1>';

    var_dump($users);
});





$router->map('GET', '/users/[i:id]', function($id) {
    echo '<h1>Bienvenue sur la page de l\'utilisateur ' . $id . '</h1>';
});


$router->map('GET', '/books', function() {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=super-week', 'root', '');

    // Tableau de livres
    $books = [
        [
            'id' => 1,
            'title' => 'Gatsby le Magnifique',
            'content' => 'Gatsby le Magnifique est un roman de l\'écrivain américain F. Scott Fitzgerald',
            'id_user' => 1
        ],
        [
            'id' => 2,
            'title' => 'Les Misérables',
            'content' => 'Les Misérables est un roman de Victor Hugo publié en 1862',
            'id_user' => 2
        ],
        [
            'id' => 3,
            'title' => 'Le Comte de Monte-Cristo',
            'content' => 'Le Comte de Monte-Cristo est un roman d\'Alexandre Dumas',
            'id_user' => 3
        ]
    ];

    // Insertion des livres dans la base de données
    foreach ($books as $book) {
        $stmt = $pdo->prepare("INSERT INTO `book`(`id`, `title`, `content`, `id_user`) VALUES (:id, :title, :content, :id_user)");
        $stmt->execute([
            'id' => $book['id'],
            'title' => $book['title'],
            'content' => $book['content'],
            'id_user' => $book['id_user']
        ]);
    }

    echo '<h1>Les livres ont été ajoutés à la base de données avec succès !</h1>';
});


$match = $router->match();
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}


?>