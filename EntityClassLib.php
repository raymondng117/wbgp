<?php

class student {

    private $studentId;
    private $name;
    private $phoneNum;
    private $password;

    public function __construct($studentId, $name, $phoneNum) {
        $this->studentId = $studentId;
        $this->name = $name;
        $this->phoneNum = $phoneNum;

        $this->messages = array();
    }

    public function getStudentId() {
        return $this->studentId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhoneNum() {
        return $this->phoneNum;
    }
}

class user {

    private $userId;
    private $name;
    private $phoneNum;
    private $role;
    private $password;

    public function __construct($userId, $name, $phoneNum, $role) {
        $this->userId = $userId;
        $this->name = $name;
        $this->phoneNum = $phoneNum;
        $this->role = $role;
        $this->messages = array();
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhoneNum() {
        return $this->phoneNum;
    }
    
     public function getUserRole() {
        return $this->role;
    }
}

class registration {

    private $StudentId;
    private $SemesterCode;
    private $Year;
    private $Term;
    private $CourseCode;
    private $CourseTitle;

    public function __construct($year, $term, $courseCode, $courseTitle, $weeklyHours, $semesterCode) {
        $this->SemesterCode = $semesterCode;
        $this->Year = $year;
        $this->Term = $term;
        $this->CourseCode = $courseCode;
        $this->CourseTitle = $courseTitle;
        $this->WeeklyHours = $weeklyHours;
    }

    public function getCourseCode() {
        return $this->CourseCode;
    }

    public function getSemesterCode() {
        return $this->SemesterCode;
    }

    public function getYear() {
        return $this->Year;
    }

    public function getTerm() {
        return $this->Term;
    }

    public function getCourseTitle() {
        return $this->CourseTitle;
    }

    public function getWeeklyHours() {
        return $this->WeeklyHours;
    }
}

class course {

    private $CourseCode;
    private $Title;
    private $WeeklyHours;

    public function __construct($courseCode, $title, $weeklyHours) {
        $this->CourseCode = $courseCode;
        $this->Title = $title;
        $this->WeeklyHours = $weeklyHours;
    }

    public function getCourseCode() {
        return $this->CourseCode;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getWeeklyHours() {
        return $this->WeeklyHours;
    }
}

class Semester {

    private $SemesterCode;
    private $Term;
    private $Year;

    public function __construct($semesterCode, $term, $year) {
        $this->SemesterCode = $semesterCode;
        $this->Term = $term;
        $this->Year = $year;
    }

    public function getSemesterCode() {
        return $this->SemesterCode;
    }

    public function getTerm() {
        return $this->Term;
    }

    public function getYear() {
        return $this->Year;
    }
}
