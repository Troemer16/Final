<?php

/**
 * Client
 *
 * This class represents a client on a web dev portal
 * and keeps track of the information that they
 * will provide, such as companyName, address, zip, city, state, siteUrl
 * @author Pavel Radchuk <pradchuk@greenriver.edu>
 * @author Tyler Roemer <troemer@greenriver.edu>
 * @copyright 2018
 */
class Client extends Contact
{
    private $companyName;
    private $address;
    private $zip;
    private $city;
    private $state;
    private $siteURL;

    /**
     * Contact constructor.
     * @param $company name
     * @param $address address
     * @param $zip zip
     * @param $city city
     * @param $state state
     * @param $url url
     * @param $name name
     * @param $title title
     * @param $email email
     * @param $phone phone
     */
    public function __construct($company, $address, $zip, $city, $state, $url, $name, $title, $email, $phone)
    {
        parent::__construct($name, $title, $email, $phone);
        $this->setCompanyName($company);
        $this->setLocation($address, $zip, $city, $state);
        $this->setSiteURL($url);
    }

    /**
     * set the company name
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = strip_tags($companyName);
    }

    /**
     * set the company location
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
     * set the company siteUrl
     * @param $siteURL siteUrl
     */
    public function setSiteURL($siteURL)
    {
        //Find out how to validate urls
        $this->siteURL = $siteURL;
    }


    /**
     * get the company Name
     * @return string companyName
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * get the company Address
     * @return string address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * get the company zip
     * @return string zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * get the company City
     * @return string city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * get the company State
     * @return string state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * get the company SiteUrl
     * @return string siteUrl
     */
    public function getSiteURL()
    {
        return $this->siteURL;
    }
}