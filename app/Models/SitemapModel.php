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

    // 병원 데이터를 가져오는 메서드
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

    // 이벤트 데이터를 가져오는 메서드
    public function getEventsForSitemap($limit, $offset)
    {
        return $this->db->table('events_ease')
                        ->select('id, created_at') // 'created_at' 사용
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    // 이벤트 총 개수 가져오기
    public function countAllEvents()
    {
        return $this->db->table('events_ease')->countAllResults();
    }

    // 주유소 데이터를 가져오는 메서드
    public function getGasStationsForSitemap($limit, $offset)
    {
        return $this->db->table('gas_station_info')
                        ->select('id, data_reference_date')
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    // 주유소 총 개수 가져오기
    public function countAllGasStations()
    {
        return $this->db->table('gas_station_info')->countAllResults();
    }
}
