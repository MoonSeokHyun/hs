<?php

namespace App\Models;

use CodeIgniter\Model;

class StationModel extends Model
{
    protected $table = 'charging_stations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'Longitude', 'Latitude', 'Address1', 'Address2', 'BusinessID', 'Status', 
        'City', 'Company', 'FullAddress', 'Phone', 'Service'
    ];

    // Pagination configuration (12 records per page)
    protected $perPage = 12;

    public function getStations($page = 1)
    {
        return $this->paginate($this->perPage, '', $page);
    }
}
