<?php

namespace App\Cells;

use App\Models\EventModel;

class EventSampleCell
{
    /**
     * 이벤트 데이터를 가져와 뷰를 렌더링합니다.
     *
     * @return string 렌더링된 HTML
     */
    public function render()
    {
        // EventModel 인스턴스 생성
        $eventModel = new EventModel();
        
        // 전체 이벤트 중 최대 3개 데이터 조회
        $events = $eventModel->findAll(3);

        // "includes/event_sample_view" 뷰 파일에 events 데이터를 전달하여 렌더링합니다.
        return view('includes/event_sample_view', ['events' => $events]);
    }
}
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
        $eventModel  = new EventModel();
        $hotelModel  = new HotelModel();
        $parkingModel = new ParkingLotModel();

        $eventsRaw = $eventModel->findAll(3);
        $hotelsRaw = $hotelModel->findAll(3);
        $parkingRaw = $parkingModel->findAll(3);

        // 데이터 재매핑 예시
        $mappedEvents = array_map(function($item) {
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
            return [
                'name'    => $item['business_name'] ?? '',
                'address' => $item['site_full_address'] ?? '',
                'phone'   => $item['contact_number'] ?? '',
            ];
        }, $hotelsRaw);

        $mappedParking = array_map(function($item) {
            return [
                'name'    => $item['name'] ?? '',
                'address' => $item['address_road'] ?? '',
                'phone'   => $item['phone_number'] ?? '',
            ];
        }, $parkingRaw);

        $data = [
            'events'      => $mappedEvents,
            'hotels'      => $mappedHotels,
            'parkingLots' => $mappedParking,
        ];

        return view('includes/extra_info', $data);
    }
}
