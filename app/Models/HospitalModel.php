<?php

namespace App\Models;

use CodeIgniter\Model;

class HospitalModel extends Model
{
    protected $table = 'MedicalInstitutions';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'OpenServiceName', 'BusinessName', 'FullAddress', 'PhoneNumber', 'PermitDate', 
        'Coordinate_X', 'Coordinate_Y'
    ];

    // 병원 목록 페이징 조회
    public function getHospitals($limit = 5, $offset = 0)
    {
        return $this->select('ID, BusinessName, FullAddress')
                    ->orderBy('ID', 'ASC')
                    ->limit($limit, $offset)
                    ->findAll();
    }

    // 카테고리별 병원 목록 조회
    public function getHospitalsByCategory($category, $limit = 5, $offset = 0)
    {
        return $this->select('ID, BusinessName, FullAddress, PhoneNumber')
                    ->where('OpenServiceName', $category)
                    ->orderBy('ID', 'ASC')
                    ->limit($limit, $offset)
                    ->findAll();
    }

    // 평균 평점을 기준으로 인기 시설 조회
    public function getPopularFacilitiesByRating($limit = 5)
    {
        return $this->select('MedicalInstitutions.ID, MedicalInstitutions.BusinessName, MedicalInstitutions.FullAddress, AVG(Reviews.rating) as avg_rating')
                    ->join('Reviews', 'Reviews.hospital_id = MedicalInstitutions.ID', 'inner')
                    ->groupBy('MedicalInstitutions.ID')
                    ->orderBy('avg_rating', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // 최근 추가된 시설 조회
    public function getRecentlyAddedFacilities($limit = 5)
    {
        return $this->select('ID, BusinessName, FullAddress, PermitDate')
                    ->orderBy('PermitDate', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    // 병원의 평균 평점과 리뷰 개수를 가져오는 메서드 추가
    public function getHospitalRatingSummary($hospitalId)
    {
        $query = $this->db->table('Reviews')
                          ->select('AVG(rating) as avg_rating, COUNT(*) as review_count')
                          ->where('hospital_id', $hospitalId)
                          ->get();

        return $query->getRowArray();
    }

    // 주어진 좌표에서 일정 거리 내에 있는 병원을 찾는 메서드
    public function getNearbyFacilities($latitude, $longitude, $distance = 10, $limit = 5)
    {
        $latitude = (float) $latitude;
        $longitude = (float) $longitude;

        $query = $this->db->query("
            SELECT ID, BusinessName, FullAddress, PhoneNumber,
            (6371 * acos(cos(radians($latitude)) * cos(radians(Coordinate_X)) * 
            cos(radians(Coordinate_Y) - radians($longitude)) + 
            sin(radians($latitude)) * sin(radians(Coordinate_X)))) AS distance
            FROM MedicalInstitutions
            WHERE Coordinate_X IS NOT NULL AND Coordinate_Y IS NOT NULL
            HAVING distance <= $distance
            ORDER BY distance
            LIMIT $limit
        ");

        return $query->getResultArray();
    }
}
