<?php
/**
 * @author Jasmine2.
 * FileName: main.php
 * Date: 2016-4-22
 * Time: 09:59
 */
use yii\helpers\Html;
use jasmine2\dwz\DwzAsset;
use jasmine2\dwz\Alert;
DwzAsset::register($this);
$dwzBaseUrl = $this->getAssetManager()->getBundle(DwzAsset::className())->baseUrl;
?>
<!DOCTYPE HTML>
<?php $this->beginPage()?>
<html lang="<?= Yii::$app->language?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title)?></title>
	<!--[if IE]>
	<link href="<?= $dwzBaseUrl?>/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
	<![endif]-->

	<!--[if lt IE 9]><script src="<?= $dwzBaseUrl?>/js/speedup.js" type="text/javascript"></script><script src="js/jquery-1.11.3.min.js" type="text/javascript"></script><![endif]-->
	<!--[if gte IE 9]><!-->
	<script src="<?= $dwzBaseUrl?>/js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<!--<![endif]-->
	<?php $this->head()?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="layout">
	<div id="header">
		<div class="headerNav">
			<a href="#" class="logo">标志</a>
			<ul class="nav">
				<li id="switchEnvBox"><a href="javascript:">（<span>北京</span>）切换城市</a>
					<ul>
						<li><a href="sidebar_1.html">北京</a></li>
						<li><a href="sidebar_2.html">上海</a></li>
						<li><a href="sidebar_2.html">南京</a></li>
						<li><a href="sidebar_2.html">深圳</a></li>
						<li><a href="sidebar_2.html">广州</a></li>
						<li><a href="sidebar_2.html">天津</a></li>
						<li><a href="sidebar_2.html">杭州</a></li>
					</ul>
				</li>
				<li><a href="donation.html" target="dialog" height="400" title="捐赠 & DWZ学习视频">捐赠</a></li>
				<li><a href="changepwd.html" target="dialog" width="600">设置</a></li>
				<li><a href="http://www.cnblogs.com/dwzjs" target="_blank">博客</a></li>
				<li><a href="http://weibo.com/dwzui" target="_blank">微博</a></li>
				<li><a href="login.html">退出</a></li>
			</ul>
			<ul class="themeList" id="themeList">
				<li theme="default"><div class="selected">蓝色</div></li>
				<li theme="green"><div>绿色</div></li>
				<!--<li theme="red"><div>红色</div></li>-->
				<li theme="purple"><div>紫色</div></li>
				<li theme="silver"><div>银色</div></li>
				<li theme="azure"><div>天蓝</div></li>
			</ul>
		</div>
	</div>
	<!--end header-->
	<div id="leftside">
		<div id="sidebar_s">
			<div class="collapse">
				<div class="toggleCollapse"><div></div></div>
			</div>
		</div>
		<div id="sidebar">
			<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

			<div class="accordion" fillSpace="sidebar">
				<?= \jasmine2\dwz\Accordion::widget(['items'=>isset(\Yii::$app->params['menus'])?\Yii::$app->params['menus']:null,'options'=>['class'=>'tree treeFolder expend']])?>
			</div>
		</div>
	</div>
	<!--end leftside-->
	<div id="container">
		<div id="navTab" class="tabsPage">
			<div class="tabsPageHeader">
				<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
					<ul class="navTab-tab">
						<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
					</ul>
				</div>
				<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
				<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
				<div class="tabsMore">more</div>
			</div>
			<ul class="tabsMoreList">
				<li><a href="javascript:;">我的主页</a></li>
			</ul>
			<div class="navTab-panel tabsPageContent layoutBox">
				<div class="page unitBox">
					<h1>这是什么</h1>
				</div>
			</div>
		</div>
	</div>
	<!--end container-->
</div>
<div id="footer">
	Copyright &copy; 2010 <a href="demo_page2.html" target="dialog">DWZ团队</a> 京ICP备15053290号-2
</div> <!--end footer-->
<!-- end layout -->
<?php $this->endBody() ?>
<script type="text/javascript">
	$(function(){
		DWZ.init("<?= $dwzBaseUrl?>/xml/dwz.frag.xml", {
			//loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
			statusCode:{ok:200, error:300, timeout:301}, //【可选】
			pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
			keys: {statusCode:"statusCode", message:"message"}, //【可选】
			ui:{hideMode:'offsets'}, //【可选】hideMode:navTab组件切换的隐藏方式，支持的值有’display’，’offsets’负数偏移位置的值，默认值为’display’
			debug:true,	// 调试模式 【true|false】
			callback:function(){
				initEnv();
				$("#themeList").theme({themeBase:"<?= $dwzBaseUrl?>/themes"}); // themeBase 相对于index页面的主题base路径
			}
		});
		// todo 不知道什么原因会导致我的主页标签看不见，查看不知道那个位置将navTab-tab 的left设置为了一个负数，您要是知道敬请告知，感激不尽！
		setTimeout(function () {
			$(".navTab-tab").css({'left':'0'});
		},600);
	});
</script>
</body>
</html>
<?php $this->endPage()?>