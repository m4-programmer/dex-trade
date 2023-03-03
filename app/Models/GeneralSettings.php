<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $fillable = [
    'sitename',
    'site_currency',
    'site_email',
    'site_phone',
    'site_address',
    'copyright',
    'logo',
    'favicon',
    'login_image',
    'preloader_status',
    'is_email_verification_on',
    'is_sms_verification_on',
    'preloader_image',
    'allow_recaptcha',
    'recaptcha_key',
    'recaptcha_secret',
    'twak_key',
    'seo_description'
    ];
}
