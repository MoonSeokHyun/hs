<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotel'; // 테이블명
    protected $primaryKey = 'id'; // 기본 키

    protected $useAutoIncrement = true; // AUTO_INCREMENT 사용

    protected $allowedFields = [
        'service_name',
        'service_id',
        'municipality_code',
        'management_number',
        'license_date',
        'license_cancellation_date',
        'business_status_code',
        'business_status_name',
        'detailed_status_code',
        'detailed_status_name',
        'business_closure_date',
        'suspension_start_date',
        'suspension_end_date',
        'reopening_date',
        'contact_number',
        'site_area',
        'site_postcode',
        'site_full_address',
        'road_name_full_address',
        'road_name_postcode',
        'business_name',
        'last_update_time',
        'data_update_type',
        'data_update_date',
        'business_type_name',
        'coordinate_x',
        'coordinate_y',
        'hygiene_business_type',
        'building_above_ground',
        'building_below_ground',
        'use_start_above_ground',
        'use_end_above_ground',
        'use_start_below_ground',
        'use_end_below_ground',
        'han_room_count',
        'western_room_count',
        'conditional_license_reason',
        'conditional_license_start_date',
        'conditional_license_end_date',
        'building_ownership_type',
        'female_staff_count',
        'male_staff_count',
        'multi_use_facility_flag',
    ];

    protected $returnType = 'array'; // 데이터 반환 형식
    protected $useTimestamps = false; // 타임스탬프 사용 여부

    // 추가적인 설정
    protected $dateFormat = 'datetime'; // 날짜 형식

    // 유효성 검사 규칙 (옵션)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
