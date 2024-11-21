<?php

namespace App\Models;

use CodeIgniter\Model;

class EventCrawlingModel extends Model
{
    protected $table = 'event_crawling';
    protected $primaryKey = 'id';
    protected $allowedFields = ['brand', 'title', 'image_url', 'event_period', 'event_status', 'updated_at'];
}
