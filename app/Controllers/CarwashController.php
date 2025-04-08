<?php

namespace App\Controllers;

use App\Models\CarWashInfoModel;
use App\Models\CarWashReviewModel;

class CarwashController extends BaseController
{
    // 인덱스 페이지 (세차장 목록 또는 기본 정보 페이지)
    public function index()
    {
        $carWashModel = new CarWashInfoModel();

        // 최신 세차장 5개를 불러옵니다.
        $recentCarWashes = $carWashModel->orderBy('Data_Reference_Date', 'DESC')->findAll(5);

        // 인기 세차장 (여기서는 임의로 ID 기준으로 가져옵니다)
        $popularCarWashes = $carWashModel->orderBy('ID', 'ASC')->findAll(5);

        return view('carwash/index', [
            'recentCarWashes' => $recentCarWashes,
            'popularCarWashes' => $popularCarWashes
        ]);
    }

    // 세차장 상세 페이지
    public function showDetail($carwash_id)
    {
        $carWashModel = new CarWashInfoModel();
        $reviewModel = new CarWashReviewModel();

        // 세차장 정보 가져오기
        $carwash = $carWashModel->find($carwash_id);

        // 리뷰 목록 가져오기
        $reviews = $reviewModel->getReviewsByCarWashId($carwash_id);

        // 평균 평점 계산
        $averageRating = $reviewModel->getAverageRating($carwash_id);

        return view('carwash/detail', [
            'carwash' => $carwash,
            'reviews' => $reviews,
            'averageRating' => $averageRating
        ]);
    }

    // 리뷰 저장
    public function saveReview()
    {
        $reviewModel = new CarWashReviewModel();

        // 리뷰 데이터 받기
        $reviewData = [
            'carwash_id' => $this->request->getPost('carwash_id'),
            'rating' => $this->request->getPost('rating'),
            'comment_text' => $this->request->getPost('comment_text'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // 리뷰 추가
        $reviewModel->addReview($reviewData);

        // 세차장 상세 페이지로 리디렉션
        return redirect()->to('/carwash/details/' . $this->request->getPost('carwash_id'));
    }
}
