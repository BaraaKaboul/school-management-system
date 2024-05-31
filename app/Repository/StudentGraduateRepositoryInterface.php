<?php

namespace App\Repository;

interface StudentGraduateRepositoryInterface
{
    public function index();


    public function create();


    public function softDelete($request);


    public function returnStudent($request);


    public function forceDelete($request);


    public function graduateStudent($request);
}
