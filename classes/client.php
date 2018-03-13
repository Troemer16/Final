<?php

class Client extends Contact
{
    private $companyName;
    private $location;
    private $siteURL;

    public function __construct($company, $location, $url, $name, $title, $email, $phone)
    {
        parent::__constuct($name, $title, $email, $phone);
        $this->setCompanyName($company);
        $this->setLocation($location);
        $this->setSiteURL($url);
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = strip_tags($companyName);
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = strip_tags($location);
    }

    /**
     * @param mixed $siteURL
     */
    public function setSiteURL($siteURL)
    {
        //Find out how to validate urls
        $this->siteURL = $siteURL;
    }


    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getSiteURL()
    {
        return $this->siteURL;
    }
}