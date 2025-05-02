<?php namespace App\Models;

use CodeIgniter\Model;

class EvStationsModel extends Model
{
    protected $table      = 'ev_stations';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'longitude', 'latitude',
        'road_address', 'land_lot_address',
        'parcel_id', 'jurisdiction',
        'facility_name', 'full_address',
        'available_chargers', 'in_use_chargers',
        'compatible_ev_models'
    ];
}
