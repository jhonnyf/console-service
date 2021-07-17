<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'document', 'phone', 'cellphone'];
    protected $hidden   = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'user_file');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * Mutators
     */

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setDocumentAttribute($value)
    {
        $value = str_replace('-', '', $value);
        $value = str_replace('.', '', $value);
        $value = str_replace(' ', '', $value);

        $this->attributes['document'] = $value;
    }

    public function setPhoneAttribute($value)
    {
        $value = str_replace('-', '', $value);
        $value = str_replace(')', '', $value);
        $value = str_replace('(', '', $value);
        $value = str_replace(' ', '', $value);

        $this->attributes['phone'] = $value;
    }

    public function setCellphoneAttribute($value)
    {
        $value = str_replace('-', '', $value);
        $value = str_replace(')', '', $value);
        $value = str_replace('(', '', $value);
        $value = str_replace(' ', '', $value);

        $this->attributes['cellphone'] = $value;
    }
}
