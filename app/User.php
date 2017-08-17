<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password', 'admin_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function tasklists()
    {
        return $this->hasMany('App\Tasklist','owner_id');
    }
        
    public function can_post()
    {
        $role = $this->role;
        if($role == 'author' || $role == 'admin')
        {
            return true;
        }
        return false;
    }



    public function is_admin()
    {
        $role = $this->role;
        if($role == 'admin')
        {
            return true;
        }
        return false;
    }
}
