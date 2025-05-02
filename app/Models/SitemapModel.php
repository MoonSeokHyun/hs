<?php

namespace App\Models;

use CodeIgniter\Model;

class SitemapModel extends Model
{
    /**
     * 기본 테이블 설정 (오류 방지용)
     */
    protected $table = 'store_info';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = ['id', 'last_update_time', 'updated_at'];

    /**
     * 공통 데이터 조회 메서드
     */
    private function getDataForSitemap(string $table, string $columns, int $limit, int $offset): array
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
    private function countData(string $table): int
    {
        return $this->db->table($table)->countAllResults();
    }

    /**
     * 타이어 판매소 데이터 관련 메서드
     */
    public function countAllStores(): int
    {
        return $this->countData('store_info');
    }

    public function getStoresForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('store_info', 'id', $limit, $offset);
    }

    /**
     * 공영주차장 데이터 관련 메서드
     */
    public function countAllParkingFacilities(): int
    {
        return $this->countData('parking_facility');
    }

    public function getParkingFacilitiesForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('parking_facility', 'id, 데이터기준일자', $limit, $offset);
    }

    /**
     * 견인차량 보관소 데이터 관련 메서드
     */
    public function countAllTowedVehicleStorages(): int
    {
        return $this->countData('towed_vehicle_storage');
    }

    public function getTowedVehicleStoragesForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('towed_vehicle_storage', 'id, data_reference_date', $limit, $offset);
    }

    /**
     * 세차장 데이터 관련 메서드
     */
    public function countAllCarWashes(): int
    {
        return $this->countData('car_wash_info');
    }

    public function getCarWashesForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('car_wash_info', 'ID, Data_Reference_Date', $limit, $offset);
    }

    /**
     * 정비소 데이터 관련 메서드
     */
    public function countAllRepairShops(): int
    {
        return $this->countData('automobile_repair_shop');
    }

    public function getRepairShopsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('automobile_repair_shop', 'id, data_reference_date', $limit, $offset);
    }

    /**
     * 주차장 데이터 관련 메서드
     */
    public function countAllParkingLots(): int
    {
        return $this->countData('parking_lot');
    }

    public function getParkingLotsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('parking_lot', 'id, data_reference_date', $limit, $offset);
    }

    /**
     * 주유소 데이터 관련 메서드
     */
    public function countAllGasStations(): int
    {
        return $this->countData('gas_station_info');
    }

    public function getGasStationsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('gas_station_info', 'id, data_reference_date', $limit, $offset);
    }

    /**
     * 이벤트 데이터 관련 메서드
     */
    public function countAllEvents(): int
    {
        return $this->countData('events_ease');
    }

    public function getEventsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('events_ease', 'id, created_at', $limit, $offset);
    }

    /**
     * 호텔 데이터 관련 메서드
     */
    public function countAllHotels(): int
    {
        return $this->countData('hotel');
    }

    public function getHotelsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('hotel', 'id, last_update_time', $limit, $offset);
    }

    /**
     * 전기차 충전소 데이터 관련 메서드
     */
    public function countAllEvStations(): int
    {
        return $this->countData('ev_stations');
    }

    public function getEvStationsForSitemap(int $limit, int $offset): array
    {
        return $this->getDataForSitemap('ev_stations', 'id', $limit, $offset);
    }
}
