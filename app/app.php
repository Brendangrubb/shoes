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

    $app->delete('/', function() use ($app) { // DELETE ALL STORES, BRANDS AND ASSOCIATIONS
        Store::deleteAll();
        Brand::deleteAll();
        $GLOBALS['DB']->exec("DELETE FROM stores_brands;");

        return $app->redirect('/');
    });

    $app->post('/store_page', function() use ($app) {  // ADD A STORE TO DB, REDIRECTS HOME

        return $app['twig']->render('store_page.html.twig');
    });

    $app->post('/brand_page', function() use ($app) {  // ADD A BRAND TO DB, REDIRECTS HOME


        return $app['twig']->render('brand_page.html.twig');
    });

    $app->get('/store/{id}', function($id) use ($app) { // STORE PAGE, LISTS ASSOCIATED BRANDS
        $store = Store::find($id);
        $brands = Brand::getAll();
        $store_brands = $store->getBrands();

        return $app['twig']->render('store_page.html.twig', array('store' => $store, 'brands' => $brands, 'store_brands' => $store_brands));
    });

    $app->get('/brand/{id}', function($id) use ($app) { // BRAND PAGE, ADDS AND LISTS ASSOCIATED STORES
        $brand = Brand::find($id);
        $stores = Store::getAll();
        $brand_stores = $brand->getStores();

        return $app['twig']->render('brand_page.html.twig', array('brand' => $brand, 'stores' => $stores, 'brand_stores' => $brand_stores));
    });

    $app->post("/store/{id}", function($id) use ($app) { // ADD BRAND TO STORE AND REDIRECT TO STORE PAGE
        $store = Store::find($id);
        $store->addBrand($_POST['brand_id']);

        return $app->redirect("/store/" . $id);
    });


    $app->get("/store/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);

        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $new_name = $_POST['name'];
        $store = Store::find($id);
        $store->update($new_name);

        return $app->redirect("/store/" . $id);
    });

    $app->post("/brand/{id}", function($id) use ($app) { // ADD STORE TO BRAND AND REDIRECT TO BRAND PAGE
        $brand = Brand::find($id);
        $brand->addStore($_POST['store_id']);

        return $app->redirect("/brand/" . $id);
    });

    return $app;
?>
