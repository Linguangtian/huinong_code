<?php

namespace app\utils;
use app\models\Xiaofeigulog;
use app\models\User;
use app\hejiang\ApiResponse;
class AddXiaofeiguLog
{
    public $store_id;
    public $user_id;


    public function __construct($store_id, $user_id)
    {
        $this->store_id = $store_id;
        $this->user_id = $user_id;
    }

    public function AddLog($arr)
    {

        $user = User::findOne(['id' => $this->user_id, 'store_id' => $this->store_id]);
        if(!$user){
            return;
        }


       
        $xiaofeiguLog = new XiaofeiguLog();
        $xiaofeiguLog->user_id = $user->id;
        $xiaofeiguLog->store_id = $this->store_id;
        $xiaofeiguLog->order_id = $arr['order_id'];
        $xiaofeiguLog->change_type =$arr['change_type'];
        $xiaofeiguLog->proportion =$arr['proportion'];
        $xiaofeiguLog->shore_desc = $arr['shore_desc']?trim($arr['shore_desc']):'无备注';
        $xiaofeiguLog->change_desc = $arr['change_desc']?trim($arr['change_desc']):'无表述';
        $xiaofeiguLog->create_time = date("Y-m-d H:i:s",time());
        $xiaofeiguLog->create_time = date("Y-m-d H:i:s",time());

        $xiaofeiguLog->type = $arr['type'];
        if ($arr['type'] == '2') {
            $xiaofeiguLog->amount = $arr['amount']*-1;
        } elseif ($arr['type']  == '1') {
            $xiaofeiguLog->amount = $arr['amount'];
        }

        $current_amount=$user->xiaofeigu_amount+$xiaofeiguLog->amount;
        if($current_amount<0) return false;

        $xiaofeiguLog->current_amount = $current_amount;
        $xiaofeiguLog->save();

        $user->xiaofeigu_amount=$current_amount;


        if (!$user->save()) {
            return [
                'code' => 1,
                'msg' => '操作失败！请重试',
            ];
        }else{
            return [
                'code' => 0,
                'msg' => '操作成功',
            ];
        }
    }
}
