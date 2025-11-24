<?php

namespace App\Repositories;

use App\Models\food;
use App\Repositories\Contracts\foodRepositoryInterface;

class foodRepository implements foodRepositoryInterface
{
    public function getPopularfoods($limit = 4)
    {
        return food::where('is_popular', true)->take($limit)->get();
    }

    public function getAllNewfoods()
    {
        return food::latest()->get();
    }

    public function find($id)
    {
        return food::find($id);
    }

    public function getPrice($foodId)
    {
        $food = $this->find($foodId);
        return $food ? $food->price : 0;
    }
}
