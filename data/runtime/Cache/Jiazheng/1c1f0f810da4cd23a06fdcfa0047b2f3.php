<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<?php $title=gentitle(); ?>
	<title><?php echo ($title); ?>_第<?php echo I('get.p',1);?>页_<?php echo ($site_name); ?></title>
	<meta name="keywords" content="<?php echo ($title); ?>" />
	<meta name="description" content="<?php echo ($title); ?>" />
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
<section id="social-buttons">
<div class="container">
    <div class="row">
    
    <div class="col-md-12">
    <ol class="breadcrumb">
    
  <li><i class="fa fa-home fa-lg" style="font-size: 18px;line-height:16px;"></i><a href="/">永川租房网</a></li>
  
 <?php if(is_array($path)): $i = 0; $__LIST__ = $path;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($m["url"]); ?>"><?php echo ($m["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ol>    
    
    </div>
    </div>
</div>
</section>
<div class="container">
 <?php $housefield=C('housefield'); $housefield=$housefield[$cat_id]; $housetype=C('housetype'); $housetype=$housetype[$housefield]; $leibie=C('leibie'); $leibie=$leibie[$housefield]; $caoxiang=C('caoxiang'); $serveritemarr=C('serveritem'); $pricetypearr=C('pricetype'); $officegradearr=C('officegrade'); ?>  	
	
    
    
    <div class="row" >
		<div class="col-md-9">
		      <div class="row">
              <div class="col-md-12">
              <div class="panel panel-default" style="padding: 15px;">
              
              <h3>永川租房条件筛选</h3>      
              
              </dl>
              <!----------------------------区域--1-------------------------------->     
              <dl class="dl-horizontal keynav">
              <dt class="badge">租房区域</dt>
              <dd>
              <?php if(checkme(1,0)): ?><a href="<?php echo genparam(1,0);?>" class="bg-primary">不限</a><?php else: ?><a href="<?php echo genparam(1,0);?>" class="bg-info">不限</a><?php endif; ?>          
                           
              <?php $_result=getcity('0');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(1,$s['pinyin'])): ?><a href="<?php echo genparam(1,$s['pinyin']);?>" class="bg-primary"><?php echo ($s["shortname"]); ?></a>
              <?php else: ?>
              <a href="<?php echo genparam(1,$s['pinyin']);?>"><?php echo ($s["shortname"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>  
              </dd>           
              </dl>    
              <!----------------------------方式--5--------------------------------> 
          
               <dl class="dl-horizontal keynav">
              <dt class="badge">租房方式</dt>
              <dd>
              <?php if(checkme(5,0)): ?><a href="<?php echo genparam(5,0);?>" class="bg-primary">不限</a><?php else: ?><a href="<?php echo genparam(5,0);?>" class="bg-info">不限</a><?php endif; ?>           
                            
              <?php if(is_array($leibie)): $i = 0; $__LIST__ = $leibie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(5,$key)): ?><a href="<?php echo genparam(5,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
              <?php else: ?>
              <a href="<?php echo genparam(5,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>   
              </dd>          
              </dl> 
          
          <!----------------------------户型--2--------------------------------> 
          <?php if(checkme(0,1)): ?><!-----------整租户型------------>
             <?php if(checkme(5,2)){ ?>
             
             
                    <dl class="dl-horizontal keynav">
                  <dt class="badge">合租房型</dt>
                  <dd>
                  <?php if(checkme(2,0)): ?><a href="<?php echo genparam(2,0);?>" class="bg-primary">不限</a>
                  <?php else: ?><a href="<?php echo genparam(2,0);?>">不限</a><?php endif; ?>              
                              
                  <?php $_result=C('hzhx');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(2,$key)): ?><a href="<?php echo genparam(2,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
                  <?php else: ?>
                  <a href="<?php echo genparam(2,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>   
                  </dd>          
                  </dl>
             <?php } else{ ?>
             
                  
                <dl class="dl-horizontal keynav">
                  <dt class="badge">租房户型</dt>
                  <dd>
                  <?php if(checkme(2,0)): ?><a href="<?php echo genparam(2,0);?>" class="bg-primary">不限</a>
                  <?php else: ?>
                  <a href="<?php echo genparam(2,0);?>">不限</a><?php endif; ?>              
                              
                  <?php $_result=C('hx');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(2,$key)): ?><a href="<?php echo genparam(2,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
                  <?php else: ?>
                  <a href="<?php echo genparam(2,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>   
                  </dd>          
                  </dl>
               <?php } endif; ?>    
              
              
              <!----------------------------租金--3-------------------------------->     
              <dl class="dl-horizontal keynav">
              <dt class="badge">出租租金</dt>
              <dd>
              <?php if(checkme(3,0)): ?><a href="<?php echo genparam(3,0);?>" class="bg-primary">不限</a><?php else: ?><a href="<?php echo genparam(3,0);?>">不限</a><?php endif; ?>          
                       
              <?php $_result=C('zujin');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(3,$key)): ?><a href="<?php echo genparam(3,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
              <?php else: ?>
              <a href="<?php echo genparam(3,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
              </dd>            
              </dl>
              <!----------------------------商铺行业--3-------------------------------->     
              <?php if(checkme(0,3)){ ?>
                <dl class="dl-horizontal keynav">
              <dt class="badge">房屋行业</dt>
              <dd>
              <?php if(checkme(7,0)): ?><a href="<?php echo genparam(7,0);?>" class="bg-primary">不限</a><?php else: ?><a href="<?php echo genparam(7,0);?>">不限</a><?php endif; ?>          
                       
              <?php $_result=C('shopfor');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(7,$key)): ?><a href="<?php echo genparam(7,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
              <?php else: ?>
              <a href="<?php echo genparam(7,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
              </dd>            
              </dl>
                <?php } ?>
        <!----------------------------房源类型--4--------------------------------> 
         
               <dl class="dl-horizontal keynav">
              <dt class="badge">房源类型</dt>
             <dd>
              <?php if(checkme(4,0)): ?><a href="<?php echo genparam(4,0);?>" class="bg-primary">不限</a><?php else: ?><a href="<?php echo genparam(4,0);?>">不限</a><?php endif; ?>     
                           
              <?php if(is_array($housetype)): $i = 0; $__LIST__ = $housetype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if(checkme(4,$key)): ?><a href="<?php echo genparam(4,$key);?>" class="bg-primary"><?php echo ($s); ?></a>
              <?php else: ?>
              <a href="<?php echo genparam(4,$key);?>"><?php echo ($s); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>  
              </dd>           
              </dl>      
                    
             
          
              
    </div>          
              </div>
              
              </div>
              
              <?php $where=genwhere(); $lists = sp_jz("serveritem:$cat_id;order:update_time desc,eid desc;",$where,9); $empty='<p class="text-warning"><i class="glyphicon glyphicon-exclamation-sign"></i>暂无满足条件的租房数据</p>'; function strtostr($config_name,$input_name){ $c=C($config_name); $mye=explode(',',$input_name); $str=array(); foreach($mye as $v) { $str[]=$c["$v"]; } echo implode(",",$str); } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                            <?php if(is_array($lists['posts'])): $i = 0; $__LIST__ = $lists['posts'];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; switch($vo['serveritem']){ case '1': ?>
                               <div class="row">
                                      <div class="col-md-3">
                                      <?php if(empty($vo['photo'])): ?><img src="/fang/statics/images/personnoimg.jpg" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" />
                                      <?php else: ?>
                                      <img data-src="<?php echo ($vo["photo"]); ?>" src="<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" /><?php endif; ?>
                                      </div>
                                      <div class="col-md-7"> 
                                      <h3><a href="<?php echo leuu('chuzu',array('eid'=>$vo['eid']));?>"><?php echo ($vo["title"]); ?></a></h3>
                                       <ul class="list-inline " style="font-size: 18px;font-weight: bold;">                                        
                                        
                                        
                                        <?php if($vo['leibie']==='2'){ ?>
                                        <li><?php echo ($leibie[$vo['leibie']]); echo ($vo["hzhx"]); ?></li>
                                        <li><?php echo ($vo["hzcount"]); ?>户合租</li>
                                        <?php }else{ ?>
                                        <li>
                                        <?php echo ($leibie[$vo['leibie']]); ?>
                                        </li>
                                        <li><?php echo ($vo["hxs"]); ?>室<?php echo ($vo["hxt"]); ?>厅</li>
                                        <?php } ?>
                                                                                
                                        
                                        <li><?php echo ($vo["mj"]); ?>㎡</li>
                                        <li><?php echo ($vo["lc"]); ?>/<?php echo ($vo["lcall"]); ?>层</li>
                                        <li>朝<?php echo ($caoxiang[$vo['caoxiang']]); ?></li>                                        
                                        </ul> 
                                        <p class="small"><?php echo ($vo["xqname"]); ?></p> 
                                        <p class="small"><?php echo (formatDate($vo['update_time'])); ?>更新</p>                            
                                      
                                    </div>
                                    <div class="col-md-2 text-right" style="margin-top: 40px;">
                                    <span style="font-size: 2em;color:red;"><?php echo ($vo["zj"]); ?></span>元/月
                                    </div>
                                     </div> 
                                     <hr />
                            <?php break; case '2': ?>
                                <div class="row">
                                      <div class="col-md-3">
                                      <?php if(empty($vo['photo'])): ?><img src="/fang/statics/images/personnoimg.jpg" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" />
                                      <?php else: ?>
                                      <img data-src="<?php echo ($vo["photo"]); ?>" src="<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" /><?php endif; ?>
                                      </div>
                                      <div class="col-md-7"> 
                                      <h3><a href="<?php echo leuu('chuzu',array('eid'=>$vo['eid']));?>"><?php echo ($vo["title"]); ?></a></h3>
                                      <p><?php echo ($vo["xqname"]); ?><i class="glyphicon glyphicon-map-marker" style="margin-left: 5px;"></i><?php echo ($vo["address"]); ?></p>
                                      <p>等级：<?php echo ($officegradearr[$vo['officegrade']]); ?>/所在楼层：<?php echo ($vo["lc"]); ?>/<?php echo ($vo["lcall"]); ?>层</p>
                                       <ul class="list-inline " style="font-size: 18px;font-weight: bold;"> 
                                        <li><?php echo ($vo["mj"]); ?>㎡(建筑面积)</li>
                                        
                                                                               
                                        </ul> 
                                        
                                        <p class="small"><?php echo (formatDate($vo['update_time'])); ?>更新</p>                            
                                      
                                    </div>
                                    <div class="col-md-2 text-right" style="margin-top: 40px;">
                                    <p><span style="font-size: 2em;color:red;"><?php echo ($vo["zj"]); ?></span><?php echo ($pricetypearr[$vo['pricetype']]); ?></p>
                                    <p>
                                    <?php $jiage=''; switch($vo['pricetype']){ case '1': $jiage= $vo['zj']*$vo['mj']*30; echo $jiage.'元/月'; break; case '2': $jiage= $vo['zj']*$vo['mj']; echo $jiage.'元/月'; } ?>
                                    
                                    </p>
                                    </div>
                                     </div> 
                                     <hr />                                
                           <?php break; case '3': ?>
                                <div class="row">
                                      <div class="col-md-3">
                                      <?php if(empty($vo['photo'])): ?><img src="/fang/statics/images/personnoimg.jpg" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" />
                                      <?php else: ?>
                                      <img data-src="<?php echo ($vo["photo"]); ?>" src="<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["title"]); ?>" class="img-rounded img-responsive" style="margin: 10px auto;" /><?php endif; ?>
                                      </div>
                                      <div class="col-md-7"> 
                                      <h3><a href="<?php echo leuu('chuzu',array('eid'=>$vo['eid']));?>"><?php echo ($vo["title"]); ?></a></h3>
                                      <p><?php echo ($vo["xqname"]); ?><i class="glyphicon glyphicon-map-marker" style="margin-left: 5px;"></i><?php echo ($vo["address"]); ?></p>
                                      <p>类型：<?php echo ($housetype[$vo['housetype']]); ?>/所在楼层：<?php echo ($vo["lc"]); ?>/<?php echo ($vo["lcall"]); ?>层</p>
                                       <ul class="list-inline " style="font-size: 18px;font-weight: bold;"> 
                                        <li><?php echo ($vo["mj"]); ?>㎡(建筑面积)</li>
                                        
                                                                               
                                        </ul> 
                                        
                                        <p class="small"><?php echo (formatDate($vo['update_time'])); ?>更新</p>                            
                                      
                                    </div>
                                    <div class="col-md-2 text-right" style="margin-top: 40px;">
                                    <p><span style="font-size: 2em;color:red;"><?php echo ($vo["zj"]); ?></span><?php echo ($pricetypearr[$vo['pricetype']]); ?></p>
                                    <p>
                                    <?php $jiage=''; switch($vo['pricetype']){ case '1': $jiage= $vo['zj']*$vo['mj']*30; echo $jiage.'元/月'; break; case '2': $jiage= $vo['zj']*$vo['mj']; echo $jiage.'元/月'; } ?>
                                    
                                    </p>
                                    </div>
                                     </div> 
                                     <hr />                                
                           
                           <?php } endforeach; endif; else: echo "$empty" ;endif; ?>
                            </div></div>
                    </div>
                </div>
                
               
              
					
			<div class="clearfix"></div>	
			
			<nav>
				<ul class="pagination">
					<?php echo ($lists['page']); ?>
				</ul>
			</nav>
		</div>
		<div class="col-md-3">
        <a href="<?php echo UU('jiazheng/index/postzufang');?>" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>免费发布租房信息</a>
			<div class="tc-box first-box"> 
	        		<h4>热门文章</h4>
	        	
	        	
                 <ul class="list-unstyled">
                 <li><a href="#">如何找到发布租房信息</a></li>
                 
                 </ul>
	        		<?php $hot_articles=sp_sql_jz("cid:$portal_index_lastnews;field:ename,resume,eid,smeta;order:hits desc;limit:5;"); ?>
		        	<ul class="unstyled">
		        		<?php if(is_array($hot_articles)): foreach($hot_articles as $key=>$vo): $top=$key<3?"top3":""; ?>
							<li class="<?php echo ($top); ?>"><i><?php echo ($key+1); ?></i><a title="<?php echo ($vo["ename"]); ?>" href="<?php echo leuu('article/index',array('id'=>$vo['eid']));?>"><?php echo ($vo["ename"]); ?></a></li><?php endforeach; endif; ?>
					</ul>
				
			</div>		
			<?php $ad=sp_getad("portal_list_right_aside"); ?>
			<?php if(!empty($ad)): ?><div class="tc-box">
	        	<div class="headtitle">
	        		<h4>赞助商</h4>
	        	</div>
	        	<div>
		        	<?php echo ($ad); ?>
		        </div>
			</div><?php endif; ?>
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

    
<!-- JavaScript -->
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


</body>
</html>