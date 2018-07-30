<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/30/2018
 * Time: 5:16 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = ['id'];

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

}