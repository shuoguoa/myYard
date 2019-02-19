<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbRecords extends Model
{
    //
    protected $table = 'tb_records';
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'cid', 'uid', 'addtime', 'state'];
    protected $guarded = ['id'];
    static $state = array('use' => 1, 'delete' => 0);

    //执行增加操作
    public function insert($param){
        if(isset($param['uid']) && $param['uid'] > 0){
            $tbmodel = new Tbcategory();
            $param['cid'] = isset($param['cid']) ? $param['cid'] : $this->firstOrNewId($param['uid']);
            $this->fill($param);
            $suc = $this->save();
            if($suc) {
                $cat = TbCategory::find($param['cid']);
                $cat->count = $cat->count+1;
                return $cat->save();
            }
        }
        return false;
    }

    //新闻的浏览
    public function findUserAll($uid, $cid = 0){
        $st = self::$state['use'];
        if($cid > 0) {
            $recordsList = static::whereRaw("uid={$uid} and cid={$cid} and state={$st}")->get()->toArray();
        } else {
            $recordsList = static::whereRaw("uid={$uid} and state={$st}")->get()->toArray();
        }
        return $recordsList;
    }

    //  将用户的笔记类型从$cid 编程¥nextId
    public function changeCat($uid, $cid, $nextId){
        $st = self::$state['use'];
        return static::whereRaw('uid={$uid} and cid={$cid} and state={$st}')->update(['cid' =>$nextId]);
    }
}
