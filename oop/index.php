<?php

require_once 'teacher.php';

//person  => name
//doctor => speciality
//teacher => university

class Person {
    public $name;

    public function setName($myname) {
        $this->name = $myname;
    }
}

class Doctor {
    public $speciality;

    public function __construct($special = null) {
        $this->speciality = $special;
    }
}

$teacher = new Teacher;
$personOb = new Person;
$DoctorOb = new Doctor('Dentist');

$uni = $teacher->university;
$personOb->setName('Mohammed Nasser');


echo "<pre>";
var_dump($uni);
echo "</pre>";

echo "<pre>";
var_dump($personOb->name);
echo "</pre>";

echo "<pre>";
var_dump($DoctorOb->speciality);
echo "</pre>";
