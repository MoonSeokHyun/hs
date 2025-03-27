<?php

namespace App\Models;

use CodeIgniter\Model;

class EventImagesModel extends Model
{
    protected $table = 'EventImages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'event_id',
        'image_url',
        'local_path'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;

    protected $validationRules = [
        'event_id' => 'required|integer',
        'image_url' => 'required|valid_url',
        'local_path' => 'required|string'
    ];
}
