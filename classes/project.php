<?php

class Project
{
    private $title;
    private $description;
    private $credentials;
    private $status;
    private $links;
    private $client;
    private $class;

    function __construct($title, $description, $username, $password, $status, $links, Client $client, SchoolClass $class)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setCredentials($username, $password);
        $this->setStatus($status);
        $this->setLinks($links);
        $this->client = $client;
        $this->class = $class;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = strip_tags($description);
    }

    /**
     * @param mixed $links
     */
    public function setLinks($links)
    {
        //Find out how to validate urls
        $this->links = $links;
    }

    /**
     * @param $username
     * @param $password
     */
    public function setCredentials($username, $password)
    {
        $this->credentials = array(
            "username" => strip_tags($username),
            "password" => strip_tags($password)
        );
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $statuses = array('active', 'pending', 'maintenance', 'retired');
        if(in_array($status, $statuses))
            $this->status = $status;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param SchoolClass $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }



    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return SchoolClass
     */
    public function getClass()
    {
        return $this->class;
    }

//    public function printProject()
//    {
//        echo "<p>$this->title</p>";
//        echo "<p>$this->description</p>";
//        echo "<p>$this->links</p>";
//        $this->client->printClient();
//        $this->class->printClass();
//    }
}