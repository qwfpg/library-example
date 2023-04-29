<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryInterface;

abstract class ModelController extends Controller
{
    protected RepositoryInterface $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }
}
