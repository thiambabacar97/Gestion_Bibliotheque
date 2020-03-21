<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Model implements Authenticatable
{
    use BasicAuthenticatable;
    use Notifiable;
    public function setAttribute($key, $value)
    {
      $isRememberTokenAttribute = $key == $this->getRememberTokenName();
      if (!$isRememberTokenAttribute)
      {
        parent::setAttribute($key, $value);
      }
    }
  
    protected $table ='users';
    protected $fillable = [
        'id',
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'telephone',
        'date_naissance'
    ];

    protected $hidden = [
      'password'
  ];
  public function livres()
  {
      return $this->belongsToMany('App\model\Livre', 'livre_demanders');
  }
    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    
public function authorizeRoles($roles)
{
  if (is_array($roles)) {
      return $this->hasAnyRole($roles) || 
             abort(401, 'This action is unauthorized.');
  }
  return $this->hasRole($roles) || 
         abort(401, 'This action is unauthorized.');
}

public function hasAnyRole($roles)
{
  return null !== $this->roles()->whereIn('name', $roles)->first();
}

public function hasRole($role)
{
  return null !== $this->roles()->where('name', $role)->first();
}
}
