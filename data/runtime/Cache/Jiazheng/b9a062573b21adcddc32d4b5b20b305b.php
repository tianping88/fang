<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>永川租房信息发布_<?php echo ($site_name); ?></title>
	<meta name="keywords" content="永川租房" />
	<meta name="description" content="永川租房信息发布为你免费提供住房出租，写字楼出租，商铺门面出租信息发布。" />
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
    <link href="/fang/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/fang/statics/js/autocomplete/jquery-ui.min.css" rel="stylesheet" />
    
   <script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/fang/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>

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
  <div class="col-md-12">
     <h1><i class="fa fa-lightbulb-o"></i>&nbsp; 免费发布出租信息</h1>
    <p>永川便捷出租信息发布系统正式上线 ，坐在家里也能轻松管理自己的租房信息，房屋出租再也不难了。</p>
  </div>
  </div>
   
  </div>
</div>
<section id="social-buttons">
<div class="container">
    <div class="row">
    
    <div class="col-md-12" style="margin-top: 20px;">
    <ol class="breadcrumb">
    
  <li><i class="fa fa-home fa-lg" style="font-size: 18px;line-height:16px;"></i><a href="/fang">永川租房网</a></li>
  
                <li><a href="fabu.html">永川房源发布</a></li>
              
</ol>    
    
    </div>
    </div>
</div>
</section>
<div class="container">
	
	
    
    
    <div class="row" >
		<div class="col-md-9"><!--==================左侧====================-->
		      <div class="row">
                      <div class="col-md-12">
                          <div class="panel panel-default" style="padding: 15px;">
                          <h1 class="text-center">永川租房信息免费发布</h1>
                             <form name="myform" id="myform" action="<?php echo u('add_post');?>" method="post" class="form-horizontal J_ajaxForms" enctype="multipart/form-data">
 
    
   <?php if($admin[user_type] == 1): ?><div class="form-group">
    <label class="control-label col-md-4 text-left">状态:</label>
    <div class="col-md-12">
    <label class="radio-inline">
      <input type="radio" name="post[status]" value="1" checked />审核通过      
    </label>
    <label class="radio-inline">
      
      <input type="radio" name="post[status]" value="0" />待审核
    </label>
    </div>
    <div class="col-md-12">
    <label class="radio-inline"><input type="radio" name="post[istop]" value="1" ><span>置顶</span></label>
			<label class="radio-inline"><input type="radio" name="post[istop]" value="0" checked><span>未置顶</span></label>
    </div>
    <div class="col-md-12">
    <label class="radio-inline"><input type="radio" name="post[recommended]" value="1" ><span>推荐</span></label>
			<label class="radio-inline"><input type="radio" name="post[recommended]" value="0" checked><span>未推荐</span></label>
    </div>
   </div><?php endif; ?>
     

        
    <!--房源类型-->
    
    <div class="form-group">
        <label class="control-label col-md-2">房源类型：</label>
        <div class="col-md-10">
            <?php $_result=C('serveritem');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="housetype<?php echo ($key); ?>" onclick="changeselect(<?php echo ($key); ?>);" type="radio" name="post[serveritem]" title="<?php echo ($vo); ?>" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
      
       
        
        <!-- 小区名称-->
        <div class="form-group" id="tbyproj">
            <label class="control-label col-md-2">区域：</label>
            <div class="col-md-2">
                <select class="form-control" name="post[areaid]" id="distid">
              
                <?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
            <label class="control-label col-md-2">小区名称：</label>
            <div class="col-md-3">
                <input type="text" id="xqname" name="post[xqname]"  value="" class="form-control input_hd J_title_color" placeholder="请输入小区名称" onkeyup="strlen_verify(this, 'title_len', 20)" />
                <input id="xqid" type="hidden" name="post[xqid]" value="" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">地址：</label>
            <div class="col-md-5">
            <input type='text' id="address" name='post[address]'  required value='' class='form-control' placeholder='详细地址' />
            </div>
        </div>  
        
        <div id="tbcontent"></div>
        
        <div class="form-group">
            <label class="control-label col-md-2">房源标题：<span class="must_red">*</span></label>
            <div class="col-md-10">
                <input type='text' id="title" name='post[title]'  required value='' class='form-control' placeholder='房源标题' />
                <span class="help-block">已自动生成，可自行更改</span>
            </div>
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">房源描述：<span class="must_red">*</span></label>
            <div class="col-md-10">
                <div id='content_tip'></div>
              <script type="text/plain" id="content" name="post[resume]"></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/fang/statics/js/ueditor/ueditor.frontend.config.js"></script>
                <script type="text/javascript"  src="/fang/statics/js/ueditor/ueditor.all.min.js"></script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">上传照片<span class="must_red">*</span></label>
            <div class="col-md-10">
                <fieldset class="blue pad-10">
		        <legend>图片列表</legend>
		        <ul id="photos" class="picList unstyled"></ul>
				</fieldset>
				<a href="javascript:;" style="margin: 5px 0;" onclick="javascript:flashupload('albums_images', '图片上传','photos',change_images,'10,gif|jpg|jpeg|png|bmp,0','swfupload','','')" class="btn">选择图片 </a>
			  
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="control-label col-md-2">缩略图</label>
            <div class="col-md-10"><input type='hidden' name='post[photo]' id='thumb' value=''>
    			<a href='javascript:void(0);' onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','uploadimg','','');return false;">
    			<img src='/fang/statics/images/icon/upload-pic.png' id='thumb_preview' width='135' height='113' style='cursor:hand' /></a>
    			<!-- <input type="button" class="btn" onclick="crop_cut_thumb($('#thumb').val());return false;" value="裁减图片">  -->
                <input type="button"  class="btn" onclick="$('#thumb_preview').attr('src','/fang/statics/images/icon/upload-pic.png');$('#thumb').val('');return false;" value="取消图片">
                </div>
       </div>
       
       
        <div class="form-group">
            <label class="control-label col-md-2">入住时间<span class="must_red">*</span></label>
            <div class="col-md-10">
                <input type="text" name="post[ruzhudate]" id="updatetime" size="21" class="form-control input-small J_datetime" ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">姓名<span class="must_red">*</span></label>
            <div class="col-md-10">
                <input type="text" name="post[ename]" required value="" class="form-control" placeholder="尊姓大名"  />
              	
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">联系电话<span class="must_red">*</span></label>
            <div class="col-md-5">
                <input type='text' name='post[ephone]' id='ephone' required value=''  class='form-control' placeholder='请输入手机号'>
            </div>
            
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">验证码<span class="must_red">*</span></label>
            <div class="col-md-5">
                <input type='text' name='post[verify]' required value=''  class='form-control' placeholder='请输入验证码'>
            </div>
            <div class="col-md-5">
                
                <button id="sendvalidate" class="form-control btn btn-success" >免费获取验证码</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                
                <input type="hidden" name="post[termid]" value="1" />
                <button class="btn btn-success btn_submit J_ajax_submit_btn" type="submit">提交</button>
                <a class="btn" href="<?php echo U('AdminEmployee/index');?>">返回</a>
            </div>
      </div>
        
 
  
 </form>
 <?php $leibie=C('leibie'); $housetype=C('housetype'); $paytype=C('paytype'); $peitao=C('peitao'); ?>
 <!--====================================住宅别墅基本信息=======================================-->
       <section id="house" style="display: none;">
       
            <!--出租方式-->
            <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-10">
                    <?php if(is_array($leibie['house'])): $i = 0; $__LIST__ = $leibie['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" onclick="hezu(<?php echo ($key); ?>);" id="houseleibie<?php echo ($key); ?>" type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            
         <!--房屋类型-->
         <div class="form-group">
                <label class="control-label col-md-2">房屋类型</label>
                <div class="col-md-10">
                    <select class="form-control"  name="post[housetype]" onchange="housetype_change(this);">
              
                <?php if(is_array($housetype['house'])): $i = 0; $__LIST__ = $housetype['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
                </div>
            </div>
        
            <!--户型-->
           <div class="form-group">
                <label class="control-label col-md-2">户型</label>
                <div id="househx" >
                    <div class="col-md-10" ><!--整租户型-->
                        <div class="input-group">
                                <input type="text"  name="post[hxs]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">室</span>
                                <input type="text"  name="post[hxt]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">厅</span>
                                <input type="text"  name="post[hxw]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">卫</span>
                                </div>
                    </div>
                </div>
            </div> 
            <!--面积-->
            <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-10">
                    <div class="input-group">
                            <input type="text" id="mianji" name="post[mj]" required value=""  class="mianji form-control input_hd J_title_color" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
            
            <!--装修-->
            <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-10">
                    <select class="form-control"  name="post[zhuangxiu]">
              
                <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
            
            <!--  朝向-->
            <div class="form-group">
                <label class="control-label col-md-2">朝向</label>
                <div class="col-md-10">
                    <select class="form-control" name="post[caoxiang]">
              
                <?php $_result=C('caoxiang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
            
            <!-- 楼层-->
            <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-10">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value=""  class="floor form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
            
            <!-- 楼栋号-->
            <div class="form-group">
                <label class="control-label col-md-2">楼栋号</label>
                <div class="col-md-10">
                    <div class="input-group">
                            <input type="text"  name="post[lhh]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">幢/号/层</span>
                            <input type="text"  name="post[lhd]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">单元</span>
                            <input type="text"  name="post[lhs]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">室 (楼栋号不对外显示[只能填写数字])</span>
                            </div>
                </div>
            </div>	
 

            <!--租金-->
            <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-10">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value=""  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">元/月</span>
                            <input type="hidden" value="3" name="post[pricetype]" />
                            <select class="form-control"   name="post[paytype]">
              
                <?php if(is_array($paytype['house'])): $i = 0; $__LIST__ = $paytype['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                            </div>
                </div>
            </div>
            
            <!--配套设施-->
            <div class="form-group">
                <label class="control-label col-md-2">配套设施</label>
                <div class="col-md-10" id="zzpeitao"><!--住宅配套-->
                    <?php if(is_array($peitao['house'])): $i = 0; $__LIST__ = $peitao['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="col-md-8" id="bspeitao" style="display: none;"><!--别墅配套-->
                    <?php if(is_array($peitao['biesu'])): $i = 0; $__LIST__ = $peitao['biesu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">								
							<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>            
          </section> 
 <!--============================================================写字楼基本信息=====================================================-->
 
         <section id="office" style="display: none">
            <!--写字楼出租方式-->
            <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-3">
                    <?php if(is_array($leibie['office'])): $i = 0; $__LIST__ = $leibie['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="officeleibie<?php echo ($key); ?>" type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
         <!--写字楼类型级别-->
         <div class="form-group">
                <label class="control-label col-md-2">类型</label>
                <div class="col-md-6">
                    <div class="input-group">
                    <select class="form-control"  name="post[housetype]">
              
                <?php if(is_array($housetype['office'])): $i = 0; $__LIST__ = $housetype['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
                <span class="input-group-addon">级别</span>
                <select name="post[officegrade]" class="form-control">
              
                <?php $_result=C('officegrade');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                    </div>
                    
                </div>
            </div>
         
         <!--写字楼面积-->
         <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[mj]" required value="" class="mianji form-control input_hd J_title_color" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
         <!-- 写字楼楼层-->
         <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value=""  class="floor form-control input_hd J_title_color"  />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value=""  class="form-control input_hd J_title_color"  />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
         <!-- 写字楼租金-->
         <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-6">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value=""  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">
                            <?php $_result=C('pricetype');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[pricetype]" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                            </span>
                            </div>
                </div>
            </div>
         
         <!--写字楼支付方式-->
         <div class="form-group">
                <label class="control-label col-md-2">支付方式</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[paytype]">
              
                <?php if(is_array($paytype['office'])): $i = 0; $__LIST__ = $paytype['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
         
         <!--写字楼是否包含物业费-->
         <div class="form-group">
                <label class="control-label col-md-2">是否包含物业费</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" type="radio" name="post[officewuye]" checked="checked" />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[officewuye]" />否
							</label>
                </div>
            </div>
         
         <!--写字楼物业费金额-->
         <div class="form-group">
                <label class="control-label col-md-2">物业金额</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text"  name="post[officewuyefei]" required value=""  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">元/平米·月 </span>
                            </div>
                </div>
            </div>
         
         <!--写字楼物业公司-->
         <div class="form-group">
                <label class="control-label col-md-2">物业公司</label>
                <div class="col-md-6">
                    
                            <input type="text"  name="post[officecompany]" required value=""  class="form-control input_hd J_title_color" />
                            
                </div>
            </div>
        
         <!--写字楼是否可分割-->
         <div class="form-group">
                <label class="control-label col-md-2">是否可分割</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" id="officefenge" type="radio" name="post[fenge]"  />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[fenge]" />否
							</label>
                </div>
            </div>
         
         <!--写字楼装修程度-->
         <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[zhuangxiu]">
                  
                    <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    				</select>
                </div>
            </div>
         
         <!-- 写字楼有效期-->
         <div class="form-group">
                <label class="control-label col-md-2">有效期</label>
                <div class="col-md-3">
                    <select class="form-control"   name="post[expiry]">             
                                          
        					<option value="30" selected>30</option>
                            <option value="60">60</option>
                            <option value="7">7</option>
                            <option value="15">15</option>
                            
                        
    				</select>
                </div>
            </div>
         
         </section>
        <!--==============================商品基本信息===============================-->
        <section id="shop" style="display: none">
        <!--商铺类别-->
        <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-3">
                    <?php if(is_array($leibie['shop'])): $i = 0; $__LIST__ = $leibie['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="shopleibie<?php echo ($key); ?>"  type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        <!--商铺类型-->
        <div class="form-group">
                <label class="control-label col-md-2">类型</label>
                <div class="col-md-3">
                    
                    <select class="form-control"  name="post[housetype]">
              
                <?php if(is_array($housetype['shop'])): $i = 0; $__LIST__ = $housetype['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>            
                    
                    
                </div>
            </div>
       
        <!--商铺当前状态-->
        <div class="form-group">
                <label class="control-label col-md-2">当前状态</label>
                <div class="col-md-3">
                    <?php $_result=C('shopstate');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[shopstate]" <?php if($key == 1): ?>checked="checked"<?php endif; ?>><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
       
        <!--商铺可经营类别-->
        <div class="form-group">
                <label class="control-label col-md-2">可经营类别</label>
                <div class="col-md-8">
                    <?php $_result=C('shopfor');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[shopfor][]"><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
         
        <!--商铺房屋配套-->
        <div class="form-group">
                <label class="control-label col-md-2">配套设施</label>
                <div class="col-md-8">
                    <?php if(is_array($peitao['shop'])): $i = 0; $__LIST__ = $peitao['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
       
        <!--商铺出租面积----------------->
        <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[mj]" required value=""  class="mianji form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
         <!--商铺楼层--------------------->
         <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value=""  class="floor form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
         <!--商铺租金--------------------->
         <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-6">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value=""  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">
                            <?php $_result=C('pricetype');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[pricetype]" /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                            </span>
                            </div>
                </div>
            </div>
         <!--商铺支付方式----------------->
         <div class="form-group">
                <label class="control-label col-md-2">支付方式</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[paytype]">
              
                <?php if(is_array($paytype['shop'])): $i = 0; $__LIST__ = $paytype['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
        
        
        
        <!--商铺是否可分割--------------->
        <div class="form-group">
                <label class="control-label col-md-2">是否可分割</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" id="shopfenge" type="radio" name="post[fenge]" />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[fenge]" />否
							</label>
                </div>
            </div>
        <!--商铺装修程度-----------------> 
        <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[zhuangxiu]">
                  
                    <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    				</select>
                </div>
            </div>
        <!--商铺有效期------------------->
        <div class="form-group">
                <label class="control-label col-md-2">有效期</label>
                <div class="col-md-3">
                    <select class="form-control"   name="post[expiry]">             
                                          
        					<option value="30" selected>30</option>
                            <option value="60">60</option>
                            <option value="7">7</option>
                            <option value="15">15</option>
                            
                        
    				</select>
                </div>
            </div>
        </section>
        <!--合租户型-->
        
                    <div class="col-md-5" id="hzhx" style="display: none;">
                        
                        
                                    <div class="input-group">
                                    <select class="form-control"   name="post[hzhx]">
                          
                                    <?php $_result=C('hzhx');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                				</select>
                                <span class="input-group-addon"></span>
                                            <select class="form-control" name="post[hzcount]">             
                                                  
                					<option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                
            				</select>
                            <span class="input-group-addon">户合租</span>
                             <select class="form-control"  name="post[hzlimit]">             
                                                  
                					<option value="性别不限" selected>性别不限</option>
                                    <option value="限男生">限男生</option>
                                    <option value="限女生">限女生</option>
                                    <option value="限夫妻">限夫妻</option>
                                    
                                
            				</select>
                                    </div>
                    
                    </div>
                    
                    
            
           <div class="col-md-5" id="zzhx" style="display: none;"><!--整租户型-->
                    
                        
                            <div class="input-group">
                            <input type="text"  name="post[hxs]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">室</span>
                            <input type="text"  name="post[hxt]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">厅</span>
                            <input type="text"  name="post[hxw]" required value=""  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">卫</span>
                            </div>
                            
                        
                        
                        
                           
                    
                </div>     
        <!--==============================================信息结束=============================================-->
                          
                           </div>          
                      </div>
              
              </div>
       
		
		</div>
		<div class="col-md-3"><!--==================右边栏====================-->
			<div class="tc-box first-box">
			
	        	<div class="headtitle">
                
                    <i class="fa fa-facebook fa-fw"></i><a href="#">房源登记</a>
                
	        		<h4>热门文章</h4>
	        	</div>
	        	<div class="ranking">
                 
	        		<?php ?>
		        	<ul class="unstyled">
		        		<?php if(is_array($hot_articles)): foreach($hot_articles as $key=>$vo): $top=$key<3?"top3":""; ?>
							<li class="<?php echo ($top); ?>"><i><?php echo ($key+1); ?></i><a title="<?php echo ($vo["ename"]); ?>" href="<?php echo leuu('article/index',array('id'=>$vo['eid']));?>"><?php echo ($vo["ename"]); ?></a></li><?php endforeach; endif; ?>
					</ul>
				</div>
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


<script src="/fang/statics/js/wind.js"></script>
<script type="text/javascript" src="/fang/statics/js/common.js"></script>
<script type="text/javascript" src="/fang/statics/js/content_addtop.js?v=20151027"></script>
<script type="text/javascript" src="/fang/statics/js/autocomplete/jquery-ui.min.js"></script>
<script type="text/javascript"> 
$(function () {
	   	
	/////---------------------
	 Wind.use('validate', 'ajaxForm', 'artDialog', function () {
			//javascript
	        
	            //编辑器
	            editorcontent = new baidu.editor.ui.Editor();
	            editorcontent.render( 'content' );
	            try{editorcontent.sync();}catch(err){};
	            //增加编辑器验证规则
	            jQuery.validator.addMethod('editorcontent',function(){
	                try{editorcontent.sync();}catch(err){};
	                return editorcontent.hasContents();
	            });
	            var form = $('form.J_ajaxForms');
    	        //ie处理placeholder提交问题
    	        if (/msie/.test(navigator.userAgent.toLowerCase())) {
    	            form.find('[placeholder]').each(function () {
    	                var input = $(this);
    	                if (input.val() == input.attr('placeholder')) {
    	                    input.val('');
    	                }
    	            });
    	        }
	        //表单验证开始
	        form.validate({
				//是否在获取焦点时验证
				onfocusout:false,
				//是否在敲击键盘时验证
				onkeyup:false,
				//当鼠标掉级时验证
				onclick: false,
	            //验证错误
	            showErrors: function (errorMap, errorArr) {
					//errorMap {'name':'错误信息'}
					//errorArr [{'message':'错误信息',element:({})}]
					try{
						$(errorArr[0].element).focus();
						art.dialog({
							id:'error',
							icon: 'error',
							lock: true,
							fixed: true,
							background:"#CCCCCC",
							opacity:0,
							content: errorArr[0].message,
							cancelVal: '确定',
							cancel: function(){
								$(errorArr[0].element).focus();
							}
						});
					}catch(err){
					}
	            },
	            //验证规则
                rules: {
                    'post[ename]':{required:1},
                    'post[idcard]':{required:1},
                    'post[address]':{required:1},
                    'post[ephone]':{required:1},
                    'post[post_content]':{editorcontent:true}
                    },
	            
	            //验证未通过提示消息
                messages: {
                    'post[ename]':{required:'请输入姓名'},
                    'post[idcard]':{required:'身份证号不能为空'},
                    'post[ephone]':{required:'手机号不能为空'},
                    'post[address]':{required:'家庭住址不能为空'},
                    'post[post_content]':{editorcontent:'内容不能为空'}
                    },
	            
	            //给未通过验证的元素加效果,闪烁等
	            highlight: false,
	            //是否在获取焦点时验证
	            onfocusout: false,
	            //验证通过，提交表单
	            submitHandler: function (forms) {
	                $(forms).ajaxSubmit({
	                    url: form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
	                    dataType: 'json',
	                    beforeSubmit: function (arr, $form, options) {
	                        
	                    },
	                    success: function (data, statusText, xhr, $form) {
	                        if(data.status){
								setCookie("refersh_time",1);
								//添加成功
								Wind.use("artDialog", function () {
								    art.dialog({
								        id: "succeed",
								        icon: "succeed",
								        fixed: true,
								        lock: true,
								        background: "#CCCCCC",
								        opacity: 0,
								        content: data.info,
										button:[
											{
												name: '保存成功！',
												callback:function(){
													reloadPage(window);
													return true;
												},
												focus: true
											}
										]
								    });
								});
							}else{
								isalert(data.info);
							}
	                    }
	                });
	            }
	        });
	    });
	////-------------------------
    
    
});
</script>
<script type="text/javascript">
//房源选择
function changeselect(selectitem){
    //$("input:radio[name='post[leibie]']").attr("checked",false);
    switch(selectitem){
                case 1:
                    section="house";                                                      
                    break;
                case 2:
                    section="office";                                     
                    break;
                case 3:
                    section="shop";
                                       
                    break;
            }
            
                html=$('#'+section).clone(true);//要用克隆才能将绑定的事件一起克隆
                html.css("display","");        
                $('#tbcontent').html(html);
                $("input:radio[id="+section+"leibie1]").eq(0).attr("checked","checked");  //加上eq(0)是因为这些元素是第一个，有多个
                $("input:radio[id="+section+"fenge]").eq(0).attr("checked","checked");//房源是否可分割，商铺或写字楼
                $("input:radio[name='post[pricetype]']").eq(2).attr("checked","checked");
                
}
//合租户型选项
function hezu(selectitem){
    switch(selectitem){
        case 2:
            section="hzhx";
            break;
        default:
            section="zzhx";
    }
    html=$('#'+section).clone(true);
    html.css("display","");
    $('#househx').html(html);
}
//住宅房型改变后配套设施的变化
function housetype_change(obj){
    var selected=$(obj).val();
    if(selected==3){
        $("#bspeitao").css("display","");
        $("#zzpeitao").css("display","none");
        $("#zzpeitao input:checkbox").attr("checked",false);
    }
    else{
        $("#bspeitao").css("display","none");
        $("#zzpeitao").css("display","");
        $("#bspeitao input:checkbox").attr("checked",false);
    }
    
}
function gentitle(dz,mj,lc){
    dz=$("#xqname").val();
    mianji=$(".mianji").val();
    if(mianji>0){
        mianji=mianji+'平米';
    }else{
        mianji="";
    }
     
     housetype=$("input:radio[name='post[serveritem]']:checked").attr("title"); 
     houseleibie=$("input:radio[name='post[leibie]']:checked").attr("title");
     //如果是住宅，需要几室几厅
     houseval= $("input:radio[name='post[serveritem]']:checked").val();
     leibieval=$("input:radio[name='post[leibie]']:checked").val();
     //住宅
     if(houseval=="1"){        
        //整租
        if(leibieval=="1"){
            lc=$("input[name='post[hxs]']").val()+"室"+$("input[name='post[hxt]']").val()+"厅";
        }        
        else{
            lc=$("select[name='post[hzhx]']").val()+$("select[name='post[hzcount]']").val()+"户合租";
        }
        //合租
     }else{
        lc=$(".floor").val()+"F";
     } 
    $("#title").val(dz+housetype+houseleibie+"  "+mianji+"  "+lc);
}
var wait=60;
function time(o) { 

    if (wait == 0) { 
        o.removeAttr("disabled"); 
        o.html("免费获取验证码"); 
        wait = 60; 
    } else { 
    
        o.attr("disabled", true);        
        o.html("重新发送(" + wait + ")"); 
        
        wait--; 
        
        setTimeout(function() { 
        
        time(o) 
        
        }, 
        
        1000) 
        
    } 

} 
//校验手机号码：必须以数字开头，除数字外，可含有“-”
function isMobil(s)
{
    var patrns=/^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/;
    //var patrn=/^[+]{0,1}(/d){1,3}[ ]?([-]?((/d)|[ ]){1,12})+$/;
    if (!patrns.test(s)) return false
    return true
}

$(function(){
    //$("#housetype1").attr("checked",true);
    $("#housetype1").click();//设置默认房源选项
    var xqname="";
    var mianji="";
    var lc="";
    var housetype="";
    var houseleibie="";
    $("#xqname,input[name='post[hxs]'],input[name='post[hxt]']").blur(function(){        
        gentitle();
    });
    $(".mianji,.floor").each(function(){
        $(this).blur(function(){                                           
            gentitle();  
        
        });
    });
    
    $("input:radio[name='post[serveritem]'],input:radio[name='post[leibie]']").each(function(){
        $(this).click(function(){
            gentitle();
        });
    });
    $("select[name='post[hzhx]'],select[name='post[hzcount]']").change(function(){
        gentitle();
    });
    $("#sendvalidate").click(function(){
            if(isMobil($("#ephone").val())){
                
                $.post("<?php echo U("Asset/Sms/send");?>",
                {to:$("#ephone").val()},
                function(data){
                    if(data.status){
                        time($("#sendvalidate"));
                    }else{
                        isalert(data.content);
                    }
                    
                });
        }else{
                isalert("请输入正确的手机号！");
            }
      });
      
    
});
    

</script>
<script>
$(function() {
        var cache = {};
        $("#xqname").autocomplete({
            source: function(request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( $.map( cache[ term ], function( item ) {
                        return {
                            name:item.name,
                            id:item.id,
                            address:item.address,
                            value:item.name
                        }
                    }));
                    return;
                }
                $.ajax({
                    url: "<?php echo U('Asset/Area/search');?>",
                    dataType: "json",
                    data:{
                        xqname: request.term,
                        distid: $("#distid").val()
                        
                    },
                    success: function( data ) {
                        cache[ term ] = data;
                        response( $.map( data, function( item ) {
                            return {
                                name:item.name,
                                id:item.id,
                                address:item.address,
                                value:item.name                             
                            }
                        }));
                        $("#xqid").val("");//需要清除小区ID的值和地址信息
                        $("#address").val("");
                    }
                });
            },
            minLength: 1,
            select: function( event, ui ) {
                $("#xqname").val(ui.item.name);
                $("#xqid").val(ui.item.id);
                $("#address").val(ui.item.address);               
                return false;
            }
            
        })
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<strong>" + item.name + "</strong><small>&nbsp;&nbsp;&nbsp;" + item.address + "</small>" )
            .appendTo( ul );
        };
        
        
        
        
        
        
  });
  </script>
</body>
</html>