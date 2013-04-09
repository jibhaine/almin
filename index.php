<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
ini_set("display_startup_errors","On");
date_default_timezone_set("Europe/Paris");


set_include_path(get_include_path() . PATH_SEPARATOR . "./vendor");
define('ROOT', dirname('.'));

require_once './vendor/autoload.php';


use ActiveRecord\Config;
/**
 * ACTIVERECORD SETTINGS
 */
ActiveRecord\Config::initialize(function($cfg)
{
    $models = ROOT.'/src/models';
    $cfg->set_model_directory($models);
    try {
        $cfg->set_connections(array(
            'development' => 'mysql://user:pass@localhost/dbname?charset=utf8'

        ));

    }  catch (\ActiveRecord\DatabaseException $e) {
        echo "Database error";
    } catch (\ActiveRecord\ConfigException $e) {
        echo "Config error";
    }

});
ActiveRecord\DateTime::$DEFAULT_FORMAT = 'd-M-Y';

use Slim\Slim;

Slim::registerAutoloader();

/**
 * TWIG SETTINGS
 */
use Slim\Extras\Views\Twig;
use Slim\Extras\Log\DateTimeFileWriter;

\Slim\Extras\Views\Twig::$twigDirectory = ROOT.'/vendor/Twig/lib/Twig';
\Slim\Extras\Views\Twig::$twigOptions = array(
    "debug" => true
);
if(is_writable(ROOT . '/cache/twig')) {
    \Slim\Extras\Views\Twig::$twigOptions['cache'] = ROOT . '/cache/twig';
}


\Slim\Extras\Views\Twig::$twigExtensions = array(
    'Twig_Extensions_Slim',
    'Twig_Extension_Debug',
    'Twig_Extensions_Markdown'
);

/**
 * Setup Slim and Twig components.
 *
 */
$app = new \Slim\Slim(array(
    'mode' => 'development', // or 'production'
    'templates.path' => ROOT.'/src/almin/views/',
    'debug' => false,
    'view' => new \Slim\Extras\Views\Twig(),
    'cookies.secret_key' => md5('appsecretkey'),

    'log.enabled'    => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => './logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
    ))
));
//$app->setName('almin');


/**
 * Automatic login based on user cookie
 * uncomment when user model has been defined
 */
$currentUser = null;
if($userid = $app->getEncryptedCookie('user_id')) {
    /*if(User::exists($userid)) {
         $currentUser = User::find($userid);
     } else {
         $currentUser = null;
     }
     */

} else {
    $currentUser = null;
}


/**
 * authentication middleware for is in routes you want protected
 *
 */
//authentication
$auth = function () use ($app, $currentUser) {
    if($currentUser instanceof User) {
        $app->config('cookies.user_id', $currentUser->id);
        $app->view()->appendData(array('currentUser' => $currentUser, 'app' => $app));
        $app->setEncryptedCookie('user_id', $currentUser->id, "+ 30 day");
        //$app->
        return true; //true if authenticated, false otherwise
    } else {
        //uncomment if redirect
        //$app->redirect($app->urlFor('login'));
    }
};
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


/*
* SET some globally available view data
*/
$resourceUri = $_SERVER['REQUEST_URI'];
$rootUri = $app->request()->getRootUri();
$assetUri = $rootUri;
$app->view()->appendData(
    array('currentUser' => $currentUser,
        'app' => $app,
        'rootUri' => $rootUri,
        'assetUri' => $assetUri.'/public/',
        'resourceUri' => $resourceUri
    ));

foreach(glob(ROOT.'/src/almin/routers/*.php') as $router) {
    include $router;
}

$app->get('/', function () use ($app) {

    $app->render('slim.html.twig');
});

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