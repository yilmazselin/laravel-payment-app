<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $dealerId
 * @property string $apiKey
 * @property string $secretKey
 * @property string $created_at
 * @property string $updated_at
 */
class Accounts extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'dealerId', 'apiKey', 'secretKey', 'created_at', 'updated_at'];

}
