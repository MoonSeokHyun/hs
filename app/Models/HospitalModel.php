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

    // TM(EPSG:5186) 좌표 기준 주변 시설 조회 — 바운딩박스 인덱스 후 피타고라스 거리 정렬
    public function getNearbyFacilities($tmX, $tmY, $distanceKm = 10, $limit = 5)
    {
        $tmX    = (float) $tmX;
        $tmY    = (float) $tmY;
        $margin = $distanceKm * 1000; // km → m

        return $this->db->query("
            SELECT ID, BusinessName, FullAddress, PhoneNumber,
                ROUND(SQRT(POW(Coordinate_X - ?, 2) + POW(Coordinate_Y - ?, 2)) / 1000, 2) AS distance
            FROM MedicalInstitutions
            WHERE Coordinate_X BETWEEN ? AND ?
              AND Coordinate_Y BETWEEN ? AND ?
            HAVING distance <= ?
            ORDER BY distance
            LIMIT ?
        ", [$tmX, $tmY,
           $tmX - $margin, $tmX + $margin,
           $tmY - $margin, $tmY + $margin,
           (float) $distanceKm, $limit
        ])->getResultArray();
    }
    public function searchHospitalsByName($name, $limit = 10, $offset = 0)
{
    return $this->select('ID, BusinessName, FullAddress')
                ->like('BusinessName', $name)
                ->orderBy('ID', 'ASC')
                ->limit($limit, $offset)
                ->findAll();
}

}
