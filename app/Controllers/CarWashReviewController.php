<?php

namespace App\Controllers;

use App\Models\CarWashReviewModel;
use App\Models\CarWashInfoModel;

class CarWashReviewController extends BaseController
{
    public function __construct()
    {
        $this->carWashReviewModel = new CarWashReviewModel();
        $this->carWashInfoModel = new CarWashInfoModel();
    }

    // 세차장의 리뷰 목록을 가져오는 메서드
    public function viewReviews($carwashId)
    {
        $data['carwash'] = $this->carWashInfoModel->find($carwashId);
        $data['reviews'] = $this->carWashReviewModel->getReviewsByCarWashId($carwashId);
        
        return view('carwash/detail', $data);
    }

    // 리뷰 작성 처리
    public function saveReview()
    {
        $validation =  \Config\Services::validation();
        
        // 폼 검증
        $inputData = $this->request->getPost();
        if ($this->validate([
            'carwash_id'    => 'required|integer',
            'user_id'       => 'required|integer',
            'rating'        => 'required|integer|greater_than[0]|less_than[6]',
            'comment_text'  => 'required|string',
        ])) {
            $reviewData = [
                'carwash_id'    => $inputData['carwash_id'],
                'user_id'       => $inputData['user_id'],  // user_id는 세션에서 가져올 수 있음
                'rating'        => $inputData['rating'],
                'comment_text'  => $inputData['comment_text'],
            ];
            
            $this->carWashReviewModel->addReview($reviewData);
            return redirect()->to('/carwash/details/' . $inputData['carwash_id']);
        } else {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }
}
