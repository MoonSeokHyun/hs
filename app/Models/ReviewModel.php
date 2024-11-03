<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'Reviews';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['hospital_id', 'user_name', 'rating', 'comment', 'created_at'];

    // 병원의 평균 평점과 리뷰 개수를 가져오는 메서드
    public function getAverageRatingByHospital($hospital_id)
    {
        return $this->select('AVG(rating) as average_rating, COUNT(*) as review_count')
                    ->where('hospital_id', $hospital_id)
                    ->get()
                    ->getRowArray();
    }

    // 특정 병원에 대한 모든 리뷰 가져오기
    public function getReviewsByHospital($hospital_id)
    {
        return $this->where('hospital_id', $hospital_id)->findAll();
    }

    // 최근 등록된 리뷰를 가져오는 메서드
    public function getLatestReviews($limit = 5)
    {
        return $this->select('Reviews.*, MedicalInstitutions.BusinessName')
                    ->join('MedicalInstitutions', 'MedicalInstitutions.ID = Reviews.hospital_id')
                    ->orderBy('Reviews.created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
