<?php

/**
 * Project
 *
 * This class represents a project on a web dev portal
 * and keeps track of the information that they
 * will provide, such as title, description, credentials,
 * status, links, client, class
 * @author Pavel Radchuk <pradchuk@greenriver.edu>
 * @author Tyler Roemer <troemer@greenriver.edu>
 * @copyright 2018
 */
class Project
{
    private $title;
    private $description;
    private $credentials;
    private $status;
    private $links;
    private $client;
    private $class;

    /**
     * Project constructor.
     * @param $title title
     * @param $description description
     * @param $password password
     * @param $status status
     * @param $links links
     * @param $client Client
     * @param $class SchoolClass
     */
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
     * set the Project title
     * @param $title titile
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);
    }

    /**
     * set the Project description
     * @param $description description
     */
    public function setDescription($description)
    {
        $this->description = strip_tags($description);
    }

    /**
     * set the Project links
     * @param $links links
     */
    public function setLinks($links)
    {
        //Find out how to validate urls
        $this->links = $links;
    }

    /**
     * set the Project credentials
     * @param $username username
     * @param $password password
     */
    public function setCredentials($username, $password)
    {
        $this->credentials = array(
            "username" => strip_tags($username),
            "password" => strip_tags($password)
        );
    }

    /**
     * set the Project status
     * @param $status status
     */
    public function setStatus($status)
    {
        $statuses = array('active', 'pending', 'maintenance', 'retired');
        if(in_array($status, $statuses))
            $this->status = $status;
    }

    /**
     * set the Project client
     * @param $client client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * set the Project class
     * @param $class class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }



    /**
     * get the Project title
     * @return string Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get the Project description
     * @return string Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * get the Project links
     * @return string Links
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * get the Project credentials
     * @return string Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * get the Project status
     * @return string Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * get the Project client
     * @return string Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * get the Project class
     * @return string Class
     */
    public function getClass()
    {
        return $this->class;
    }
}