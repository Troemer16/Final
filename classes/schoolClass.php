<?php

class SchoolClass
{
    private $name;
    private $instructor;
    private $quarter;
    private $year;
    private $notes;

    public function __construct($name, $instructor, $quarter, $year, $notes)
    {
        $this->setName($name);
        $this->setInstructor($instructor);
        $this->setQuarter($quarter);
        $this->setYear($year);
        $this->setNotes($notes);
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);
    }

    /**
     * @param mixed $instructor
     */
    public function setInstructor($instructor)
    {
        $this->instructor = strip_tags($instructor);
    }

    /**
     * @param mixed $quarter
     */
    public function setQuarter($quarter)
    {
        $quarters = array('spring', 'summer', 'fall', 'winter');
        if(in_array($quarter, $quarters))
            $this->quarter = $quarter;
    }

    /**
     * @param int year
     */
    public function setYear($year)
    {
        if(is_numeric($year) && strlen($year) == 4)
            $this->year = $year;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = strip_tags($notes);
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
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * @return mixed
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }
}