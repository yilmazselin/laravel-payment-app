<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $price
 * @property int $creditCardId
 * @property int $accountId
 * @property string $weepayOrderId
 * @property string $created_at
 * @property string $updated_at
 */
class Orders extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['price', 'creditCardId', 'accountId', 'weepayOrderId', 'created_at', 'updated_at'];

}
