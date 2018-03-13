<?php

class schoolClass
{
    private $className;
    private $classInstructor;
    private $schoolQuarter;
    private $instructorNotes;

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getClassInstructor()
    {
        return $this->classInstructor;
    }

    /**
     * @param mixed $classInstructor
     */
    public function setClassInstructor($classInstructor)
    {
        $this->classInstructor = $classInstructor;
    }

    /**
     * @return mixed
     */
    public function getSchoolQuarter()
    {
        return $this->schoolQuarter;
    }

    /**
     * @param mixed $schoolQuarter
     */
    public function setSchoolQuarter($schoolQuarter)
    {
        $this->schoolQuarter = $schoolQuarter;
    }

    /**
     * @return mixed
     */
    public function getInstructorNotes()
    {
        return $this->instructorNotes;
    }

    /**
     * @param mixed $instructorNotes
     */
    public function setInstructorNotes($instructorNotes)
    {
        $this->instructorNotes = $instructorNotes;
    }
}