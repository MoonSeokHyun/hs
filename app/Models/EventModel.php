<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events_ease';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand', 'product_name', 'event_type', 'price', 'original_price',
        'discount_rate', 'image_url', 'created_at', 'category',
    ];

    public function countEventsByBrand($brand)
    {
        return $this->where('brand', $brand)->countAllResults();
    }

    public function getEventsByBrand($brand, $perPage, $offset)
    {
        return $this->where('brand', $brand)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($perPage, $offset);
    }
}
