<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use \Illuminate\Contracts\View\View as ViewContract;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getView(string $name, array $data = []): ViewContract
    {
        return View::make($name, array_merge($data, $this->getCommonViewData()));
    }

    private function getCommonViewData(): array
    {
        return [
            'navigation' => [
                'admin' => 'Dashboard',
                'users.index' => 'Users',
                'books.index' => 'Books',
                'categories.index' => 'Categories'
            ]
        ];
    }

}
