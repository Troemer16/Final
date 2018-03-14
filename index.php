<?php
    //php error reporting
    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    //session
    session_start();

    //require the autoload file
    require_once ('vendor/autoload.php');

    //create an instance of the base class
    $f3 = Base::instance();

    //set debug level
    //0 = no error reporting, 3 = report all errors
    $f3->set('DEBUG', 3);

    //Define a default route
    $f3->route('GET /', function($f3) {
        $projects = Database::getProjects();
        $f3->set('projects', $projects);

        //load a template
        $template = new Template();
        echo $template->render('views/viewProjects.html');
    });

    $f3->route('GET /create', function() {
        //load a template
        $template = new Template();
        echo $template->render('views/createProject.html');
    });

    $f3->route('GET /edit', function() {
        //load a template
        $template = new Template();
        echo $template->render('views/createProject.html');
    });

    //Run Fat-Free
    $f3->run();
?>