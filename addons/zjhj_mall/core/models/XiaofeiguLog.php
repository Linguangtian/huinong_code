<?php

namespace app\models;

use app\models\common\admin\log\CommonActionLog;
use Yii;


class XiaofeiguLog extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return '{{%xiaofeigu_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'store_id', 'amount', 'change_type', 'shore_desc', 'create_time','current_amount'], 'required'],
            [['user_id', 'store_id', 'order_id', 'change_type','type'], 'integer'],
            [['shore_desc','change_desc'], 'string'],
            [[ 'shore_desc','change_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => '店铺id',
            'user_id' => '用户id',
            'order_id' => '订单id',
            'amount' => '数量',
            'change_desc' => '描述',
            'shore_desc' => '简述',
            'create_time' => '创建时间',
            'current_amount' => '当前数量',
            'change_type' => '明细类型 （0 其他 1 完成订单赠送 2 平台操作）',
            'type' => '类型 （ 1 增加 2 减少）',
            'proportion' => '消费股比例',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $data = $insert ? json_encode($this->attributes) : json_encode($changedAttributes);
        CommonActionLog::storeActionLog('', $insert, 0, $data, $this->id);
    }


}
