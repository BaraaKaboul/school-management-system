<?php

namespace App\Repository;

interface StudentRepositoryInterface{

    public function viewAddStudent();


    public function get_classroom($id);


    public function get_section($id);


    public function storeStudent($request);


    public function getStudents();


    public function editStudent($id);


    public function updateStudent($request);


    public function deleteStudent($request);


    public function showStudent($id);


    public function uploadAttachment($request);


    public function downloadAttachment($studentsname, $filename);


    public function deleteAttachment($request);
}
