<?php

namespace App\Models;

use CodeIgniter\Model;

class FestivalInfoModel extends Model
{
    protected $table      = 'festival_info'; // 테이블 이름
    protected $primaryKey = 'id'; // 기본키

    protected $allowedFields = [
        'Festival_Name', 'Venue', 'Start_Date', 'End_Date', 'Description', 
        'Organizing_Agency', 'Hosting_Agency', 'Supporting_Agency', 
        'Contact_Number', 'Website_URL', 'Related_Information', 
        'Address_Road', 'Address_Land', 'Latitude', 'Longitude', 
        'Data_Reference_Date', 'Provider_Code', 'Provider_Name'
    ];

    // 기존 데이터 확인 (중복 확인)
    public function exists($festivalName)
    {
        return $this->where('Festival_Name', $festivalName)->first() !== null;
    }
}
