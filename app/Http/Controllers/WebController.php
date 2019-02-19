<?php
/**
 * Created by PhpStorm.
 * User: lfq
 * Date: 2019/2/15
 * Time: 8:25 PM
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Controllers\Auth\Guard;
use Request;
use Validator;
use App\Models\Users;
use App\Models\TbCategory;
use App\Models\TbRecords;

class WebController extends Controller
{
    //自定义模版引擎的属性信息
    private $attributes = array();
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
        if($this->auth->user()){
            $this->authSave();
        }
    }

    private function authSave(){
        $this->attributes['username'] = $this->auth->user()->getAttribute('username');
        $this->attributes['uid'] = $this->auth->id();
    }

    //查询属性信息
    private function getAttribute($key){
        return $this->attributes[$key];
    }

    //在attribute中放置的属性
    private function addAttributes($param, $value){
        return $this->attributes[$param] = $value;
    }


    //web 访问根目录时的功能
    public function getIndex(){
        $user = $this->auth-user();
        return view('/backyard/index/index')->with('attributes', $this->attributes);
    }

    //会员信息列表
    public function getUserList(){
        $model = new Users();
        $data = $model->findAll()->toArray();
        $this->addAttributes('userList', $data);
        return view('/backyard/user/index')->with('attributes', $this->attributes);
    }


    //显示笔记类别信息
    public function getCategorylist(){
        $model = new TbCategory();
        $data  = $model->findUserAll($this->getAttibute('uid'));
        $this->addAttributes('cateList', $data);
        return view('/backyard/category/index')->with('attributes', $this->attributes);
    }

    //添加笔记类别
    public function getCategoryadd(){
        return view('/backyard/categoru/add')->with('attributes', $this->attributes);
    }

    //添加笔记类别
    public function postCategoryadd(){
        $model = new TbCategory();
        $param = $_POST;
        $param['uid'] = $this->attribute('uid');
        $param['count'] = 0;
        $param['state'] = TbCategory::state['use'];
        $model->categoryAdd($param);
        return redirect('/web/categorylist');
    }

    //删除一个分类
    public function getDeletecat($cid){
        $model = new TbCategory();
        $nextId = $model->deleteCat($this->getAttribute('uid'), $cid);
        $remodel = new TbRecords();
        $num = $remodel->changeCat($this->getAttribute('uid'), $cid, $nextId);
        $nextCat = $model->find($nextId);
        $nextCat->count = $nextCat->count+$num;
        $nextCat->save();
        return redirect("/web/categorylist");
    }

    //加载笔记列表列
    public function getNotesList($cid=0){
        $model = new TbRecords();
        $data = $model->findUserAll($this->getAttribute('uid'), $cid);
        $this->addAttributes('recordsList', $data);
        return view('backyard/notes/index')->with('attributes', $this->attributes);
    }

    //添加笔记
    public function getNotesadd(){
        $model = new TbCategory();
        $data = $model->findUserAll($this->getAttribute('uid'));
        $this->addAttributes('cglist', $data);
        return view("/backyard/notes/add")->with('attributes', $this->attributes);
    }

    //插入笔记
    public function postNotesinsert(){
        $validator = $this->validator(REquest::all());
        if ($validator->fails()){
            $this->throwValidationException(
                Request::instance(), $validator
            );
        }

        //准备数据
        $model = new TbCategory();
        $param = $_POST;
        $param['uid'] = $this->getAtribute('uid');
        $param['cid'] = (!empty($param['cid'])) ? $param['cid'] : $model->firstOrNewId($this->getAttribute('uid'));
        $param['addtime'] = time();
        $param['state'] = 1;

        //  存储笔记
        $rmoel = new TbRecords();
        $suc = $rmodel->insert($param);
        if ($suc) {
            return redirect('/web/noteslist');
        } else {
            return redirect('/web/notesadd');
        }
    }

    //验证插入笔记的内容
    private function validator(array $data) {
        return Validator::make([
            'title' => 'required |max:255',
            'content' => 'required',
        ]);
    }


    //删除笔记
    public function getDeleteNote($id){
        $model = TbRecords::find($id);
        $model->state = TbRecords::state['delete'];
        $cid = $model->cid;
        $model->save();

        $catModel = new TbCategory();
        $catModel->counteduceI($cid, 1);
        return direct("/web/noteslist");
    }

    //编辑笔记
    public function getNoteedit($id){
        $model = new TbCategory();
        $catData = $model->findUserAll($this->getAttribute('uid'));
        $this->addAttributes('cglist', $catData);
        $model = TbRecords::find($id);
        $data = $model->toArray();
        $data['attributes'] = $this->attributes;
        return view('/backyard/notes/edit', $data);
    }

    //更改笔记内容
    public function getNoteChange($id){
        $model = TbRecords::find($id);
        $model->fill($_POST);
        $model->save();
        return redirect('/web/noteslist');
    }

    //显示笔记内容
    public function getNodtshow($id){
        $model = TbRecords::find($id);
        $data = $model->getAttributes();
        $data['attributes'] = $this->attributes;
        return view('/backyard/notes/show', $data);
    }
}



