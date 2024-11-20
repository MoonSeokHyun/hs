<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EventModel;

class EventController extends Controller
{
    public function index($brand = null)
    {
        $model = new EventModel();

        // Pagination 설정
        $perPage = 20;
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;

        // 브랜드별 필터링 처리
        if ($brand) {
            $brand = urldecode($brand); // URL 디코딩
            $total = $model->countEventsByBrand($brand);
            $events = $model->getEventsByBrand($brand, $perPage, $offset);
        } else {
            $total = $model->countAllResults();
            $events = $model->orderBy('created_at', 'DESC')->findAll($perPage, $offset);
        }

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
            'pager' => $pager->makeLinks($currentPage, $perPage, $total, 'default_full'),
            'brand' => $brand,
        ]);
    }
}
