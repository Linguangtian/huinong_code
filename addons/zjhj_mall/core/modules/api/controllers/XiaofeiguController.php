<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/17
 * Time: 11:47
 */

namespace app\modules\api\controllers;

use app\hejiang\ApiResponse;
use app\hejiang\BaseApiResponse;
use app\models\Order;
use app\modules\api\behaviors\LoginBehavior;
use app\modules\api\models\ExpressDetailForm;
use app\modules\api\models\LocationForm;
use app\modules\api\models\OrderClerkForm;
use app\modules\api\models\OrderCommentForm;
use app\modules\api\models\OrderCommentPreview;
use app\modules\api\models\OrderConfirmForm;
use app\modules\api\models\OrderDetailForm;
use app\modules\api\models\OrderListForm;
use app\modules\api\models\XiaofeiguListForm;
use app\modules\api\models\OrderPayDataForm;
use app\modules\api\models\OrderRefundDetailForm;
use app\modules\api\models\OrderRefundForm;
use app\modules\api\models\OrderRefundPreviewForm;
use app\modules\api\models\OrderRefundSendForm;
use app\modules\api\models\OrderRevokeForm;
use app\modules\api\models\OrderSubmitForm;
use app\modules\api\models\OrderSubmitPreviewForm;
use app\modules\api\models\QrcodeForm;

class XiaofeiguController extends Controller
{
	
    public function behaviors()
    {
		
		
      return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginBehavior::className(),
            ],
        ]);
    }




    //订单列表
    public function actionList()
    {
        $form = new XiaofeiguListForm();
        $form->attributes = \Yii::$app->request->get();
        $form->store_id = $this->store->id;
        $form->user_id = \Yii::$app->user->id;
        return new BaseApiResponse($form->search());
    }




}
