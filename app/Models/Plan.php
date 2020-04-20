<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plan';

    public $timestamps=false;

    protected $fillable=['code','name','monthly_cost','annual_cost'];

    protected $primaryKey = 'id';

}
