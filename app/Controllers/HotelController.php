<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\Controller;

class HotelController extends Controller
{
    public function index()
{
    $hotelModel = new HotelModel();

    // Pagination 설정
    $perPage = 10; // 페이지당 항목 수
    $currentPage = $this->request->getVar('page') ?? 1;

    // 데이터 조회
    $hotels = $hotelModel
        ->orderBy('id', 'desc')
        ->paginate($perPage);

    // 이미지 URL 설정
    foreach ($hotels as &$hotel) {
        if (strpos($hotel['business_name'], '호텔') !== false) {
            $hotel['map_image_url'] = 'https://wrtn-image-user-output.s3.ap-northeast-2.amazonaws.com/645ad60aac512fd38c18657e/2f50b7b9-4279-4b46-9f18-af3206e45bcf.png';
        } elseif (strpos($hotel['business_name'], '모텔') !== false) {
            $hotel['map_image_url'] = 'https://wrtn-image-user-output.s3.ap-northeast-2.amazonaws.com/645ad60aac512fd38c18657e/636d8105-e2fc-408e-99bd-b980ce681a92.png';
        } else {
            $hotel['map_image_url'] = 'https://wrtn-image-user-output.s3.ap-northeast-2.amazonaws.com/645ad60aac512fd38c18657e/982a97f4-9a66-4b9c-9d45-7df565bbf0d1.png';
        }
    }

    // 최근 추가된 호텔 5개
    $recentHotels = $hotelModel
        ->orderBy('id', 'desc')
        ->limit(5)
        ->find();

    $data['hotels'] = $hotels;
    $data['pager'] = $hotelModel->pager;
    $data['recentHotels'] = $recentHotels;

    return view('hotel/index', $data);
}



    public function search()
    {
        $hotelModel = new HotelModel();
    
        // Pagination 설정
        $perPage = 10; // 페이지당 항목 수
        $currentPage = $this->request->getVar('page') ?? 1;
    
        // 검색 조건 적용
        $query = $this->request->getGet('query');
        if ($query) {
            $hotelModel = $hotelModel
                ->like('service_name', $query)
                ->orLike('business_name', $query)
                ->orLike('site_full_address', $query);
        }
    
        // 데이터 조회 (페이징 포함)
        $data['hotels'] = $hotelModel->paginate($perPage, 'default', $currentPage);
    
        // 페이징 링크 추가
        $data['pager'] = $hotelModel->pager;
    
        // 검색어 유지
        $data['query'] = $query;
    
        // 뷰 페이지 반환
        return view('hotel/hotel_list_view', $data);
    }
    
    public function detail($id)
    {
        $hotelModel = new HotelModel();
        $hotel = $hotelModel->find($id);
    
        if (!$hotel) {
            return redirect()->to('/hotel')->with('error', '호텔 정보를 찾을 수 없습니다.');
        }
    
        // 네이버 API 요청
        $client_id = "AwqLuk6AGiTXp3fppv5_";
        $client_secret = "fZvQ_x_QSm";
        $address = $hotel['site_full_address'];
        $query_food = $address . " 근처 맛집";
        $query_tour = $address . " 주변 관광지";
    
        $headers = [
            "X-Naver-Client-Id: $client_id",
            "X-Naver-Client-Secret: $client_secret",
        ];
    
        $results_food = $this->fetchApiResults("https://openapi.naver.com/v1/search/local.json?query=" . urlencode($query_food) . "&display=4&start=1", $headers);
        $results_tour = $this->fetchApiResults("https://openapi.naver.com/v1/search/local.json?query=" . urlencode($query_tour) . "&display=4&start=1", $headers);
    
        // 최근 추가된 숙박업소 가져오기
        $recentHotels = $hotelModel->orderBy('id', 'desc')->limit(5)->find();
    
        return view('hotel/detail', [
            'hotel' => $hotel,
            'results_food' => $results_food,
            'results_tour' => $results_tour,
            'recentHotels' => $recentHotels, // 추가
        ]);
    }
    

    private function fetchApiResults($api_url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true)['items'] ?? [];
    }


}
