<?php

namespace App\Models;

use CodeIgniter\Model;

class CarWashReviewModel extends Model
{
    protected $table = 'car_wash_reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['carwash_id', 'rating', 'comment_text', 'created_at'];
    protected $useTimestamps = false;

    // 리뷰를 세차장 ID 기준으로 가져오는 함수
    public function getReviewsByCarWashId($carwash_id)
    {
        return $this->where('carwash_id', $carwash_id)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // 새로운 리뷰를 추가하는 함수
    public function addReview($data)
    {
        return $this->insert($data);
    }

    // 평균 평점 계산 함수
    public function getAverageRating($carwash_id)
    {
        $builder = $this->builder();
        $builder->selectAvg('rating');
        $builder->where('carwash_id', $carwash_id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->rating : 0;
    }
}
