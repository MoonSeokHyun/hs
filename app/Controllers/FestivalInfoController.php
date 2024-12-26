<?php

namespace App\Controllers;

use App\Models\FestivalInfoModel;

class FestivalInfoController extends BaseController
{
    // index 페이지를 보여주는 메서드
    public function index()
    {
        $model = new FestivalInfoModel(); // 모델 인스턴스 생성
        
        // 현재 날짜를 얻기 (Y-m-d 형식)
        $currentDate = date('Y-m-d');
    
        // 종료일이 오늘 날짜 이후인 축제만 필터링
        $festivals = $model->where('End_Date >', $currentDate) // 종료일이 오늘 이후인 축제만
                           ->paginate(9); // 페이지네이션 처리, 한 페이지당 9개씩
    
        // 페이지네이션 객체
        $pager = \Config\Services::pager();
    
        // 데이터를 뷰로 전달
        $data['festivals'] = $festivals;
        $data['pager'] = $pager;
    
        // 'festival/index' 뷰로 데이터를 전달
        return view('festival/index', $data);
    }
    
    // 상세 페이지를 보여주는 메서드
    public function detail($id)
    {
        $model = new FestivalInfoModel();
        
        // 축제 ID로 데이터 조회
        $festival = $model->find($id);

        // 데이터가 없으면 404 에러 처리
        if (!$festival) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 데이터를 뷰로 전달
        $data['festival'] = $festival;

        // 'hospital-project/app/Views/festival/detail.php' 뷰로 데이터를 전달
        return view('festival/detail', $data);
    }
}
