<?php
/*ini_set('display_errors', 'On');

require __DIR__ . '/vendor/autoload.php';

$base = dirname($_SERVER['SCRIPT_NAME']) . '/';
if ($base == '//') {
    $base = '/';
}
define('BASE', $base);

use App\App;
//cargar entorno de configuracion
//Session::init();

App::run();*/
ini_set('display_errors','On');
   

    require __DIR__.'/vendor/autoload.php';
    
    use App\App;
    
    $conf=App::init();
    //constants d'enrutament i BBDD
    define('BASE',$conf['web']);
    define('ROOT',$conf['root']);
    define('DSN',$conf['driver'].':host='.$conf['dbhost'].';dbname='.$conf['dbname']);
    define('USR',$conf['dbuser']);
    define('PWD',$conf['dbpass']);

    App::run();