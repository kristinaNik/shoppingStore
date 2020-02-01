<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;


class Permission extends Model
{
    use EntrustPermissionTrait;

    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'description'];
}
