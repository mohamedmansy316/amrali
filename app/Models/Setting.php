<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $fillable = [
        'setting_title_ar',
        'setting_title_en',
        'setting_site_email',
        'setting_keywords',
        'setting_description',
        'setting_site_address_ar',
        'setting_site_address_en',

        'setting_facebookurl',
        'setting_whatsappurl',
        'setting_youtubeurl',
        'setting_instgramurl',
        'setting_telegramurl',
        
        'setting_sitetell1'
    ];
}


