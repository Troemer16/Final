<?php

//include configuration file
require_once ('/home/troemerg/public_html/config.php');

class Database
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

    public static function addProject($project)
    {
        self::initialize();

        //Add Client*****************************************
        //Define the query
        $sql = "INSERT INTO `clients`(`companyName`, `location`, `siteURL`) 
                VALUES (:name, :location, :url)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);
        $temp = $project->getClient();

        //Bind the parameters
        $statement->bindParam(':name', $temp->getCompanyName(), PDO::PARAM_STR);
        $statement->bindParam(':location', $temp->getLocation(), PDO::PARAM_STR);
        $statement->bindParam(':url', $temp->getSiteURL(), PDO::PARAM_STR);

        //Execute
        $statement->execute();

        $client = self::$dbh->lastInsertId();


        //Add Contact************************************
        //Define the query
        $sql = "INSERT INTO `contacts`(`name`, `title`, `email`, `phone`, clientId`) 
                VALUES (:name, :title, :email, :phone, :client)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':name', $temp->getName(), PDO::PARAM_STR);
        $statement->bindParam(':title', $temp->getTitle(), PDO::PARAM_STR);
        $statement->bindParam(':email', $temp->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $temp->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':client', $client, PDO::PARAM_STR);

        //Execute
        $statement->execute();


        //Add Class*******************************************
        //Define the query
        $sql = "INSERT INTO `classes`(`name`, `instructor`, `quarter`, `notes`) 
                VALUES (:name, :instructor, :quarter, :notes)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);
        $temp = $project->getClass();

        //Bind the parameters
        $statement->bindParam(':name', $temp->getName(), PDO::PARAM_STR);
        $statement->bindParam(':instructor', $temp->getInstructor(), PDO::PARAM_STR);
        $statement->bindParam(':quarter', $temp->getQuarter(), PDO::PARAM_STR);
        $statement->bindParam(':notes', $temp->getNotes(), PDO::PARAM_STR);

        //Execute
        $statement->execute();

        $class = self::$dbh->lastInsertId();


        // Add Project****************************************
        //Define the query
        $sql = "INSERT INTO `projects`(`title`, `description`, `links`, `username`, `password`, `clientId`, `classId`) 
                VALUES (:title, :description, :links, :username, :password, :client, :class)";

        //Prepare the statement
        $statement = self::$dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(':title', $project->getTitle(), PDO::PARAM_STR);
        $statement->bindParam(':description', $project->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(':links', implode(", ", $project->getLinks()), PDO::PARAM_STR);
        $statement->bindParam(':username', $project->getCredentials()['username'], PDO::PARAM_STR);
        $statement->bindParam(':password', $project->getCredentials()['password'], PDO::PARAM_STR);
        $statement->bindParam(':client', $client, PDO::PARAM_STR);
        $statement->bindParam(':class', $class, PDO::PARAM_STR);

        //Execute
        $statement->execute();
    }

    public static function getProjects()
    {
//        //Define the query
//        $sql = "SELECT member_id, fname, lname, age, phone, email, state,
//                    gender, seeking, premium, interests FROM Members ORDER BY lname";
//
//        //Prepare the statement
//        $statement = $this->dbh->prepare($sql);
//
//        //Execute the statement
//        $statement->execute();
//
//        //Process the result
//        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//        return $result;
    }

    public static function getProject($id)
    {

    }
}