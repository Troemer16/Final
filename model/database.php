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

        //Define the query
        $sql = "SELECT title, description, links, status FROM projects
                WHERE projectId = :id";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        //Execute the statement
        $statement->execute();

        //Process the result
        $result = $statement->fetch();

        return $result;
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