<?php

namespace App\Models;

use CodeIgniter\Model;

class CarWashInfoModel extends Model
{
    // 테이블 이름
    protected $table = 'car_wash_info';

    // 기본 키
    protected $primaryKey = 'ID';

    // 테이블의 각 컬럼을 정의
    protected $allowedFields = [
        'Data_Reference_Date',
        'Business Name',
        'City/District',
        'Business Type',
        'Car Wash Type',
        'Address (Road Name)',
        'Address (Lot Number)',
        'Day Off',
        'Weekday Start Time',
        'Weekday End Time',
        'Holiday Start Time',
        'Holiday End Time',
        'Car Wash Fee Information',
        'Representative Name',
        'Car Wash Phone Number',
        'Water Quality License Number',
        'WGS84 Latitude',
        'WGS84 Longitude',
        'Data Reference Date'
    ];

    // 날짜를 자동으로 관리할지 여부
    protected $useTimestamps = false;

    // 날짜 포맷 설정 (필요시)
    protected $dateFormat = 'datetime';

    // 설정된 필드 값만 허용 (보안을 위해)
    protected $validationRules = [
        'Business Name' => 'required|string|max_length[255]',
        'City/District' => 'required|string|max_length[255]',
        'Business Type' => 'required|string|max_length[255]',
        'Car Wash Type' => 'required|string|max_length[255]',
        'Representative Name' => 'required|string|max_length[255]',
        'Car Wash Phone Number' => 'required|string|max_length[50]',
        // 여기에 추가적인 검증 규칙을 작성할 수 있습니다.
    ];

    protected $validationMessages = [
        'Business Name' => [
            'required' => 'Business name is required',
            'max_length' => 'Business name can not exceed 255 characters'
        ],
        'City/District' => [
            'required' => 'City/District is required',
            'max_length' => 'City/District name can not exceed 255 characters'
        ],
        'Business Type' => [
            'required' => 'Business Type is required',
            'max_length' => 'Business Type name can not exceed 255 characters'
        ],
        'Car Wash Type' => [
            'required' => 'Car Wash Type is required',
            'max_length' => 'Car Wash Type can not exceed 255 characters'
        ],
        'Representative Name' => [
            'required' => 'Representative Name is required',
            'max_length' => 'Representative Name can not exceed 255 characters'
        ],
        'Car Wash Phone Number' => [
            'required' => 'Phone number is required',
            'max_length' => 'Phone number can not exceed 50 characters'
        ]
    ];

    // 해당 모델을 통해 데이터베이스의 모든 행을 조회하는 예시 메서드
    public function getAllCarWashes()
    {
        return $this->findAll();
    }

    // 특정 ID의 세차장 정보 조회하는 예시 메서드
    public function getCarWashById($id)
    {
        return $this->find($id);
    }

    // 새로운 세차장 정보 삽입하는 예시 메서드
    public function addCarWash($data)
    {
        return $this->insert($data);
    }

    // 세차장 정보 업데이트하는 예시 메서드
    public function updateCarWash($id, $data)
    {
        return $this->update($id, $data);
    }

    // 세차장 정보 삭제하는 예시 메서드
    public function deleteCarWash($id)
    {
        return $this->delete($id);
    }

    // 사이트맵을 위한 세차장 정보 조회 메서드
    public function getCarWashesForSitemap($limit, $offset)
    {
        return $this->select('ID, Data_Reference_Date')
            ->orderBy('ID', 'ASC')
            ->limit($limit, $offset)
            ->findAll();
    }

    // 사이트맵을 위한 전체 세차장 수 카운트
    public function countAllCarWashes()
    {
        return $this->countAllResults();
    }
}
