<?php
defined('YII_ENV') or exit('Access Denied');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/8
 * Time: 14:57
 */
/* @var $pagination yii\data\Pagination */
/* @var $setting \app\models\Setting */
use yii\widgets\LinkPager;

$urlManager = Yii::$app->urlManager;
$this->title = '消费股记录';
$this->params['active_nav_group'] = 4;
$status = Yii::$app->request->get('status');
if ($status === '' || $status === null || $status == -1) {
    $status = -1;
}
?>
<style>
    .status-item.active {
        color: inherit;
    }
</style>
<div class="panel mb-3">
    <div class="panel-header"><?= $this->title ?></div>
    <div class="panel-body" id="app">
        <div class="mb-3 clearfix">
            <form method="get">
                <?php $_s = ['keyword', 'date_start', 'date_end', 'page', 'per-page'] ?>
                <?php foreach ($_GET as $_gi => $_gv) :
                    if (in_array($_gi, $_s)) {
                        continue;
                    } ?>
                    <input type="hidden" name="<?= $_gi ?>" value="<?= $_gv ?>">
                <?php endforeach; ?>
                <div flex="dir:left">
                    <div class="mr-3 ml-3">
                        <div class="form-group row">
                            <div>
                                <label class="col-form-label">下单时间：</label>
                            </div>
                            <div>
                                <div class="input-group">
                                <input class="form-control" id="date_start" name="date_start"
                                       autocomplete="off"
                                       value="<?= isset($_GET['date_start']) ? trim($_GET['date_start']) : '' ?>">
                                    <span class="input-group-btn">
                                        <a class="btn btn-secondary" id="show_date_start" href="javascript:">
                                            <span class="iconfont icon-daterange"></span>
                                        </a>
                                    </span>
                                    <span class="middle-center input-group-addon" style="padding:0 4px">至</span>
                                    <input class="form-control" id="date_end" name="date_end"
                                           autocomplete="off"
                                           value="<?= isset($_GET['date_end']) ? trim($_GET['date_end']) : '' ?>">
                                    <span class="input-group-btn">
                                        <a class="btn btn-secondary" id="show_date_end" href="javascript:">
                                            <span class="iconfont icon-daterange"></span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div>
                                <label class="col-form-label">昵称/电话：</label>
                            </div>
                            <div>
                                <div class="input-group">
                                    <input class="form-control"  name="keyword"  value="<?= isset($_GET['keyword']) ? trim($_GET['keyword']) : '' ?>">
                                </div>
                            </div>
                        </div>
                        <input class="form-control"  name="userid"  hidden value="0">
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="middle-center mr-2">
                        <a href="javascript:" class="new-day btn btn-primary mr-2" data-index="7">近7天</a>
                        <a href="javascript:" class="new-day btn btn-primary mr-2" data-index="30">近30天</a>
                    </div>
                    <div class="form-group">
                        <button style="margin-left: 3px;" class="btn btn-primary mr-4">筛选</button>
                  <!--      <a class="btn btn-secondary export-btn" href="javascript:">批量导出</a>-->
                    </div>
                </div>
            </form>
        </div>
        <div class="text-danger"></div>
        <table class="table table-bordered bg-white">
            <tr>
                <td width="50px">序列号</td>
                <td width="200px">昵称</td>

                <td width="200px">消费股数量</td>
                <td width="250px">描述</td>
                <td width="250px">备注</td>
                <td width="200px">创建时间</td>
                <td width="200px">当前剩余消费股</td>
                <td width="200px">当前消费股比例</td>
            </tr>
            <?php foreach ($list as $index => $value) : ?>
                <tr>
                    <td><?= $index ?></td>
                    <td><?= $value['nickname'] ?></td>

                    <!--消费股数量 -->
                    <?php if($value['type'] == 1): ?>
                    <td style="color: limegreen"> +<?= $value['amount'] ?></td>
                    <?php elseif($value['type'] == 2): ?>
                     <td style="color: red">     <?= $value['amount'] ?></td>
                    <?php else: ?>
                        <td>     <?= $value['amount'] ?></td>
                    <?php endif; ?>
                    <!--消费股数量 -->
                    <td ><?= $value['change_desc'] ?></td>
                    <td ><?= $value['shore_desc'] ?></td>
                    <td ><?= $value['create_time'] ?></td>

                    <!--操作明细 -->
                 <!--   <?php /*if($value['change_type'] == 1): */?>
                        <td > 完成订单赠送</td>
                    <?php /*elseif($value['change_type'] == 2): */?>
                        <td>  平台操作</td>
                    <?php /*else: */?>
                        <td style="color: red"> 其他</td>
                    --><?php /*endif; */?>
                    <!--操作明细 -->

                    <td ><?= $value['current_amount'] ?></td>
                    <td >1:<?= $value['proportion'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="text-center">
            <nav aria-label="Page navigation example">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $pagination,
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                ]) ?>
            </nav>
        </div>
    </div>
</div>

<?= $this->render('/layouts/ss', [
    'exportList'=>$exportList
]) ?>
