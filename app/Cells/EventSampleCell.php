<?php

namespace App\Cells;

use App\Models\EventModel;
use App\Models\HotelModel;
use App\Models\ParkingLotModel;

class ExtraInfoCell
{
    /**
     * 이벤트, 호텔, 주차장 데이터를 가져와 뷰를 렌더링합니다.
     *
     * @return string 렌더링된 HTML
     */
    public function render()
    {
        // 모델 인스턴스 생성
        $eventModel  = new EventModel();
        $hotelModel  = new HotelModel();
        $parkingModel = new ParkingLotModel();

        // 각 모델에서 최대 3개 데이터 조회
        $eventsRaw = $eventModel->findAll(3);
        $hotelsRaw = $hotelModel->findAll(3);
        $parkingRaw = $parkingModel->findAll(3);

        // 데이터 재매핑
        $mappedEvents = array_map(function($item) {
            // EventModel 반환 필드: 'product_name', 'event_type', 'image_url', 'brand', 'price', 'discount_rate', 'created_at'
            return [
                'name'          => $item['product_name'] ?? '',
                'type'          => $item['event_type'] ?? '',
                'image'         => $item['image_url'] ?? '',
                'brand'         => $item['brand'] ?? '',
                'price'         => $item['price'] ?? '',
                'discount_rate' => $item['discount_rate'] ?? '',
                'created_at'    => $item['created_at'] ?? '',
            ];
        }, $eventsRaw);

        $mappedHotels = array_map(function($item) {
            // HotelModel 반환 필드: 'business_name', 'site_full_address', 'contact_number'
            return [
                'name'    => $item['business_name'] ?? '',
                'address' => $item['site_full_address'] ?? '',
                'phone'   => $item['contact_number'] ?? '',
            ];
        }, $hotelsRaw);

        $mappedParking = array_map(function($item) {
            // ParkingLotModel 반환 필드: 'name', 'address_road', 'phone_number'
            return [
                'name'    => $item['name'] ?? '',
                'address' => $item['address_road'] ?? '',
                'phone'   => $item['phone_number'] ?? '',
            ];
        }, $parkingRaw);

        // 전달할 데이터 배열
        $data = [
            'events'      => $mappedEvents,
            'hotels'      => $mappedHotels,
            'parkingLots' => $mappedParking,
        ];

        // 뷰 파일 'includes/extra_info'에 데이터 전달하여 렌더링
        return view('includes/extra_info', $data);
    }
}
