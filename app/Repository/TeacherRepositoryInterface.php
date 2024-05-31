<?php
namespace App\Repository;

//هاد الحكي مشان الdesign pattern



Interface TeacherRepositoryInterface{
//يعني كل شي فانكشن منعرفا هون ومنستدعيها بTeacherRepository مشان نحط فيها كودنا

    //get all teachers data
    public function getTeachers();


    //get all Specialization
    public function getSpecialization();


    //get all gender
    public function getGender();


    //store teacher
    public function storeTeacher($request);


    //edit page
    public function editTeacher($id);


    //update page
    public function updateTeacher($request);


    //delete teacher
    public function deleteTeacher($request);


}

