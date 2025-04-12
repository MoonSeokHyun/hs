<?php

namespace App\Cells;

use App\Models\EventModel;
use App\Models\HotelModel;
use App\Models\ParkingLotModel;
use App\Models\AutomobileRepairShopModel;
use App\Models\GasStationModel;

class ExtraInfoCell
{
    /**
     * 이벤트, 호텔, 주차장, 정비소, 주유소 데이터를 가져와 뷰를 렌더링합니다.
     *
     * @return string 렌더링된 HTML
     */
    public function render()
    {
        // 각 모델 인스턴스 생성
        $eventModel      = new EventModel();
        $hotelModel      = new HotelModel();
        $parkingLotModel = new ParkingLotModel();
        $repairShopModel = new AutomobileRepairShopModel();
        $gasStationModel = new GasStationModel();

        // 각 모델에서 최대 3개 데이터 조회
        $eventsRaw      = $eventModel->findAll(3);
        $hotelsRaw      = $hotelModel->findAll(3);
        $parkingRaw     = $parkingLotModel->findAll(3);
        $repairShopsRaw = $repairShopModel->findAll(3);
        $gasStationsRaw = $gasStationModel->findAll(3);

        // 데이터 재매핑 (각 항목에 id 키 추가)
        $mappedEvents = array_map(function($item) {
            return [
                'id'            => $item['id'] ?? '',
                'name'          => $item['product_name']   ?? '',
                'type'          => $item['event_type']     ?? '',
                'image'         => $item['image_url']      ?? '',
                'brand'         => $item['brand']          ?? '',
                'price'         => $item['price']          ?? '',
                'discount_rate' => $item['discount_rate']  ?? '',
                'created_at'    => $item['created_at']     ?? '',
            ];
        }, $eventsRaw);

        $mappedHotels = array_map(function($item) {
            return [
                'id'      => $item['id'] ?? '',
                'name'    => $item['business_name']     ?? '',
                'address' => $item['site_full_address'] ?? '',
                'phone'   => $item['contact_number']    ?? '',
            ];
        }, $hotelsRaw);

        $mappedParking = array_map(function($item) {
            return [
                'id'      => $item['id'] ?? '',
                'name'    => $item['name']          ?? '',
                'address' => $item['address_road']  ?? '',
                'phone'   => $item['phone_number']  ?? '',
            ];
        }, $parkingRaw);

        $mappedRepairShops = array_map(function($item) {
            return [
                'id'      => $item['id'] ?? '',
                'name'    => $item['repair_shop_name'] ?? '',
                'address' => $item['road_address']     ?? '',
                'phone'   => $item['phone_number']     ?? '',
            ];
        }, $repairShopsRaw);

        $mappedGasStations = array_map(function($item) {
            return [
                'id'      => $item['id'] ?? '',
                'name'    => $item['gas_station_name'] ?? '',
                'address' => $item['road_address']     ?? '',
                'phone'   => $item['phone_number']     ?? '',
            ];
        }, $gasStationsRaw);

        $data = [
            'events'      => $mappedEvents,
            'hotels'      => $mappedHotels,
            'parkingLots' => $mappedParking,
            'repairShops' => $mappedRepairShops,
            'gasStations' => $mappedGasStations,
        ];

        // "includes/extra_info" 뷰 파일에 데이터 전달하여 렌더링합니다.
        return view('includes/extra_info', $data);
    }
}
