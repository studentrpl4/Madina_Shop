<?php

namespace App\Repositories\Contacts;

Interface FoodRepositoryInterface
{
    public function getPopularFoods($limit);

    public function getAllNewFoods();

    public function find($id);

    public function getPrice($ticketId);
}