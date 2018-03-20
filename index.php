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

    //define arrays for form population
    $f3->set('states', array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL',
        'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
        'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
        'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN',
        'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY'));
    $f3->set('quarters', array('spring', 'summer', 'fall', 'winter'));

    //Define a default route
    $f3->route('GET|POST /', function($f3) {
        if($_SESSION['login'])
            $f3->set('login', 'logout');
        else
            $f3->set('login', 'login');

        $projects = Database::getProjects();
        foreach ($projects as &$project)
            $project['links'] = explode(', ', $project['links']);
        $f3->set('projects', $projects);

        if(!empty($_POST)){
            //if time permits come back and use json encode/decode
            $result = Database::getProject($_POST['id']);
            echo json_encode($result);
            return;
        }

        //load a template
        $template = new Template();
        echo $template->render('views/viewProjects.html');
    });

    $f3->route('GET|POST /create', function($f3) {
        if(!$_SESSION['login'])
            header("location:http://troemer.greenriverdev.com/328/Final/");


        $clients = Database::getClients();
        $f3->set('clients', $clients);

        $valid = true;

        if(isset($_POST['submit']))
        {
            if($valid)
            {
                //create client
                $client = new Client($_POST['companyName'], $_POST['address'], $_POST['zipCode'],
                    $_POST['city'], $_POST['state'], $_POST['siteUrl'], $_POST['contactName'],
                    $_POST['contactTitle'], $_POST['contactEmail'], $_POST['contactPhone']);

                //create class
                $class = new SchoolClass($_POST['course'], $_POST['instructor'], $_POST['quarter'],
                    $_POST['year'], $_POST['instructNotes']);

                //create object
                $project = new Project($_POST['title'], $_POST['description'], $_POST['username'], $_POST['password'],
                    $_POST['status'], $_POST['url'].", ".$_POST['trello'].", ".$_POST['github'], $client, $class);

                Database::addProject($project);
            }
            else
            {
                //set Fat-Free Hive
                $f3->set('curClient', $_POST['cClient']);
                $f3->set('companyName', $_POST['companyName']);
                $f3->set('address', $_POST['address']);
                $f3->set('zipCode', $_POST['zipCode']);
                $f3->set('city', $_POST['city']);
                $f3->set('selState', $_POST['state']);
                $f3->set('siteUrl', $_POST['siteUrl']);
                $f3->set('contactName', $_POST['contactName']);
                $f3->set('contactTitle', $_POST['contactTitle']);
                $f3->set('contactEmail', $_POST['contactEmail']);
                $f3->set('contactPhone', $_POST['contactPhone']);
                $f3->set('course', $_POST['course']);
                $f3->set('instructor', $_POST['instructor']);
                $f3->set('selQuarter', $_POST['quarter']);
                $f3->set('year', $_POST['year']);
                $f3->set('instructNotes', $_POST['instructNotes']);
                $f3->set('title', $_POST['title']);
                $f3->set('description', $_POST['description']);
                $f3->set('username', $_POST['username']);
                $f3->set('password', $_POST['password']);
                $f3->set('status', $_POST['status']);
                $f3->set('url', $_POST['url']);
                $f3->set('trello', $_POST['trello']);
                $f3->set('github', $_POST['github']);
            }
        }

        //load a template
        $template = new Template();
        echo $template->render('views/createProject.html');
    });

    $f3->route('GET|POST /edit/@id', function($f3, $params) {
        if(!$_SESSION['login'])
            header("location:http://troemer.greenriverdev.com/328/Final/");


        $project = Database::getProject($params['id']);

        if(isset($_POST['submit']))
        {
            //create client
            $client = new Client($_POST['companyName'], $_POST['address'], $_POST['zipCode'],
                $_POST['city'], $_POST['state'], $_POST['siteUrl'], $_POST['contactName'],
                $_POST['contactTitle'], $_POST['contactEmail'], $_POST['contactPhone']);

            //create class
            $class = new SchoolClass($_POST['course'], $_POST['instructor'], $_POST['quarter'],
                $_POST['year'], $_POST['instructNotes']);

            //create object
            $newProject = new Project($_POST['title'], $_POST['description'], $_POST['username'], $_POST['password'],
                $_POST['status'], $_POST['url'].", ".$_POST['trello'].", ".$_POST['github'], $client, $class);

            Database::updateProject($newProject, $params['id'], $project['clientId']);
            $f3->reroute('../');
        }


        $classes = array();
        for($i = 0; $i < sizeof($project['class']); $i++)
            array_push($classes, array($project['class'][$i], $project['instructor'][$i],
                $project['quarter'][$i], $project['year'][$i], $project['notes'][$i]));

        //set Fat-Free Hive
        $f3->set('curClient', $project['cClient']);
        $f3->set('companyName', $project['companyName']);
        $f3->set('address', $project['address']);
        $f3->set('zipCode', $project['zipcode']);
        $f3->set('city', $project['city']);
        $f3->set('selState', $project['state']);
        $f3->set('siteUrl', $project['siteURL']);
        $f3->set('contactName', $project['contactName']);
        $f3->set('contactTitle', $project['contactTitle']);
        $f3->set('contactEmail', $project['email']);
        $f3->set('contactPhone', $project['phone']);
        $f3->set('classes', $classes);
        $f3->set('title', $project['title']);
        $f3->set('description', $project['description']);
        $f3->set('username', $project['username']);
        $f3->set('password', $project['password']);
        $f3->set('status', $project['status']);
        $f3->set('url', $project['links'][0]);
        $f3->set('trello', $project['links'][1]);
        $f3->set('github', $project['links'][2]);

        //load a template
        $template = new Template();
        echo $template->render('views/editProject.html');
    });

    //Run Fat-Free
    $f3->run();
?>