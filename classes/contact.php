<?php

class Contact
{
    protected $name;
    protected $title;
    protected $email;
    protected $phone;

    public function __construct($name, $title, $email, $phone)
    {
        $this->setName($name);
        $this->setTitle($title);
        $this->setEmail($email);
        $this->setPhone($phone);
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        //use regex here
        $this->email = $email;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        if(is_numeric($phone) && strlen($phone) == 10)
            $this->phone = $phone;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
}