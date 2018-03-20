<?php

/**
 * Contact
 *
 * This class represents a contact on a web dev portal
 * and keeps track of the information that they
 * will provide, such as name, title, email, phone
 * @author Pavel Radchuk <pradchuk@greenriver.edu>
 * @author Tyler Roemer <troemer@greenriver.edu>
 * @copyright 2018
 */
class Contact
{
    protected $name;
    protected $title;
    protected $email;
    protected $phone;

    /**
     * Contact constructor.
     * @param $name name
     * @param $title title
     * @param $email email
     * @param $phone phone
     */
    public function __construct($name, $title, $email, $phone)
    {
        $this->setName($name);
        $this->setTitle($title);
        $this->setEmail($email);
        $this->setPhone($phone);
    }

    /**
     * set the contact name
     * @param $name name
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);
    }

    /**
     * set the contact title
     * @param $title title
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);
    }

    /**
     * set the contact email
     * @param $email email
     */
    public function setEmail($email)
    {
        //use regex here
        $this->email = $email;
    }

    /**
     * set the contact phone
     * @param $phone phone
     */
    public function setPhone($phone)
    {
        if(is_numeric($phone) && strlen($phone) == 10)
            $this->phone = $phone;
    }


    /**
     * get the contact name
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * get the contact title
     * @return string title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get the contact Email
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * get the contact Phone
     * @return string phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
}