<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {  // HOME PAGE WITH ENTER FORMS
        $stores = Store::getAll();
        $brands = Brand::getAll();

        return $app['twig']->render('index.html.twig', array('stores' => $stores, 'brands' => $brands));
    });

    $app->post('/add_store', function() use ($app) {  // ADD A STORE TO DB, REDIRECTS HOME
        $new_store = new Store(filter_var($_POST['name']), FILTER_SANITIZE_MAGIC_QUOTES);
        $new_store->save();

        return $app->redirect('/');
    });

    $app->post('/add_brand', function() use ($app) {  // ADD A BRAND TO DB, REDIRECTS HOME
        $new_brand = new Brand(filter_var($_POST['name']), FILTER_SANITIZE_MAGIC_QUOTES);
        $new_brand->save();

        return $app->redirect('/');
    });

    $app->delete('/delete_stores', function() use ($app) {  // DELETES ALL STORES FROM DB, REDIRECTS HOME
        Store::deleteAll();

        return $app->redirect('/');
    });

    $app->delete('/delete_brands', function() use ($app) {  // DELETES ALL BRANDS FROM DB, REDIRECTS HOME
        Brand::deleteAll();

        return $app->redirect('/');
    });

    $app->post('/store_page', function() use ($app) {  // ADD A STORE TO DB, REDIRECTS HOME

        return $app['twig']->render('store_page.html.twig');
    });

    $app->post('/brand_page', function() use ($app) {  // ADD A BRAND TO DB, REDIRECTS HOME


        return $app['twig']->render('brand_page.html.twig');
    });
    
    $app->get('/edit/{id}', function($id) use ($app) {
        $store = Store::find($id);
        $brand = Brand::getAll();
        $store_brands = $store->getBrands();

        return $app['twig']->render('store_page.html.twig', array('store' => $store, 'brand' => $brand, 'store_brands' => $store_brands));
    });

    $app->get('/edit/{id}', function($id) use ($app) {
        $brand = Brand::find($id);
        $store = Store::getAll();
        $brand_stores = $brand->getStores();

        return $app['twig']->render('brand_page.html.twig', array('brand' => $brand, 'store' => $store, 'brand_stores' => $brand_stores));
    });

    return $app;
?>
