<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<html>
	<head>
		<title><?php echo ($title); ?> <?php echo ($site_name); ?> </title>
		<meta name="keywords" content="<?php echo ($term['name']); ?>" />
		<meta name="description" content="<?php echo ($title); ?>,<?php echo msubstr(strip_tags($resume),0,200);?>">
			<?php $portal_index_lastnews=2; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
	<meta name="author" content="jiazhengyc" />
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" /> 
   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
	<link rel="icon" href="/fang/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="/fang/tpl/simplebootx/Public/images/favicon.ico" type="image/x-icon" />   
    <link href="/fang/statics/simpleboot/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/fang/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
	<!--[if IE 7]>
	<link rel="stylesheet" href="/fang/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/fang/tpl/simplebootx/Public/css/style.css" rel="stylesheet" />
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
        
	</style>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
		
	</head>
<body>

<?php echo hook('body_start');?>
<nav class="navbar navbar-inverse navbar-static-top">
   
     <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" href="/">永川租房网</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="main-menu"> 
      
      
       	<?php
 $effected_id=""; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label <span class='caret'></span></a>"; $ul_class="dropdown-menu" ; $li_class="" ; $style="nav navbar-nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
        
		
		<ul class="nav  navbar-nav navbar-right" id="main-menu-user">
			<li class="dropdown user login">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	            <img src="/fang/tpl/simplebootx//Public/images/headicon.png" class="headicon"/>
	            <span class="user-nicename"></span><b class="caret"></b></a>
	            <ul class="dropdown-menu">
	               <li><a href="<?php echo u('user/center/index');?>"><i class="fa fa-user"></i> &nbsp;个人中心</a></li>
	               <li class="divider" role="separator"></li>
	               <li><a href="<?php echo u('user/index/logout');?>"><i class="fa fa-sign-out"></i> &nbsp;退出</a></li>
	            </ul>
          	</li>
          	<li class="dropdown user offline">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	           		<img src="/fang/tpl/simplebootx//Public/images/headicon.png" class="headicon"/>登录<b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'sina'));?>"><i class="fa fa-weibo"></i> &nbsp;微博登录</a></li>
	               <li><a href="<?php echo U('api/oauth/login',array('type'=>'qq'));?>"><i class="fa fa-qq"></i> &nbsp;QQ登录</a></li>
	               <li><a href="<?php echo u('user/login/index');?>"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
	               <li role="separator" class="divider"></li>
	               <li><a href="<?php echo u('user/register/index');?>"><i class="fa fa-user"></i> &nbsp;注册</a></li>
	            </ul>
          	</li>
		</ul>
        
        
		
       </div>
     </div>
   
 </nav>
<div class="container">
	<div class="row">
                <div class="col-md-12" style="margin-top: 20px;">
                <ol class="breadcrumb">
                
                
              <li><i class="fa fa-home fa-lg" style="font-size: 18px;line-height:16px;"></i><a href="/fang">永川租房网</a></li>
              <?php if(is_array($path)): $i = 0; $__LIST__ = $path;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($m["url"]); ?>"><?php echo ($m["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
              
             
            </ol>    
                
                </div>
		<div class="col-md-12">
			
			<div class="row">
            <div class="col-md-12">
                    
                                
                    <h2><?php echo ($title); ?></h2>
                    
                    <p class="text-left" style="color: #999;"><span style="margin-right: 5px;">房源编号：<?php echo ($eid); ?></span><span>更新时间：<?php echo (date("Y年m月d日 H时i分",$update_time)); ?> </span>
        		    		<span>
        		    			<i class="fa fa-eye"></i><span><?php echo ($hits); ?></span>
        						<a href="<?php echo leuu('index/do_like',array('eid'=>$eid));?>" class="J_count_btn"><i class="fa fa-thumbs-up"></i><span class="count"><?php echo ($likes); ?></span></a>
        			    		</span></p>
                            
                            
                    
            
            </div>
            <?php $pricetype_temp=C('pricetype'); $paytype_temp=C('paytype'); $serveritem_temp=C('serveritem'); $zhuangxiu_temp=C('zhuangxiu'); $xueliarr=C('XUELI'); $jingyanarr=C("jingyan"); $xiujiaarr=C("xiujia"); $caoxiangarr=C("caoxiang"); ?>
            
            
            
		    <div class="col-md-12">
		    <div class="panel panel-default" style="padding: 15px;">	
               
                <div class="pull-right">
                
                <?php if(empty($photo)): ?><img src="/fang/statics/images/personnoimg.jpg" id='thumb_preview' width='200' height='200' style='cursor:hand' />
			<?php else: ?>
				<img src="<?php echo sp_get_asset_upload_path($photo);?>" width='200' class="img_responsive img-rounded img-polaroid" /><?php endif; ?>
                </div>
                <div class="pull-left">
                        <dl class="dl-horizontal infolist">                            
                            <dt>出租租金</dt>
                            
                            <dd><span style="font-size: 2em;color:red;"><?php echo ($zj); ?></span><?php echo ($pricetype_temp[$pricetype]); ?>[<?php echo ($paytype_temp['house'][$paytype]); ?>]</dd>
                            <dt>房屋概况</dt>
                            <dd><span><?php echo ($serveritem_temp[$serveritem]); ?></span>
                            <span><?php echo ($hxs); ?>室<?php echo ($hxt); ?>厅<?php echo ($hxw); ?>卫</span>
                            <span><?php echo ($mj); ?>平米</span>
                            <span><?php echo ($lc); ?>/<?php echo ($lcall); ?>层</span>
                            <span>朝<?php echo ($caoxiangarr[$caoxiang]); ?></span>
                            <span><?php echo ($zhuangxiu_temp[$zhuangxiu]); ?></span>
                            </dd>
                            
                            <dt>所在区域</dt>
                            <dd>
                            <?php if(!empty($areaid)): ?><a href="<?php echo leuu('jiazheng/index/fangyuan',array('id'=>"$serveritem-$areaid-0-0-0-0-0-0"));?>" title="查看<?php echo ($distname); ?>租房信息"><?php echo ($distname); ?></a>
                                
                            <?php else: ?>
                              <?php echo ($distname); endif; ?>
                            <?php if(!empty($xqid)): ?><span>/</span>                            
                                <a href="<?php echo leuu('jiazheng/index/fangyuan',array('id'=>"$serveritem-$areaid-0-0-0-0-$xqid-0"));?>" title="查看<?php echo ($xqname); ?>房源信息"><?php echo ($xqname); ?></a><?php endif; ?>
                            
                            </dd>
                            <dt>租房地址</dt>
                            <dd><?php echo ($address); ?></dd>
                            <dt><i class="fa fa-phone"></i>Tel</dt>
                            <dd><?php echo ($ephone); ?>(<?php echo ($ename); ?>)</dd>
                            </dl>
                
                </div>
                <div class="clearfix"></div>
                <div class="text-center">
                <button type="button" class="btn btn-yuyue btn-lg" data-toggle="modal" data-target="#orderModal">马上预约</button>                
                </div>
                
                
               
    
            
             <?php  function strtostr($config_name,$input_name){ $c=C($config_name); $mye=explode(',',$input_name); $str=array(); foreach($mye as $v) { $str[]=$c["$v"]; } echo implode(",",$str); } ?>
            
  
                </div>
                <h3><span class="caret"></span>房源描述</h3>               
               <div class="panel panel-default">
               <div class="panel-body">
               <?php echo ($resume); ?></div>
               </div>
                
                <h3><span class="caret"></span>配套设施</h3>
                 
                
                <div class="panel panel-default">
                <?php $peitao_temp=C('peitao'); $housefield=C('housefield'); $housefield=$housefield[$serveritem]; $peitao_temp=$peitao_temp[$housefield]; $mypeitao=explode(',',$peitao); ?>
                <div class="panel-body">
                <?php if(is_array($peitao_temp)): $i = 0; $__LIST__ = $peitao_temp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><span class="label <?php echo in_array($key,$mypeitao)?'label-success':'label-default';?>" style="margin-right: 5px;"><?php echo ($p); echo in_array($key,$mypeitao)?'<i class="glyphicon glyphicon-ok"></i>':'';?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                </div>
                
                <h3><span class="caret"></span>房源图片</h3>               
               <div class="panel panel-default">
               <div class="panel-body">
               <?php if(is_array($smeta)): foreach($smeta as $key=>$vo): ?><img src="<?php echo sp_get_asset_upload_path($vo['url']);?>" class="img-thumbnail img-responsive"  />
                            <p><?php echo ($vo["alt"]); ?></p><?php endforeach; endif; ?>
               
               </div>
               </div>
                
                <!---------------------------附近小区房源信息---------------------------->
                <h3><span class="caret"></span><?php echo ($xqname); ?>附近租房</h3>               
               <div class="panel panel-default">
               <div class="panel-body">
               
               <ul class="unstyled list-inline">
               <?php if(is_array($fujin)): foreach($fujin as $key=>$vo): ?><li>
                        <a href="/fang/zufang/<?php echo ($serveritem); ?>-<?php echo ($areaid); ?>-0-0-0-0-<?php echo ($vo["id"]); ?>-0.html" title="查看<?php echo ($vo["name"]); ?>房源信息"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; ?>
               </ul>
               
               </div>
               </div>
               
               
                
                </div>
               
		    <div class="clearfix"></div>
                
		    	<div class="col-md-12">
                    <div class="panel panel-default" style="padding: 15px;">
                           <?php if(!empty($prev)): ?><a href="<?php echo leuu('info',array('eid'=>$prev['eid']));?>" class="btn btn-primary pull-left" style="top: 50%;position: relative;">上一位</a><?php endif; ?>
					<?php if(!empty($next)): ?><a href="<?php echo leuu('info',array('eid'=>$next['eid']));?>" class="btn btn-warning pull-right">下一位</a><?php endif; ?>
    	            <script type="text/javascript" src="/fang/tpl/simplebootx/Public/js/qrcode.min.js"></script>
                    <div id="qrcode" style="width: 100px;margin:0 auto"></div>
    					<script type="text/javascript">
                        var qrcode = new QRCode(document.getElementById("qrcode"), {
                        width : 100,
                        height : 100
                        });
                        function makeCode () {		
                        qrcode.makeCode("http://<?php echo ($_SERVER['HTTP_HOST']); echo ($_SERVER['REQUEST_URI']); ?>");
                        }
                        makeCode();
                        </script>     
                    
                    </div>
					
					<div class="clearfix"></div>
                    
				</div>
               
               
		    	
	    </div>
	    
   
			
		    
		</div>		
		
	</div>
 </div>             

<!-- Footer================================================== -->

<?php echo hook('footer');?>
      <div id="footer">
      <div class="container text-center">
            
            
            
                <div class="links">
        <?php $links=sp_getlinks(); ?>
        友情链接：
        <?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="<?php echo ($vo["link_target"]); ?>"><?php echo ($vo["link_name"]); ?></a><?php endforeach; endif; ?>
        </div>
        <p>
        
        
        永川租房上永川租房网，永川住房出租，永川商铺门市出租，永川写字楼厂房出租。一家专注永川房屋出租的网站！<br />
        永川租房网站由 <a href="http://www.jiazhengyc.com" rel="nofollow" target="_blank">永川家政网</a> 精心制作优化.<br />
        版权所有 <a href="#">永川租房网</a><br />
        </p>
            
            
      
      </div>
        
        
      </div>
      <div id="backtotop"><i class="fa fa-arrow-circle-up"></i></div>
      <?php echo ($site_tongji); ?>





<!-----------------------模态框--------------------------->
<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo ($term['name']); ?>服务预约</h4>
      </div>
      <div class="modal-body">
        <form class="J_ajaxForm" action="<?php echo leuu('jiazheng/order/addorder');?>" method="post">
          <div class="form-group">
            <label for="cname" class="control-label">联系人名称</label>            
            <input type="text" class="form-control" required id="cname" name="cname" />
            
          </div>
          <div class="form-group">
            <label for="address" class="control-label">家庭住址</label>
            
            <input type="text" class="form-control" required id="address" name="address" />
           
          </div>
          <div class="form-group">
            <label for="phone" class="control-label">联系电话</label>
            
            <input type="text" class="form-control" required id="phone" name="phone" />
            
          </div>         
            <?php $curdate=date("Y-m-d H:i",time()); ?>
            
          <div class="form-group">
                <label class="control-label">上门时间</label>
                
                <div class="input-append date form_datetime" data-date="<?php echo ($curdate); ?>" data-date-format="yyyy-mm-dd HH:ii" data-link-field="dtp_input1">
                    <input class="form-control" type="text" value="<?php echo ($curdate); ?>" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
                </div>
                
				<input type="hidden" id="dtp_input1" name="startdate" value="" /><br/>
            </div>
          <div class="form-group">
            <label for="remark" class="control-label">其它说明</label>
            <div class="controls">
            <textarea class="form-control" id="remark" name="remark"></textarea>
            </div>
          </div>
          <input type="hidden" name="item" value="<?php echo ($termid); ?>"/>
          <input type="hidden" name="ename" value="<?php echo ($ename); ?>"/>
          <input type="hidden" name="userid" value="<?php echo get_current_userid();?>"/>
          <input type="hidden" name="eid" value="<?php echo ($eid); ?>"/>
          <div class="form-group">          
                <button class="btn btn-primary J_ajax_submit_btn btn-success" type="submit">提交预订</button>
                
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!----------------------------------------->

<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/fang/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/fang/statics/js/jquery-1.11.3.min.js"></script>
    <script src="/fang/statics/js/wind.js"></script>
    <script src="/fang/statics/simpleboot/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/fang/statics/js/frontend.js"></script>
    
	<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login');?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/fang/data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.user.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.user.offline").show();
			}
			
		});	        

		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>


 <script src="/fang/statics/js/bootstrap-datetimepicker.min.js"></script>
  <script src="/fang/statics/js/bootstrap-datetimepicker.zh-CN.js"></script>
  <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  'linked',
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	
</script>
 
</body>
</html>