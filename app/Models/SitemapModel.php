<?php

namespace App\Models;

use CodeIgniter\Model;

class SitemapModel extends Model
{
    protected $allowedFields = ['id', 'last_update_time'];

    /**
     * 공통 데이터 조회 메서드
     */
    private function getDataForSitemap($table, $columns, $limit, $offset)
    {
        return $this->db->table($table)
            ->select($columns)
            ->orderBy('id', 'ASC')
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();
    }

    /**
     * 공통 데이터 카운트 메서드
     */
    private function countData($table)
    {
        return $this->db->table($table)->countAllResults();
    }

    /**
     * 호텔 데이터 관련 메서드
     */
    public function getHotelsForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('hotel', 'id, last_update_time', $limit, $offset);
    }

    public function countAllHotels()
    {
        return $this->countData('hotel');
    }

    /**
     * 이벤트 데이터 관련 메서드
     */
    public function getEventsForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('events_ease', 'id, created_at', $limit, $offset);
    }

    public function countAllEvents()
    {
        return $this->countData('events_ease');
    }

    /**
     * 주유소 데이터 관련 메서드
     */
    public function getGasStationsForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('gas_station_info', 'id, data_reference_date', $limit, $offset);
    }

    public function countAllGasStations()
    {
        return $this->countData('gas_station_info');
    }

    /**
     * 주차장 데이터 관련 메서드
     */
    public function getParkingLotsForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('parking_lot', 'id, data_reference_date', $limit, $offset);
    }

    public function countAllParkingLots()
    {
        return $this->countData('parking_lot');
    }

    /**
     * 정비소 데이터 관련 메서드
     */
    public function getRepairShopsForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('automobile_repair_shop', 'id, data_reference_date', $limit, $offset);
    }

    public function countAllRepairShops()
    {
        return $this->countData('automobile_repair_shop');
    }

    /**
     * 세차장 데이터 관련 메서드
     */
    public function getCarWashesForSitemap($limit, $offset)
    {
        return $this->getDataForSitemap('car_wash_info', 'ID, Data_Reference_Date', $limit, $offset);
    }

    public function countAllCarWashes()
    {
        return $this->countData('car_wash_info');
    }
}
