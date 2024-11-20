<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EventModel;

class EventController extends Controller
{
    public function index()
    {
        $model = new EventModel();

        // Pagination 설정
        $perPage = 20; // 페이지당 데이터 개수
        $currentPage = $this->request->getVar('page') ?? 1; // 현재 페이지
        $offset = ($currentPage - 1) * $perPage;

        // 총 데이터 개수
        $total = $model->countAllResults();

        // 데이터 가져오기
        $events = $model->orderBy('created_at', 'DESC') // 최신순 정렬
                        ->findAll($perPage, $offset);

        // Pagination 라이브러리 설정
        $pager = \Config\Services::pager();

        // 뷰로 데이터 전달
        return view('events_view', [
            'events' => $events,
            'pager' => $pager->makeLinks($currentPage, $perPage, $total, 'default_full'),
        ]);
    }
}
