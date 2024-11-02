<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'Reviews';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['hospital_id', 'user_name', 'rating', 'comment', 'created_at'];
    
    public function getReviewsByHospital($hospital_id)
    {
        return $this->where('hospital_id', $hospital_id)->findAll();
    }
}
