<?php

namespace App\Models;

use CodeIgniter\Model;

class EventDataModel extends Model
{
    protected $table = 'EventData';
    protected $primaryKey = 'ID';

    protected $allowedFields = [
        'Event_Name',
        'Location',
        'Event_Details',
        'Event_Start_Date',
        'Event_End_Date',
        'Event_Time_Range',
        'Fee_Info',
        'Organizing_Agency',
        'Hosting_Agency',
        'Contact_Number',
        'Sponsoring_Agency',
        'Seating_Capacity',
        'Admission_Fee',
        'Age_Limit',
        'Discount_Info',
        'Precautions',
        'Website_URL',
        'Ticket_Info',
        'Parking_Availability',
        'Road_Address',
        'Land_Address',
        'Latitude',
        'Longitude',
        'Data_Reference_Date',
        'Provider_Code',
        'Provider_Name'
    ];

    protected $useTimestamps = false; // Set true if the table has created_at and updated_at columns

    // Validation rules can be added here
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
