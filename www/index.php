<?php
require_once '../vendor/autoload.php';

/**
 * Setup Slim and Mustache components.
 *
 */
$app = new Slim(array(
    'mode' => 'development', // or 'production'
    'view' => new MustacheView(),
    'templates.path' => __DIR__ . '/app/templates',
));

/**
 * Mongo connection.
 */
/* --- Comment this line to enable MongoDB support ---
try {
    // Connection defaults
    $_SERVER['mongo.hostname'] = isset($_SERVER['mongo.hostname']) ? $_SERVER['mongo.hostname'] : 'localhost';
    $dsn = sprintf('%s', isset($_SERVER['mongo.socket']) && !empty($_SERVER['mongo.socket']) ? $_SERVER['mongo.socket'] : $_SERVER['mongo.hostname']);

    // If we need to authenticate, go ahead and do it
    if (isset($_SERVER['mongo.username']) && !empty($_SERVER['mongo.username'])) {
        $dsn = sprintf('%s:%s@%s', $_SERVER['mongo.username'], $_SERVER['mongo.password'], $dsn);
    }

    // Make the connection!
    $mongo = new Mongo(sprintf('mongodb://%s', $dsn), array('persist' => 'x'));
}

// An error has occured connecting to DB
catch (MongoConnectionException $e) {
    die("Could not connect to Mongo database");
}
// --- */

/**
 * MySQL PDO connection
 */
/* --- Comment this line to enable PDO support ---
try {
    // Connection defaults
    $_SERVER['pdo.hostname'] = isset($_SERVER['pdo.hostname']) ? $_SERVER['pdo.hostname'] : 'localhost';
    $_SERVER['pdo.database'] = isset($_SERVER['pdo.database']) ? $_SERVER['pdo.database'] : '';
    $_SERVER['pdo.username'] = isset($_SERVER['pdo.username']) ? $_SERVER['pdo.username'] : '';
    $_SERVER['pdo.password'] = isset($_SERVER['pdo.password']) ? $_SERVER['pdo.password'] : '';

    // Go ahead and create our connection!
    $pdo = new PDO(

        // If we need sockets, use them. If not, use hostname
        sprintf('mysql:' . (isset($_SERVER['pdo.socket']) && !empty($_SERVER['pdo.socket']) ? 'unix_socket' : 'host') . '=%s;dbname=%s', isset($_SERVER['pdo.socket']) && !empty($_SERVER['pdo.socket']) ? $_SERVER['pdo.socket'] : $_SERVER['pdo.hostname'], $_SERVER['pdo.database']),

        // Authenticate with these credentials
        sprintf('%s', $_SERVER['pdo.username']),
        sprintf('%s', $_SERVER['pdo.password'])
    );
}

// An error has occured connecting to DB
catch (PDOException $e) {
    die("Could not connect to MySQL database");
}
// --- */

/**
 * Route definitions.
 */
$app->get('/', function () use($app) {
    // Get our main layout and render it
    $app->render('layout.html', array(
        // Shows up in the <title> tags
        'app_title' => 'Backbone.js REST Boilerplate',

        // Use the release version from the build script
        'assets_js' => 'assets/js/' . ($app->config('mode') == 'development' ? 'libs/require.js' : 'app.js'),
        'assets_css' => 'assets/css/app.css',
    ));
});

/**
 * Initialize the application.
 */
$app->run();