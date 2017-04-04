<?php
namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

// class User extends Model implements Transformable
class User extends Authenticatable implements Transformable
{
  use TransformableTrait;
  // use Authenticatable;

  protected $fillable = [
    'name',
    'password',
    'user_info_id',
  ];

  protected $hidden = [
        'password', 'remember_token',
    ];

  public function info()
  {
    return $this->belongsTo('App\Entities\UserInfos', 'user_info_id');
    // return $this->belongsToMany('App\Entities\UserInfos', 'user_info_id', 'id');
  }
}
