<?php

class Client extends Contact
{
    private $companyName;
    private $location;
    private $siteURL;

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getSiteURL()
    {
        return $this->siteURL;
    }

    /**
     * @param mixed $siteURL
     */
    public function setSiteURL($siteURL)
    {
        $this->siteURL = $siteURL;
    }
}