<?php
/**
 * link: http://www.zjhejiang.com/
 * copyright: Copyright (c) 2018 浙江禾匠信息科技有限公司
 * author: wxf
 */

namespace app\modules\mch\models\user\xiaofeigu;

use app\models\Xiaofeigulog;
use app\models\User;
use app\modules\mch\models\MchModel;
use app\modules\mch\models\UserExportList;
use yii\data\Pagination;

class IndexXiaofeigulogForm extends MchModel
{
    public $userid;
    public $type = '';
    public $fields;
    public $flag;
    public $date_start;
    public $date_end;
    public $keyword;
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['flag', 'date_start', 'date_end','fields','keyword'], 'trim'],
            [['userid'], 'integer'],
            [['fields'], 'safe'],
            ['username','required','message' => '用户名不能为空'],
            ['password','required']
        ];
    }

	 public function getList($type)
    {
       
        $list = [
            [
                'key' => 'id_no',
                'value' => '序列号',
                'type' => [1]
            ],
            [
                'key' => 'nickname',
                'value' => '昵称',
                'type' => [2]
            ],
            [
                'key' => 'order_no',
                'value' => '关联的订单号',
                'type' => [1, 2]
            ],
           
            [
                'key' => 'amount',
                'value' => '数量',
                'type' => [1, 2]
            ],
            
            [
                'key' => 'change_desc',
                'value' => '描述',
                'type' => [1]
            ],
            [
                'key' => 'shore_desc',
                'value' => '备注',
                'type' => [1]
            ],
			[
                'key' => 'create_time',
                'value' => '发生时间',
                'type' => [1,2]
            ],
            [
                'key' => 'after_amount',
                'value' => '当前剩余消费股',
                'type' => [1,2]
            ],
            [
                'key' => 'proportion',
                'value' => '当前消费股比例',
                'type' => [1,2]
            ],     
        ];

        $newArr = [];
		$type=1;
        foreach ($list as $item) {
            if (in_array($type, $item['type'])) {
                $newArr[] = $item;
            }
        }

        return $newArr;
    }
    public function getXiaofeigulogList()
    {

        $query = XiaofeiguLog::find()->alias('xfg')
            ->leftJoin(['u'=>User::tableName()],'u.id=xfg.user_id')
            ->andWhere(['xfg.store_id' => $this->getCurrentStoreId()]);

        if ($this->userid) {
            $query->andWhere(['u.id' => $this->userid]);
        }

        if ($this->date_start) {
            $query->andWhere(['>', 'xfg.create_time', $this->date_start]);
        }

        if ($this->date_end) {
            $query->andWhere(['<', 'xfg.create_time', $this->date_end ]);
        }

          if ($this->keyword) {
              $query->andWhere(['like', 'u.nickname', trim($this->keyword)])->orWhere(['like', 'u.binding', trim($this->keyword)]);
          }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        $list = $query->select('xfg.*,u.nickname')
            ->orderBy('id DESC')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->asArray()
            ->all();

    /*    if ($this->flag == "EXPORT") {
            $userExport = new UserExportList();
            $userExport->fields = $this->fields;
            $userExport->integralForm($list);
        }*/

        return [
            'list' => $list,
            'pagination' => $pagination
        ];
    }
}
