<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events_ease'; // 테이블 이름
    protected $primaryKey = 'id'; // 기본 키
    protected $allowedFields = [
        'brand',
        'product_name',
        'event_type',
        'price',
        'original_price',
        'discount_rate',
        'image_url',
        'created_at',
        'category', // 추가된 필드
    ]; // 허용된 필드
}
