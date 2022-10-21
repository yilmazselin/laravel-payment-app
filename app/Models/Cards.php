<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $cardNumber
 * @property int $expiryMonth
 * @property int $expiryYear
 * @property int $cvc
 * @property string $holderName
 * @property string $created_at
 * @property string $updated_at
 */
class Cards extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['cardNumber', 'expiryMonth', 'expiryYear', 'cvc', 'holderName', 'created_at', 'updated_at'];

}
