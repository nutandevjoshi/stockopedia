<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_plan';

    public $timestamps=false;

    protected $primaryKey = 'id';

    protected $fillable=['plan_id','user_id','frequency'];

}
