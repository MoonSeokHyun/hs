<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EventModel;

class EventController extends Controller
{
    public function index($brand = null)
    {
        $model = new EventModel();

        // GET 요청에서 필터링 값 가져오기
        $eventType = $this->request->getGet('event_type');
        $category = $this->request->getGet('category');
        $itemsPerPage = $this->request->getGet('item') ?? 20; // 기본 20개
        $sort = $this->request->getGet('sort');
        $price = $this->request->getGet('price');
        $query = $this->request->getGet('q');
        $currentPage = $this->request->getVar('page') ?? 1;

        // 기본 쿼리 설정
        $builder = $model->select('*');

        // 브랜드 필터링
        if ($brand) {
            $builder->where('brand', urldecode($brand));
        }

        // 필터링 조건 추가
        if ($eventType) {
            $builder->where('event_type', $eventType);
        }
        if ($category) {
            $builder->where('category', $category);
        }
        if ($price) {
            $builder->where('price <=', $price);
        }
        if ($query) {
            $builder->like('product_name', $query);
        }

        // 정렬 조건 추가
        if ($sort == '1') {
            $builder->orderBy('price', 'ASC'); // 낮은 가격순
        } elseif ($sort == '2') {
            $builder->orderBy('price', 'DESC'); // 높은 가격순
        } else {
            $builder->orderBy('created_at', 'DESC'); // 최신순
        }

        // Pagination 설정
        $events = $builder->paginate($itemsPerPage, 'default', $currentPage);
        $total = $builder->countAllResults(false); // 조건 만족 데이터 개수

        // 브랜드가 7-ELEVEn인 경우 image_url을 지정된 URL로 설정
        foreach ($events as &$event) {
            if ($event['brand'] === '7-ELEVEn') {
                $event['image_url'] = 'https://www.migadesign.co.kr/app/dubu_board/docs/imgs/y/y14853344626785_lg_s14558698625380_image.jpg';
            }
        }

        // Pagination 생성
        $pager = \Config\Services::pager();

        return view('events_view', [
            'events' => $events,
            'pager' => $pager, // pager 객체 전달
            'brand' => $brand,
            'eventType' => $eventType,
            'category' => $category,
            'itemsPerPage' => $itemsPerPage,
            'sort' => $sort,
            'price' => $price,
            'query' => $query,
        ]);
    }
    public function detail($id)
    {
        $db = \Config\Database::connect();
    
        // 제품 정보 가져오기
        $eventModel = new EventModel();
        $event = $eventModel->find($id);
    
        if (!$event) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Event with ID {$id} not found.");
        }
    
        // 추천 상품 가져오기 (카테고리와 ±10% 가격 범위)
        $priceRangeLow = $event['price'] * 0.9; // 가격 하한
        $priceRangeHigh = $event['price'] * 1.1; // 가격 상한
    
        $recommendedProducts = $eventModel->where('category', $event['category'])
            ->where('id !=', $event['id']) // 현재 상품 제외
            ->where('price >=', $priceRangeLow)
            ->where('price <=', $priceRangeHigh)
            ->orderBy('RAND()') // 랜덤 정렬
            ->limit(5)
            ->findAll();
    
        // 추천 상품의 이미지 URL 변경 ('7-ELEVEn' 브랜드인 경우)
        foreach ($recommendedProducts as &$recommended) {
            if ($recommended['brand'] === '7-ELEVEn') {
                $recommended['image_url'] = 'https://www.migadesign.co.kr/app/dubu_board/docs/imgs/y/y14853344626785_lg_s14558698625380_image.jpg';
            }
        }
    
        // View에 데이터 전달
        return view('event_detail', [
            'event' => $event,
            'recommendedProducts' => $recommendedProducts,
        ]);
    }
    
    
}
