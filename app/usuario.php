<?php

namespace calidad;

use Illuminate\Auth\Acess;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class usuario extends Model implements AuthenticatableContract,AuthorizableContract,CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword;

    protected $table = 'usuario';

    protected $fillable = ['id_usuario','id_rol','nombre','apellido','correo','nom_usuario','contrasena','estado'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_usuario';

    public function getAuthIdentifier()
    {
        //return $this->email; //should be changed to
        return $this->id;
    }
}
