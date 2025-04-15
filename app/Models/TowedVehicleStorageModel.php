<?php

namespace App\Models;

use CodeIgniter\Model;

class TowedVehicleStorageModel extends Model
{
    protected $table = 'towed_vehicle_storage';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'towed_vehicle_storage_name',
        'address_road_name',
        'address_land_lot_number',
        'latitude',
        'longitude',
        'storage_facility_phone_number',
        'storage_facility_area',
        'number_of_vehicles_that_can_be_stored',
        'basic_tow_fee',
        'additional_tow_fee',
        'storage_fee',
        'management_organization_phone_number',
        'management_organization_name',
        'data_reference_date',
        'provider_organization_code',
        'provider_organization_name',
    ];
    protected $useTimestamps = true;
}
