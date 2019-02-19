<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbCategory extends Model
{
    //
    protected  $table = 'tb_category';
    public  $timestamps = 'false';
    protected $fillable = ['name', 'count', 'uid', 'state'];
    protected $guarded = ['id'];
    static $state = array('use' => 1, 'delete' => 0);

    public function findUserAll($uid = 0){
        if($uid != 0) {
            $st = self::$state['use'];
            $catArr = static::whereRaw('uid={$uid} and state={$st}')->get()->toArray();
            return $catArr;
        } else{
            return null;
        }

    }
    //查找¥uid的第一个分类或者创建一个，返回Id号
    public function firstOrNewId($uid){
        $st = self::$state['use'];
        $modColl = static::whereRaw('uid={$uid} and state={$st}')->get();

        if($modColl->count() > 0) {
            $id = $modColl->first()->getAttribute('id');
            return $id;
        } else {
            return $this->createNewCat($uid);
        }
    }

    //添加一个新闻类别
    public function categoryAdd($param){
        $param['name'] = isset($param['name']) ? $param['name'] : '思维笔记';
        if (!empty($param['uid'])) {
            return ;
        }

        $this->create([
            'name' => $param['name'],
            'uid' => $param['uid'],
            'count' => 0,
            'state' => self::$state['use'],
        ]);
    }

    //删除用户的一个分类，并返回下一个分类，并将日记添加到其中
    public function deleteCat($uid, $cid){
        $model = $this->find($cid);
        $model->state = self::$state['delete'];
        $model->save();
        return $this->firstOrNewId($uid);
    }

    //获取笔记类别的第一个类
    public function firstId($uid){
        $st = self::$state['use'];
        $modColl = static::whereRaw('uid={$uid} and state={$st}')->get();
        if ($modColl->count() > 0) {
            $id = $modColl->first()->getAttribute['id'];
            return $id;
        } else {
            return null;
        }
    }

    public function createNewCat($uid, $name = null){
        $username = $name ? '思维笔记' ： $name;
        $model = $this->create([
            'name' => $username,
            'count' => 0,
        ]);
        return $model['id'];
    }

    //分类的数量减去$num
    public function counReduce($cid, $num) {
        $model = static::find($cid);
        $model->count = $model->count->$num;
        $model->save();
    }
}
