<?php

namespace App\Models;

use CodeIgniter\Model;

class SitemapModel extends Model
{
    protected $table = 'hotel'; // 호텔 테이블 이름
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'business_name', 'last_update_time'
    ];

    // 호텔 데이터를 가져오는 메서드
    public function getHotelsForSitemap($limit, $offset)
    {
        return $this->db->table($this->table)
                        ->select('id, last_update_time') // 'last_update_time' 컬럼 사용
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    // 호텔 총 개수 가져오기
    public function countAllHotels()
    {
        return $this->db->table($this->table)->countAllResults();
    }

    // 기존 이벤트 메서드
    public function getEventsForSitemap($limit, $offset)
    {
        return $this->db->table('events_ease')
                        ->select('id, created_at') // 이벤트 테이블
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    public function countAllEvents()
    {
        return $this->db->table('events_ease')->countAllResults();
    }

    // 기존 주유소 메서드
    public function getGasStationsForSitemap($limit, $offset)
    {
        return $this->db->table('gas_station_info')
                        ->select('id, data_reference_date') // 주유소 테이블
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    public function countAllGasStations()
    {
        return $this->db->table('gas_station_info')->countAllResults();
    }

    // 기존 주차장 메서드
    public function getParkingLotsForSitemap($limit, $offset)
    {
        return $this->db->table('parking_lot')
                        ->select('id, data_reference_date') // 주차장 테이블
                        ->orderBy('id', 'ASC')
                        ->limit($limit, $offset)
                        ->get()
                        ->getResultArray();
    }

    public function countAllParkingLots()
    {
        return $this->db->table('parking_lot')->countAllResults();
    }
}
