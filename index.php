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

    $f3->route('GET /create', function($f3) {
        $valid = false;

        if(isset($_POST['submit']))
        {
            if($valid)
            {
                //create project and add to database
//                $client = new Client($_POST['companyName'], $address, $zip, $city, $state,
//                    $_POST['siteUrl'], $_POST['contactName'], $_POST['contactTitle'],
//                    $_POST['contactEmail'], $_POST['contactPhone']);
//                $class = new SchoolClass($_POST['course'], $_POST['instructor'], $_POST['quarter'],
//                    $_POST['year'], $_POST['instructNotes']);
//                $project = new Project($_POST['title'], $_POST['description'], $_POST['username'], $_POST['password'],
//                    $_POST['url'].", ".$_POST['trello'].", ".$_POST['github'], $client, $class);
            }
            else
            {
                //set Fat-Free Hive
                $f3->set('companyName', $_POST['companyName']);
//                $f3->set('name', $address);
//                $f3->set('name', $zip);
//                $f3->set('name', $city);
//                $f3->set('name', $state);
                $f3->set('siteUrl', $_POST['siteUrl']);
                $f3->set('contactName', $_POST['contactName']);
                $f3->set('contactTitle', $_POST['contactTitle']);
                $f3->set('contactEmail', $_POST['contactEmail']);
                $f3->set('contactPhone', $_POST['contactPhone']);
                $f3->set('course', $_POST['course']);
                $f3->set('instructor', $_POST['instructor']);
                $f3->set('quarter', $_POST['quarter']);
                $f3->set('year', $_POST['year']);
                $f3->set('instructNotes', $_POST['instructNotes']);
                $f3->set('title', $_POST['title']);
                $f3->set('description', $_POST['description']);
                $f3->set('username', $_POST['username']);
                $f3->set('password', $_POST['password']);
                $f3->set('url', $_POST['url']);
                $f3->set('trello', $_POST['trello']);
                $f3->set('github', $_POST['github']);
            }
        }

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