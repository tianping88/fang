<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<html>
	<head>
		<title><?php echo ($site_seo_title); ?> <?php echo ($site_name); ?></title>
		<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
		<meta name="description" content="<?php echo ($site_seo_description); ?>" />        
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
<div class="jumbotron">
  <div class="container">
  <div class="row">
  <div class="col-md-8">
     <h1><i class="fa fa-lightbulb-o"></i>&nbsp; 永川租房网！</h1>
    <p>如果你是房东在永川租房网你可以免费发布住房，门面商铺，写字楼，厂房的租房信息</p>
   <p>如果你是租房房客，在永川租房网也能找到你称心中意的房源信息,整租合租，应有尽有，合租还有主卧合租，床位合租，单间合租哦。</p>
   <p>我是房东，马上<a class="btn btn-success" href="<?php echo UU('jiazheng/index/postzufang');?>">发布租房信息</a></p>
  </div>
  <div class="col-md-4">
  
  <h2>永川租房电话及联系方式</h2>
  <p style="font-size: 30px;"><i class="fa fa-phone"></i>:134-5204-8245</p>
  <p style="font-size: 30px;">
  <i class="fa fa-qq"></i>:497731598
  </p>
  <p style="font-size: 30px;"><i class="fa fa-weixin"></i>:qx63com</p>
  
  </div>
  </div>
   
  </div>
</div>
<div class="container">
	
	
		<h2 class="text-center" style="margin: 50px 0;">我们的服务</h2>
		
	
	<div class="row">
        
        <div class="col-md-8 col-md-offset-2">
                                    <div class="row">
                                            <div class="col-md-4">
                                            <img src="/fang/tpl/simplebootx/Public/images/1.jpg" class="img-responsive img-thumbnail" alt="永川保姆" />
                                            <a href="zufang/1-0-0-0-0-1-0-0.html" class="title">永川住房出租</a>
                                            
                                            </div>
                                            <div class="col-md-4">
                                            <img src="/fang/tpl/simplebootx/Public/images/2.jpg" class="img-responsive img-thumbnail" alt="永川月嫂" />
                                            <a href="zufang/3-0-0-0-0-0-0-0.html" class="title">永川门市出租</a>
                                            
                                            </div>
                                            <div class="col-md-4">
                                            <img src="/fang/tpl/simplebootx/Public/images/3.jpg" class="img-responsive img-thumbnail" alt="家庭保洁" />
                                            <a href="zufang/2-0-0-0-0-0-0-0.html" class="title">永川写字楼出租</a>
                                            
                                            </div>
                                    </div>
        </div>
        
    <div class="clearfix"></div>
   
    
		
			 
             <?php $xueli=C('leibie'); $gongzi=C('zujin'); $housetype=C('housetype'); $zhuangxiu=C('zhuangxiu'); $where['serveritem']=1; $house=sp_sql_jz("field:*;order:update_time desc;limit:5;",$where); $where['serveritem']=2; $office=sp_sql_jz("field:*;order:update_time desc;limit:5;",$where); $where['serveritem']=3; $shop=sp_sql_jz("field:*;order:update_time desc;limit:5;",$where); ?>
    <h2 class="text-center" style="margin: 50px 0;">住房出租信息</h2>
    <div class="col-md-12 employee" > 
            
                     <?php if(is_array($house)): $i = 0; $__LIST__ = $house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><div class="row">
                            <div class="col-md-4"><a href="<?php echo leuu('jiazheng/index/info',array('eid'=>$b['eid']));?>"><?php echo ($b["title"]); ?></a></div>
                            <div class="col-md-2"><?php echo ($housetype['house'][$b['housetype']]); ?>【<?php echo ($xueli['house'][$b['leibie']]); ?>】</div>
                            <div class="col-md-2">
                            <?php if($b["leibie"] == 2): echo ($b["hzhx"]); echo ($b["hzcount"]); ?>人合租
                            <?php else: ?>
                            <?php echo ($b["hxs"]); ?>室<?php echo ($b["hxt"]); ?>厅<?php endif; ?>
                            
                            
                            </div>
                            <div class="col-md-2"><?php echo ($b["mj"]); ?>㎡</div>
                            <div class="col-md-2"><?php echo ($b["zj"]); ?></span>元/月</div>
                         </div><?php endforeach; endif; else: echo "" ;endif; ?>
             
    </div>
    <h2 class="text-center" style="margin: 50px 0;">写字楼出租</h2>
    <div class="col-md-12 employee" > 
            
                     <?php if(is_array($office)): $i = 0; $__LIST__ = $office;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><div class="row">
                            <div class="col-md-4"><a href="<?php echo leuu('jiazheng/index/info',array('eid'=>$b['eid']));?>"><?php echo ($b["title"]); ?></a></div>
                            <div class="col-md-2"><?php echo ($housetype['office'][$b['housetype']]); ?>【<?php echo ($xueli['office'][$b['leibie']]); ?>】</div>
                            <div class="col-md-2"><?php echo ($zhuangxiu[$b['zhuangxiu']]); ?></div>
                            <div class="col-md-2"><?php echo ($b["mj"]); ?>㎡</div>
                            <div class="col-md-2"><?php echo ($b["zj"]); ?></span>元/月</div>
                         </div><?php endforeach; endif; else: echo "" ;endif; ?>
             
    </div>
    <h2 class="text-center" style="margin: 50px 0;">商铺门面出租</h2>
    <div class="col-md-12 employee" > 
            
                     <?php if(is_array($shop)): $i = 0; $__LIST__ = $shop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><div class="row">
                            <div class="col-md-4"><a href="<?php echo leuu('jiazheng/index/info',array('eid'=>$b['eid']));?>"><?php echo ($b["title"]); ?></a></div>
                            <div class="col-md-2"><?php echo ($housetype['shop'][$b['housetype']]); ?>【<?php echo ($xueli['shop'][$b['leibie']]); ?>】</div>
                            <div class="col-md-2"><?php echo ($zhuangxiu[$b['zhuangxiu']]); ?></div>
                            <div class="col-md-2"><?php echo ($b["mj"]); ?>㎡</div>
                            <div class="col-md-2"><?php echo ($b["zj"]); ?></span>元/月</div>
                         </div><?php endforeach; endif; else: echo "" ;endif; ?>
             
    </div>         
             
</div>	
		
</div>
<section id="baomuask">
<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h3 class="text-center"><span>永川租房问答</span></h3>
        <ul class="list-unstyled">
        <li> <a href="#" target="_blank">如何找到优质的房源？</a></li>
        <li><a href="#" target="_blank">房东老板出租房屋应注意些什么？</a> </li>
        <li><a href="#" target="_blank">永川租房价格</a></li>
        <li><a href="#" target="_blank">租房保证金该如何收取</a></li>
        
        </ul>
                                                                
                                                                 
                                                                
                                                                
                            
    </div>
    <div class="col-md-6">
        <h3 class="text-center"><span>永川租房动态</span></h3>
        <ul class="list-unstyled">
        <li> <a href="#" target="_blank">一季度永川租房动态</a></li>
        <li><a href="#" target="_blank">永川流动人口大，租房未来趋势</a> </li>
        <li><a href="#" target="_blank">如何管理好自己的房屋信息</a></li>
        <li><a href="#" target="_blank">怎样充分利用自己的房源，达到回收最大化</a></li>
        
        </ul>
    </div>
    </div>
    <?php $lastnews=sp_sql_jz("cid:$portal_index_lastnews;field:*;order:listorder asc;limit:4;"); ?>
	<div class="row">
		<?php if(is_array($lastnews)): foreach($lastnews as $key=>$vo): $smeta=json_decode($vo['smeta'],true); ?>
		<div class="col-md-3">
			<div class="tc-gridbox">
				<div class="header">
					<div class="item-image">
						<a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>">
							<?php if(empty($smeta['thumb'])): ?><img src="/fang/tpl/simplebootx/Public/images/default_tupian1.png" class="img-responsive" alt="<?php echo ($vo["post_title"]); ?>"/>
							<?php else: ?> 
								<img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" class="img-responsive img-thumbnail" alt="<?php echo ($vo["post_title"]); ?>" /><?php endif; ?>
						</a>
					</div>
					<h3><a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo ($vo["post_title"]); ?></a></h3>
					<hr>
				</div>
				<div class="body">
					<p><a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo msubstr($vo['post_excerpt'],0,32);?></a></p>
				</div>
			</div>
		</div><?php endforeach; endif; ?>
	</div>
</div>

</section>
	
	



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


<?php echo hook('footer_end');?>
</body>
</html>