<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Users extends Model implements AuthenticatableContract,CanResetPasswordContract
{
    //
    use Authenticatable, CanResetPassword;
    //数据库的表名称
    protected $table = 'users';
    //不使用laravel框架提供的时间存储方式
    public $timestamps = 'false';
    //可填充数据表字段
    protected $fillable = ['username', 'account', 'password', 'addtime'];
    //保护数据表字段
    protected $guarded = ['id'];
    //查找所有用户
    public function findAll(){
        $userList = $this->all();
        return $userList;
    }
}
