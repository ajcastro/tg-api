<?php

namespace App\Http\Queries;

interface QueryContract
{
    public function withAllDeclarations();

    public function withFields();

    public function withInclude();

    public function withFilter();

    public function withSort();
}
