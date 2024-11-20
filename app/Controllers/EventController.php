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
            $brand = urldecode($brand);
            $total = $model->countEventsByBrand($brand);
            $events = $model->getEventsByBrand($brand, $perPage, $offset);
        } else {
            $total = $model->countAllResults();
            $events = $model->orderBy('created_at', 'DESC')->findAll($perPage, $offset);
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

