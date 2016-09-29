<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
<link rel="icon" href="/fang/tpl_admin/simpleboot/Public/images/favicon.ico" type="image/x-icon" />
	<link href="/fang/statics/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/fang/statics/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/fang/statics/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/fang/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/fang/statics/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/fang/statics/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/fang/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/fang/statics/js/jquery-1.11.3.min.js?v=20160415"></script>
    <script src="/fang/statics/js/wind.js"></script>
    <script src="/fang/statics/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
<body class="J_scroll_fixed">
	<div class="wrap jj">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('setting/site');?>">网站信息</a></li>
			<li><a href="<?php echo U('route/index');?>">URL美化</a></li>
			<li><a href="<?php echo U('route/add');?>">添加URL规则</a></li>
		</ul>
		<form method="post" class="form-horizontal J_ajaxForm" action="<?php echo U('route/edit_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">原始网址:</label>
					<div class="controls">
						<input type="text" class="input" name="full_url" value="<?php echo ($full_url); ?>"><span class="must_red">*,网址格式为：模块/控制器/动作,如：jiazheng/gongsi/index</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">显示网址:</label>
					<div class="controls">
						<input type="text" class="input" name="url" value="<?php echo ($url); ?>"><span class="must_red">*，网址格式为：模块/其它，如：jiazheng/list/:id</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">是否启用:</label>
					<div class="controls">
						<select name="status" class="normal_select">
							<option value="1">启用</option>
							<?php $status_selected=$status?"":"selected"; ?>
							<option value="0" <?php echo ($status_selected); ?>>禁用</option>
						</select>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" class="input" name="id" value="<?php echo ($id); ?>">
				<button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">保存</button>
				<a class="btn" href="/fang/Admin/Route">返回</a>
			</div>
            <div>注意：添加了路由器后，会在data/config/route目录下生成与模块名称一样的路由器文件，以便在相应模块的config中调用<br />
            为保证添加的路由器地址整站一致，在模板中请使用:leuu来生成地址格式</div>
		</form>
	</div>
	<script src="/fang/statics/js/common.js"></script>
</body>
</html>