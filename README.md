# Basic PHP Routing

A basic PHP router I made for small personal projects. Everything should work with PHP version 8.

## Setting up

1. Send all non-static asset requests to the index.php file, this is the starting point of the framework.
2. Make sure a user can't reach any PHP files in the app folder.
3. Test the application by starting your web server and visiting the site, it should show the "Hello, world!" ( `app/view/hello.view.php` ) page.

## Routing

The routing is a duct-tape version of the Laravel routing system. All the routing functions are located in `app/core/router.php` file.

To display a basic view from the `/view` folder. 

    Router::get("<ROUTE LOCATION>", "<NAME OF VIEW>");


Route request to a controller in the `/controller` folder. Make use of the `use` keyword to load in the controller.

    Router::get("<ROUTE LOCATION>", [ExampleController::class, "<FUNCTION NAME>"]);


Execute your own custom function on request.

    Router::get("<ROUTE LOCATION>", function() {
        // SOME CODE
    });

Use `::get` for GET requests and `::post` for POST requests. The routes are located in `app/routes/routes.php`, this file also contains examples.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).