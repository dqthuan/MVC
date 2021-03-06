<?php

namespace App\controller;

use App\model\Student;
use App\model\StudentModel;

class StudentController
{
    protected $studentModel;
    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }
    public function show(){
        $student = $this->studentModel->getAll();
        include_once "src/view/list.php";
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            include_once "src/view/add.php";
        }
        else{
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $address = $_REQUEST['address'];
            $img = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp,'img/'.$img);
            $student = new Student($name, $age, $address, $img);
            $this->studentModel->addStudent($student);
            header('location:index.php');
        }
    }
    public function edit(){
        if($_SERVER['REQUEST_METHOD']== 'GET'){
            $id = $_REQUEST['id'];
            $student = $this->studentModel->getStudentById($id);
            include_once "src/view/edit.php";
        }
        else{
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $address = $_REQUEST['address'];
            $img = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp,'img/'.$img);
            $newStudent = new Student($name,$age,$address,$img);
            $newStudent->setId($id);
            $this->studentModel->editStudent($newStudent);
            header('location:index.php');
        }
    }

    public function delete(){
        $id = $_REQUEST['id'];
        $this->studentModel->deleteStudent($id);
        header('location:index.php');
    }

}