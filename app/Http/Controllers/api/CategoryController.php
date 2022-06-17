<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        $data['categories'] = Category::withCount('services')->get();

        $message = 'التصنيفات';

        return $this->success($message, $data);
    }
}
