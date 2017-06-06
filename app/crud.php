<?php

namespace calidad;

use Illuminate\Database\Eloquent\Model;

class crud extends Model
{
    protected $table = 'crud';

    protected $fillable = ['_bigint','_integer','_char','_date','_datetime','_timestamp','_double','_float','_text','_string'];

    protected $dateFormat = 'Y.m.d H:i:s';

    protected $primaryKey = 'id_crud';
}
