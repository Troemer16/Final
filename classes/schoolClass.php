<?php

/**
 * SchoolClass
 *
 * This class represents a schoolClass on a web dev portal
 * and keeps track of the information that they
 * will provide, such as name, instructor, quarter, year, notes
 * @author Pavel Radchuk <pradchuk@greenriver.edu>
 * @author Tyler Roemer <troemer@greenriver.edu>
 * @copyright 2018
 */
class SchoolClass
{
    private $name;
    private $instructor;
    private $quarter;
    private $year;
    private $notes;

    /**
     * SchoolClass constructor.
     * @param $name name
     * @param $instructor instructor
     * @param $quarter quarter
     * @param $year year
     * @param $notes notes
     */
    public function __construct($name, $instructor, $quarter, $year, $notes)
    {
        $this->setName($name);
        $this->setInstructor($instructor);
        $this->setQuarter($quarter);
        $this->setYear($year);
        $this->setNotes($notes);
    }

    /**
     * set SchoolClass name
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);
    }

    /**
     * set SchoolClass instructor
     * @param $instructor instructor
     */
    public function setInstructor($instructor)
    {
        $this->instructor = strip_tags($instructor);
    }

    /**
     * set SchoolClass quarter
     * @param $quarter quarter
     */
    public function setQuarter($quarter)
    {
        $quarters = array('spring', 'summer', 'fall', 'winter');
        if(in_array($quarter, $quarters))
            $this->quarter = $quarter;
    }

    /**
     * set SchoolClass year
     * @param int year
     */
    public function setYear($year)
    {
        if(is_numeric($year) && strlen($year) == 4)
            $this->year = $year;
    }

    /**
     * set SchoolClass notes
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = strip_tags($notes);
    }

    /**
     * get the SchoolClass name
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * get SchoolClass instructor
     * @return string instructor
     */
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * get SchoolClass quarter
     * @return string quarter
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * get SchoolClass notes
     * @return string notes
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * get SchoolClass year
     * @return int year
     */
    public function getYear()
    {
        return $this->year;
    }
}