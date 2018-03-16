<?php

class Client extends Contact
{
    private $companyName;
    private $address;
    private $zip;
    private $city;
    private $state;
    private $siteURL;

    public function __construct($company, $address, $zip, $city, $state, $url, $name, $title, $email, $phone)
    {
        parent::__constuct($name, $title, $email, $phone);
        $this->setCompanyName($company);
        $this->setLocation($address, $state, $city, $zip);
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
     * @param mixed $address
     * @param mixed $zip
     * @param mixed $city
     * @param mixed $state
     */
    public function setLocation($address, $zip, $city, $state)
    {
        //zipcode regular expression
        $regexp = '/^\d{5}(-?\d{4})?$/';
        //array of valid states
        $states = array('AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'FL',
            'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MD',
            'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
            'NY', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN',
            'TX', 'UT', 'VT', 'VA', 'WA', 'WV', 'WI', 'WY');

        $this->address = strip_tags($address);

        if(preg_match($regexp, $zip))
            $this->zip = $zip;

        $this->city = strip_tags($city);

        if(in_array($state, $states))
            $this->state = $state;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getSiteURL()
    {
        return $this->siteURL;
    }

    public function printClient()
    {
        //$company, $location, $url, $name, $title, $email, $phone
        echo "<p>$this->company</p>";
        echo "<p>$this->location</p>";
        echo "<p>$this->url</p>";
        echo "<p>$this->name</p>";
        echo "<p>$this->title</p>";
        echo "<p>$this->email</p>";
        echo "<p>$this->phone</p>";
    }
}