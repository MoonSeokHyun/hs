<?php

namespace App\Models;

use CodeIgniter\Model;

class SitemapModel extends Model
{
    protected $table = 'MedicalInstitutions';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'ID', 'BusinessName', 'OpenServiceName', 'LastUpdateTime'
    ];

    // 사이트맵용 병원 데이터를 가져오는 메서드
    public function getHospitalsForSitemap($limit, $offset)
    {
        return $this->select('ID, LastUpdateTime')
                    ->orderBy('ID', 'ASC')
                    ->findAll($limit, $offset);
    }

    // 병원 총 개수 가져오기
    public function countAllHospitals()
    {
        return $this->countAll();
    }
}
