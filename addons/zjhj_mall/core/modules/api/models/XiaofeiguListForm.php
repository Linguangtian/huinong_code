<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/18
 * Time: 19:13
 */

namespace app\modules\api\models;

use app\models\Goods;
use app\models\Mch;
use app\models\Option;
use app\models\XiaofeiguLog;
use app\models\Order;
use app\models\User;
use app\models\OrderDetail;
use app\models\OrderRefund;
use yii\data\Pagination;
use yii\helpers\VarDumper;

class XiaofeiguListForm  extends ApiModel
{
    public $store_id;
    public $user_id;
    public $status;
    public $page;
    public $limit;
    public $order_id;

    public function rules()
    {
        return [
            [['page', 'limit', 'status',], 'integer'],
            [['page',], 'default', 'value' => 1],
            [['limit',], 'default', 'value' => 20],
            [['order_id'],'trim']
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return $this->errorResponse;
        }
        $query = XiaofeiguLog::find()
                ->andWhere(['store_id'=>$this->getCurrentStoreId(),'user_id'=>$this->getCurrentUserId()]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'page' => $this->page - 1, 'pageSize' => $this->limit]);
        $list = $query->limit($pagination->limit)->offset($pagination->offset)->orderBy('id DESC')->all();
        $new_list = $this->newLog();

        $count_list=count($list)?0:1;

        return [
            'code' => $count_list,
            'msg' => 'success',
            'data' => [
                'row_count' => $count,
                'page_count' => $pagination->pageCount,
                'list' => $list,
                'new_list' => $new_list
            ],
        ];
    }

    /*最新的10条记录*/
    public function newLog(){
        $query = XiaofeiguLog::find()->alias('xfg')
            ->leftJoin(['u'=>User::tableName()],'u.id=xfg.user_id')
            ->andWhere(['xfg.store_id'=>$this->getCurrentStoreId()])
            ->andWhere(['xfg.change_type'=>[1,3,4,5,6]])
            ->select(['xfg.*','u.nickname'])
            ->orderBy('xfg.id DESC')
            ->limit(10)
            ->asArray()
            ->all();

     return $query;

    }

}
