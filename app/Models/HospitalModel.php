<?php

namespace App\Models;

use CodeIgniter\Model;

class HospitalModel extends Model
{
    protected $table = 'MedicalInstitutions';
    protected $primaryKey = 'ID';
    protected $allowedFields = [
        'OpenServiceName', 'OpenServiceID', 'MunicipalityCode', 'ManagementNumber',
        'PermitDate', 'PermitCancellationDate', 'BusinessStatusCode', 'BusinessStatusName',
        'DetailedBusinessStatusCode', 'DetailedBusinessStatusName', 'ClosureDate',
        'SuspensionStartDate', 'SuspensionEndDate', 'ReopeningDate', 'PhoneNumber', 'Area',
        'PostalCode', 'FullAddress', 'RoadNameFullAddress', 'RoadNamePostalCode', 'BusinessName',
        'LastUpdateTime', 'DataUpdateType', 'DataUpdateDate', 'BusinessType', 'Coordinate_X',
        'Coordinate_Y', 'MedicalInstitutionType', 'MedicalStaffCount', 'InpatientRoomCount',
        'BedCount', 'TotalArea', 'MedicalDepartmentContent', 'MedicalDepartmentName',
        'DesignationCancellationDate', 'PalliativeCareType', 'PalliativeCareDepartment',
        'SpecialAmbulanceCount', 'GeneralAmbulanceCount', 'TotalStaffCount', 'RescueStaffCount',
        'LicensedBedCount', 'InitialDesignationDate', 'ManagementEntity', 'Column46', 'Column47'
    ];

    // Pagination or optimized fetching method
    public function getHospitals($limit = 10, $offset = 0)
    {
        return $this->orderBy('ID', 'ASC')->findAll($limit, $offset);
    }
    
    public function getHospitalsByCategory($category, $limit = 10, $offset = 0)
    {
        $cacheKey = "hospitals_category_{$category}_{$limit}_{$offset}";

        // Check if cached data exists
        if ($cachedData = cache()->get($cacheKey)) {
            return $cachedData;
        }

        $builder = $this->db->table($this->table);
        $query = $builder->select('ID, BusinessName, FullAddress, PhoneNumber, PermitDate')
                         ->where('OpenServiceName', $category)
                         ->orderBy('ID', 'ASC')
                         ->limit($limit, $offset)
                         ->get();
        
        $result = $query->getResultArray() ?: [];

        // Save the result to cache (e.g., for 10 minutes)
        cache()->save($cacheKey, $result, 600);

        return $result;
    }
    
    // Method to get nearby facilities within a radius
    public function getNearbyFacilities($latitude, $longitude, $distance = 10, $limit = 5)
    {
        $latitude = (float) $latitude;
        $longitude = (float) $longitude;

        // Calculate nearby facilities using Haversine formula
        $query = $this->db->query("
            SELECT ID, BusinessName, FullAddress, PhoneNumber,
            (6371 * acos(cos(radians($latitude)) * cos(radians(Coordinate_X)) * 
            cos(radians(Coordinate_Y) - radians($longitude)) + 
            sin(radians($latitude)) * sin(radians(Coordinate_X)))) AS distance
            FROM MedicalInstitutions
            WHERE Coordinate_X IS NOT NULL AND Coordinate_Y IS NOT NULL
            HAVING distance <= $distance
            ORDER BY distance
            LIMIT $limit
        ");

        return $query->getResultArray();
    }
}
