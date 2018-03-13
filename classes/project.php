<?php

class Project
{
    private $title;
    private $description;
    private $links;
    private $credentials;
    private $client;
    private $class;

    function __construct($title, $description, $links, Client $client, SchoolClass $class)
    {
        $this->setTitle($title);
        $this->setDescription($description);
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
}