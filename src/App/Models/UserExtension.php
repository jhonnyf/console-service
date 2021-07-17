<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExtension extends Model
{
    protected $table      = 'users_extensions';
    protected $primaryKey = 'user_id';
    protected $fillable   = [];

    public function __construct(array $attributes = [])
    {
        $fillable = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        if (in_array($this->primaryKey, $fillable)) {
            $key = array_search($this->primaryKey, $fillable);
            unset($fillable[$key]);
        }

        $this->fillable = $fillable;
        parent::__construct($attributes);
    }

}
