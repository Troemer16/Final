<?php

//include configuration file
require_once ('/home/troemerg/public_html/config.php');

final class Database
{
    private static $dbh;
    private static $initialized = false;

    private static function initialize()
    {
        if(self::$initialized)
            return;

        try {
            //instantiate pdo
            self::$dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            self::$initialized = true;
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getProjects()
    {
        self::initialize();

        //Define the query
        $sql = "SELECT projectId, title, description, links, status, companyName FROM projects, clients
                WHERE clients.clientId = projects.clientId";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function getProject($id)
    {
        self::initialize();

        $project = array(
            'title' => "",
            'description' => "",
            'links' => array(),
            'status' => "",
            'companyName' => "",
            'address' => "",
            'zipcode' => "",
            'city' => "",
            'state' => "",
            'siteURL' => "",
            'contactName' => array(),
            'contactTitle' => array(),
            'email' => array(),
            'phone' => array(),
            'class' => array(),
            'instructor' => array(),
            'quarter' => array(),
            'year' => array(),
            'notes' => array()
        );

        /*
         * SELECT projects.title, description, links, status, companyName, address, zipcode, city, state,
                siteURL, contacts.name as contactName, contacts.title as contactTitle, email,
                phone, classes.name as class, instructor, quarter, year, notes
                FROM projects, clients, contacts, classes, ProjectsClasses
                WHERE projects.projectId = 1 AND clients.clientId = projects.clientId
                AND contacts.clientId = clients.clientId AND ProjectsClasses.projectId = 1
                AND ProjectsClasses.classId = classes.classId
         */

        //Get Project details
        //Define the query
        $sql = "SELECT title, description, links, status, clientId FROM projects
                WHERE projectId = :id";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetch();

        //Add results to array
        $project['title'] = $result['title'];
        $project['description'] = $result['description'];
        $project['links'] = explode(', ', $result['links']);
        $project['status'] = $result['status'];
        $clientId = $result['clientId'];


        //Get client details
        //Define the query
        $sql = "SELECT companyName, address, zipcode, city, state, siteURL FROM clients
                WHERE clientId = :id";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $clientId, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetch();

        //Add results to array
        $project['companyName'] = $result['companyName'];
        $project['address'] = $result['address'];
        $project['zipcode'] = $result['zipcode'];
        $project['city'] = $result['city'];
        $project['state'] = $result['state'];
        $project['siteURL'] = $result['siteURL'];


        //Get contacts
        //Define the query
        $sql = "SELECT contacts.name as contactName, contacts.title as contactTitle, email, phone FROM contacts
                WHERE clientId = :id";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $clientId, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        //Add results to array
        foreach ($result as $row){
            array_push($project['contactName'], $row['contactName']);
            array_push($project['contactTitle'], $row['contactTitle']);
            array_push($project['email'], $row['email']);
            array_push($project['phone'], $row['phone']);
        }


        //Get classes
        //Define the query
        $sql = "SELECT classes.name as class, instructor, quarter, year, notes FROM classes, ProjectsClasses
                WHERE projectId = :id AND classes.classId = ProjectsClasses.classId";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        //Add results to array
        foreach ($result as $row){
            array_push($project['class'], $row['class']);
            array_push($project['instructor'], $row['instructor']);
            array_push($project['quarter'], $row['quarter']);
            array_push($project['year'], $row['year']);
            array_push($project['notes'], $row['notes']);
        }

        return $project;
    }

    public static function getClients()
    {
        self::initialize();

        //Define the query
        $sql = "SELECT clientId, companyName FROM clients";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function addProject($project)
    {
        self::initialize();

        //Add Client*****************************************
        $client = self::addClient($project->getClient());


        //Add Contact************************************
        self::addContact($project->getClient(), $client);


        //Add Class*******************************************
        $class = self::addClass($project->getClass());


        // Add Project****************************************
        //Define the query
        $sql = "INSERT INTO `projects`(`title`, `description`, `status`, `links`, `username`, `password`, `clientId`)
                VALUES (:title, :description, :status, :links, :username, :password, :client)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':title', $project->getTitle(), PDO::PARAM_STR);
        $statement->bindParam(':description', $project->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(':status', $project->getStatus(), PDO::PARAM_STR);
        $statement->bindParam(':links', $project->getLinks(), PDO::PARAM_STR);
        $statement->bindParam(':username', $project->getCredentials()['username'], PDO::PARAM_STR);
        $statement->bindParam(':password', $project->getCredentials()['password'], PDO::PARAM_STR);
        $statement->bindParam(':client', $client, PDO::PARAM_STR);

        //Execute
        $statement->execute();

        $id = self::$dbh->lastInsertId();

        //Add Class & Project to junction table ********************************
        //Define the query
        $sql = "INSERT INTO `ProjectsClasses`(`projectId`, `classId`) VALUES (:project, :class)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':project', $id, PDO::PARAM_STR);
        $statement->bindParam(':class', $class, PDO::PARAM_STR);

        //Execute
        $statement->execute();
    }

    private static function addClient($client)
    {
        //Define the query
        $sql = "INSERT INTO `clients`(`companyName`, `address`, `zipcode`, `city`, `state`, `siteURL`) 
                VALUES (:name, :address, :zipcode, :city, :state, :url)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':name', $client->getCompanyName(), PDO::PARAM_STR);
        $statement->bindParam(':address', $client->getAddress(), PDO::PARAM_STR);
        $statement->bindParam(':zipcode', $client->getZip(), PDO::PARAM_STR);
        $statement->bindParam(':city', $client->getCity(), PDO::PARAM_STR);
        $statement->bindParam(':state', $client->getState(), PDO::PARAM_STR);
        $statement->bindParam(':url', $client->getSiteURL(), PDO::PARAM_STR);

        //Execute
        $statement->execute();

        return self::$dbh->lastInsertId();
    }

    public static function addContact($client, $clientId)
    {
        //Define the query
        $sql = "INSERT INTO `contacts`(`name`, `title`, `email`, `phone`, `clientId`) 
                VALUES (:name, :title, :email, :phone, :client)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':name', $client->getName(), PDO::PARAM_STR);
        $statement->bindParam(':title', $client->getTitle(), PDO::PARAM_STR);
        $statement->bindParam(':email', $client->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $client->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':client', $clientId, PDO::PARAM_STR);

        //Execute
        $statement->execute();
    }

    public static function addClass($class)
    {
        //Define the query
        $sql = "INSERT INTO `classes`(`name`, `instructor`, `quarter`, `year`, `notes`) 
                VALUES (:name, :instructor, :quarter, :year, :notes)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':name', $class->getName(), PDO::PARAM_STR);
        $statement->bindParam(':instructor', $class->getInstructor(), PDO::PARAM_STR);
        $statement->bindParam(':quarter', $class->getQuarter(), PDO::PARAM_STR);
        $statement->bindParam(':year', $class->getYear(), PDO::PARAM_STR);
        $statement->bindParam(':notes', $class->getNotes(), PDO::PARAM_STR);

        //Execute
        $statement->execute();

        return self::$dbh->lastInsertId();
    }
}