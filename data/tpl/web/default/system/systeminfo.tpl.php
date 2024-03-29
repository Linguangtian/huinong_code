<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">系统信息</div>
<ul class="we7-page-tab"></ul>
<div class="main">
		
	<table class="table we7-table table-hover site-list">
		<col widtd="120px" />
		<col widtd="120px" />
		<tr>
			<th colspan="2" class="text-left">用户信息</th>
		</tr>
		<tr>
			<td class="text-left">用户ID</td>
			<td class="text-left"><?php  echo $info['uid'];?></td>
		</tr>
		<tr>
			<td class="text-left">当前公众号</td>
			<td class="text-left"><?php  echo $info['account'];?></td>
		</tr>
	</table>
	
	<table class="table we7-table table-hover site-list">
		<tr>
			<th colspan="2" class="text-left">系统信息</th>
		</tr>
		<tr>
			<td class="text-left">系统程序版本</td>
			<td class="text-left">WeEngine <?php  echo IMS_VERSION;?> Release <?php  echo IMS_RELEASE_DATE;?> &nbsp; &nbsp;
				<a href="http://www.we7.cc" target="_blank" style="color: #428bca;">查看最新版本</a>
			</td>
		</tr>
		<tr>
			<td class="text-left">产品系列</td>
			<td class="text-left">
				<?php  if(IMS_FAMILY == 'v') { ?>
				您的产品是开源版, 没有购买商业授权, 不能用于商业用途
				<?php  } else if(IMS_FAMILY == 's') { ?>
				您的产品是授权版
				<?php  } else if(IMS_FAMILY == 'x') { ?>
				您的产品是商业版
				<?php  } else { ?>
				您的产品是单版
				<?php  } ?>
			</td>
		</tr>
		<tr>
			<td class="text-left">服务器系统</td>
			<td class="text-left"><?php  echo $info['os'];?></td>
		</tr>
		<tr>
			<td class="text-left">PHP版本 </td>
			<td class="text-left">PHP Version <?php  echo $info['php'];?></td>
		</tr>
		<tr>
			<td class="text-left">服务器软件</td>
			<td class="text-left"><?php  echo $info['sapi'];?></td>
		</tr>
		<tr>
			<td class="text-left">服务器 MySQL 版本</td>
			<td class="text-left"><?php  echo $info['mysql']['version'];?></td>
		</tr>
		<tr>
			<td class="text-left">上传许可</td>
			<td class="text-left"><?php  echo $info['limit'];?></td>
		</tr>
		<tr>
			<td class="text-left">当前数据库尺寸</td>
			<td class="text-left"><?php  echo $info['mysql']['size'];?></td>
		</tr>
		<tr>
			<td class="text-left">当前附件根目录</td>
			<td class="text-left"><?php  echo $info['attach']['url'];?></td>
		</tr>
		<tr>
			<td class="text-left">当前附件尺寸</td>
			<td class="text-left"><?php  echo $info['attach']['size'];?></td>
		</tr>
	</table>

	<?php  if($_W['isfounder']) { ?>
	<table class="table we7-table table-hover site-list">
		<col width="150px" />
		<col width="" />
		<th colspan="2" class="text-left">系统开发团队</th>
		<tr>
			<td class="text-left">版权所有</td>
			<td>
				<a href="http://www.we7.cc/" target="_blank" style="color: #428bca;"><b>We7 Team</b></a>
			</td>
		</tr>
		<tr>
			<td class="text-left">Team 成员</td>
			<td class="text-left">
				<a href="http://bbs.we7.cc/?10906" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">袁文涛</a>; &nbsp;
				<a href="http://bbs.we7.cc/?83" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">任超 (米粥)</a>; &nbsp;
				<a class="lightlink2 smallfont" target="_blank" style="color: #428bca;">马德坤</a>; &nbsp;
				<a href="http://bbs.we7.cc/?19511" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">宋建君 (Gorden)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?64869" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">姚晶晶</a>; &nbsp;
				<a href="http://bbs.we7.cc/?83750" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">赵波</a>; &nbsp;
				<a href="http://bbs.we7.cc/?90981" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">曹春江</a>; &nbsp;
				<a href="http://bbs.we7.cc/?111463" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">杨峰</a>; &nbsp;
				<a href="http://bbs.we7.cc/?38439" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">卜睿君</a>; &nbsp;
				<a class="lightlink2 smallfont" target="_blank" style="color: #428bca;">张宏</a>; &nbsp;
				<a class="lightlink2 smallfont" target="_blank" style="color: #428bca;">高建业</a>; &nbsp;
				<br /><br />
				<a href="http://bbs.we7.cc/?56310" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">侯琪琪 (琪琪)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?52995" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">杨欣雨 (小雨)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?11877" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">赵小雷 (擎擎)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?75780" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">蔡帅帅 (小帅)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?80040" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">朱传宝 (阿宝)</a>; &nbsp;
				<a href="http://bbs.we7.cc/?98655" class="lightlink2 smallfont" target="_blank" style="color: #428bca;">蒋康康 (阿康)</a>; &nbsp;
				<a class="lightlink2 smallfont" target="_blank" style="color: #428bca;">王鹏 (鹏鹏)</a>; &nbsp;
			</td>
		</tr>
	
		<tr>
			<td class="text-left">相关链接</td>
			<td>
				<a href="http://www.we7.cc/" class="lightlink2" target="_blank" style="color: #428bca;">公司网站</a>&nbsp;&nbsp;
				<a href="http://www.we7.cc/purchase.html" class="lightlink2" target="_blank" style="color: #428bca;">购买授权</a>&nbsp;&nbsp;
				<a href="http://s.we7.cc/" class="lightlink2" target="_blank" style="color: #428bca;">更多模块</a>&nbsp;&nbsp;
				<a href="http://www.kancloud.cn/donknap/we7/136556" class="lightlink2" target="_blank" style="color: #428bca;">文档</a>&nbsp;&nbsp;
				<a href="http://bbs.we7.cc/" class="lightlink2" target="_blank" style="color: #428bca;">讨论区</a>
			</td>
		</tr>
	</table>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
