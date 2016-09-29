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
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="javascript:;">所有房源</a></li>
			<li><a href="<?php echo U('AdminEmployee/add',array('term'=>empty($term['term_id'])?'':$term['term_id']));?>" target="_self">添加房源</a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('AdminEmployee/index');?>">
			<div class="search_type cc mb10">
				<div class="mb10">
					<span class="mr20">分类： 
						<select class="select_2" name="term">
							<option value='0'>全部</option><?php echo ($taxonomys); ?>
						</select> &nbsp;&nbsp;
						时间：
						<input type="text" name="start_time" class="J_date" value="<?php echo ((isset($formget["start_time"]) && ($formget["start_time"] !== ""))?($formget["start_time"]):''); ?>" style="width: 80px;" autocomplete="off">-
						<input type="text" class="J_date" name="end_time" value="<?php echo ((isset($formget["end_time"]) && ($formget["end_time"] !== ""))?($formget["end_time"]):''); ?>" style="width: 80px;" autocomplete="off"> &nbsp; &nbsp;
						姓名： 
						<input type="text" name="keyword" style="width: 200px;" value="<?php echo ((isset($formget["keyword"]) && ($formget["keyword"] !== ""))?($formget["keyword"]):''); ?>" placeholder="请输入关键字...">
						<input type="submit" class="btn btn-primary" value="搜索" />
					</span>
				</div>
			</div>
		</form>
		<form class="J_ajaxForm" action="" method="post">
			<div class="table-actions">
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/listorders');?>">排序</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/check',array('check'=>1));?>" data-subcheck="true">审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/top',array('top'=>1));?>" data-subcheck="true">置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/top',array('untop'=>1));?>" data-subcheck="true">取消置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/recommend',array('recommend'=>1));?>" data-subcheck="true">推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/recommend',array('unrecommend'=>1));?>" data-subcheck="true">取消推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
				<button class="btn btn-primary btn-small J_articles_move" type="button">批量移动</button>
			</div>
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label><?php echo ($vo["eid"]); ?></th>
						
						
						<th width="40">房源类型</th>
						<th width="90">房源标题</th>
						<th width="60">户型</th>
						<th width="60">入住时间</th>
						
						<th width="40">出租方式</th>
						<th width="50">缩略图</th>
						<th width="80">面积</th>
						<th width="50">联系人</th>
                        <th width="50">联系电话</th>
                        
                        
						<th width="50">状态</th>
						<th width="60">操作</th>
                        <th width="60">管理</th>
                        <th width="60">更新时间</th>
					</tr>
				</thead>
				<?php $status=array("1"=>"审","0"=>""); $top_status=array("1"=>"顶","0"=>""); $recommend_status=array("1"=>"荐","0"=>""); $leibie=C('leibie'); $housefield=C('housefield'); $serveritemarr=C('serveritem'); $housetype=C('housetype'); ?>
				<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
					<td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["eid"]); ?>" title="ID:<?php echo ($vo["eid"]); ?>"></td>
					
					<td><a href="<?php echo U('jiazheng/employee/index',array('eid'=>$vo['eid']));?>" target="_blank"> <span><?php echo ($serveritemarr[$vo['serveritem']]); ?></span></a></td>
					
					<td><?php echo ($vo["title"]); ?></td>
					<td><?php echo ($vo['hxs']); ?>室<?php echo ($vo['hxt']); ?>厅<?php echo ($vo['hxw']); ?>卫</td>
					<td><?php echo ($vo['ruzhudate']); ?></td>
					
					<td><a href="javascript:open_iframe_dialog('<?php echo U('comment/commentadmin/index',array('post_id'=>$vo['uid']));?>','评论列表')"><?php echo ($housetype[$housefield[$vo['serveritem']]][$vo['housetype']]); ?>-<?php echo ($leibie[$housefield[$vo['serveritem']]][$vo['leibie']]); ?></a></td>
					<td>
						
						<?php if(!empty($vo[photo])): ?><a href="<?php echo ($vo["photo"]); ?>" target='_blank'>查看</a><?php endif; ?>
					</td>
					<td><?php echo ($vo["mj"]); ?></td>
					<td><?php echo ($vo['ename']); ?></td>
                    <td><?php echo ($vo['ephone']); ?></td>
					<td><?php echo ($status[$vo['status']]); ?>-<?php echo ($top_status[$vo['istop']]); ?>-<?php echo ($recommend_status[$vo['recommended']]); ?>
					</td>
					<td>
						<a href="<?php echo U('AdminEmployee/edit',array('term'=>empty($term['term_id'])?'':$term['term_id'],'eid'=>$vo['eid']));?>">修改</a> | 
						<a href="<?php echo U('AdminEmployee/delete',array('term'=>empty($term['term_id'])?'':$term['term_id'],'eid'=>$vo['eid']));?>" class="J_ajax_del">删除</a></td>
                    <td><?php echo ($vo['user_login']); ?></td>
                    <td><?php echo (date('m-d H:i',$vo['update_time'])); ?></td>
				</tr><?php endforeach; endif; ?>
				<tfoot>
					<tr>
						<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
						
						<th width="40">房源类型</th>
						<th width="90">房源标题</th>
						<th width="60">户型</th>
						<th width="60">入住时间</th>
						
						<th width="40">出租方式</th>
						<th width="50">缩略图</th>
						<th width="80">面积</th>
						<th width="50">联系人</th>
                        <th width="50">联系电话</th>
                        
                        
						<th width="50">状态</th>
						<th width="60">操作</th>
                        <th width="60">管理</th>
                        <th width="60">更新时间</th>
					</tr>
				</tfoot>
			</table>
			<div class="table-actions">
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/listorders');?>">排序</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/check',array('check'=>1));?>" data-subcheck="true">审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/top',array('top'=>1));?>" data-subcheck="true">置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/top',array('untop'=>1));?>" data-subcheck="true">取消置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/recommend',array('recommend'=>1));?>" data-subcheck="true">推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/recommend',array('unrecommend'=>1));?>" data-subcheck="true">取消推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminEmployee/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
				<button class="btn btn-primary btn-small J_articles_move" type="button">批量移动</button>
			</div>
			<div class="pagination"><?php echo ($Page); ?></div>

		</form>
	</div>
	<script src="/fang/statics/js/common.js"></script>
	<script>
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location = "<?php echo U('AdminEmployee/index',$formget);?>";
			}
		}
		setInterval(function() {
			refersh_window();
		}, 2000);
		$(function() {
			setCookie("refersh_time", 0);
			Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
				//批量移动
				$('.J_articles_move').click(
						function(e) {
							var str = 0;
							var id = tag = '';
							$("input[name='ids[]']").each(function() {
								if ($(this).attr('checked')) {
									str = 1;
									id += tag + $(this).val();
									tag = ',';
								}
							});
							if (str == 0) {
								art.dialog.through({
									id : 'error',
									icon : 'error',
									content : '您没有勾选信息，无法进行操作！',
									cancelVal : '关闭',
									cancel : true
								});
								return false;
							}
							var $this = $(this);
							art.dialog.open(
									"/fang/index.php?g=Jiazheng&m=AdminEmployee&a=move&ids="
											+ id, {
										title : "批量移动",
										width : "80%"
									});
						});
			});
		});
	</script>
</body>
</html>