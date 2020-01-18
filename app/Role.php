<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends Model
{
    use EntrustRoleTrait;

    protected $table = 'roles';
    protected $fillable = ['name', 'display_name', 'description'];
}
