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
<style type="text/css">
.col-auto { overflow: auto; _zoom: 1;_float: left;}
.col-right { float: right; width: 210px; overflow: hidden; margin-left: 6px; }
.table th, .table td {vertical-align: middle;}
.picList li{margin-bottom: 5px;}
</style>
<link href="/fang/statics/js/autocomplete/jquery-ui.min.css" rel="stylesheet" />
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <ul class="nav nav-tabs"> 
    <li ><a href="<?php echo I('session.jumpUrledit');?>">房源列表</a></li>    
     <li class="active"><a href="#">修改</a></li>
  </ul>
  <form name="myform" id="myform" action="<?php echo u('AdminEmployee/edit_post');?>" method="post" class="form-horizontal J_ajaxForm" enctype="multipart/form-data">
  
  <!--------------------右侧-------------------------------->
  <div class="col-right">  
   <div class="form-group">
            <label class="control-label col-md-4 text-left">状态:</label>         
          <?php if($admin[user_type] == 1): ?><div class="col-md-12">
            <label class="radio-inline">
              <input type="radio" name="post[status]" value="1" <?php echo ($post['status']==1?"checked":""); ?> />审核通过      
            </label>
            <label class="radio-inline">
              
              <input type="radio" name="post[status]" value="0" <?php echo ($post['status']==0?"checked":""); ?> />待审核
            </label>
            </div>
            <div class="col-md-12">
            <label class="radio-inline"><input type="radio" name="post[istop]" value="1" <?php echo ($post['istop']==1?"checked":""); ?>><span>置顶</span></label>
        	<label class="radio-inline"><input type="radio" name="post[istop]" value="0" <?php echo ($post['istop']==0?"checked":""); ?>><span>未置顶</span></label>
            </div>
            <div class="col-md-12">
            <label class="radio-inline"><input type="radio" name="post[recommended]" value="1" <?php echo ($post['recommended']==1?"checked":""); ?>><span>推荐</span></label>
        	<label class="radio-inline"><input type="radio" name="post[recommended]" value="0" <?php echo ($post['recommended']==0?"checked":""); ?>><span>未推荐</span></label>
            </div>
            <div class="col-md-12">
            管理者ID：<input type="text" style="width:40px;"  name="uid" value="<?php echo ($post["uid"]); ?>" />
            </div>
           
           <?php else: ?>
          
            <div class="col-md-12">
            <?php echo ($post['status']==1?"<span class='text-success'>审核通过</span>":"<span class='text-warning'>未审核</span>"); ?><br />
            <?php echo ($post['istop']==1?"<span class='text-success'>置顶</span>":"<span class='text-warning'>未置顶</span>"); ?><br />
            <?php echo ($post['recommended']==1?"<span class='text-success'>推荐</span>":"<span class='text-warning'>未推荐</span>"); ?>
            </div><?php endif; ?>
          <div class="col-md-12">
            评论：<label class="ib" style="width:88px"><a href="javascript:open_iframe_dialog('<?php echo u('comment/commentadmin/index',array('post_id'=>$post['eid']));?>','评论列表')">查看评论</a></label>
            </div>
   </div> 
  
  
  </div>
  <!--------------------------右侧完------------------------------>
  <!---------------------------左侧开始----------------------------------->
  <div class="col-auto">
      <div class="container">
            <div class="form-group">
                <label class="control-label col-md-2">分类</label>
                <div class="col-md-3"><select class="form-control"  style="max-height: 100px;" name="post[termid]">
        					<?php echo ($taxonomys); ?>
        				</select>
                </div>
            </div>
            <!--房源类型-->
    
    <div class="form-group">
        <label class="control-label col-md-2">房源类型</label>
        <div class="col-md-3">
            <?php $_result=C('serveritem');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="housetype<?php echo ($key); ?>" onclick="changeselect(<?php echo ($key); ?>);" type="radio" name="post[serveritem]" title="<?php echo ($vo); ?>" <?php echo ($post['serveritem']==$key?"checked=checked":""); ?>/><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
      
       
        
        
         <!-- 小区名称-->
        <div class="form-group" id="tbyproj">
            <label class="control-label col-md-2">区域：</label>
            <div class="col-md-2">
                <select class="form-control" name="post[areaid]">
              
                <?php if(is_array($area)): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php echo ($post[areaid]==$vo[id]); ?>?"selected":""><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
            <label class="control-label col-md-2">小区名称：</label>
            <div class="col-md-3">
                <input type="text" id="xqname" name="post[xqname]"  value="<?php echo ($post[xqname]); ?>" class="form-control input_hd J_title_color" placeholder="请输入小区名称" onkeyup="strlen_verify(this, 'title_len', 20)" />
                <input id="xqid" type="hidden" name="post[xqid]" value="<?php echo ($post[xqid]); ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-2">地址：</label>
            <div class="col-md-5">
            <input type='text' id="address" name='post[address]'  required value='<?php echo ($post[address]); ?>' class='form-control' placeholder='详细地址' />
            </div>
        </div>  
         
        
        <div id="tbcontent"></div>
        
        <div class="form-group">
            <label class="control-label col-md-2">房源标题</label>
            <div class="col-md-5">
                <input type='text' id="title" name='post[title]'  required value='<?php echo ($post["title"]); ?>' class='form-control' placeholder='房源标题' />
                <span class="help-block">已自动生成，可自行更改</span>
            </div>
        </div>        
        <div class="form-group">
            <label class="control-label col-md-2">房源描述</label>
            <div class="col-md-8">
                <div id='content_tip'></div>
                <textarea name='post[resume]' id='content' placeholder='请填写摘要'><?php echo ($post["resume"]); ?></textarea>
              
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/fang/statics/js/ueditor/ueditor.frontend.config.js"></script>
                <script type="text/javascript"  src="/fang/statics/js/ueditor/ueditor.all.min.js"></script>
                <script>
                //编辑器
	            editorcontent = new baidu.editor.ui.Editor();
	            editorcontent.render( 'content' );
	            try{editorcontent.sync();}catch(err){};
                </script>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">上传照片</label>
            <div class="col-md-10">
                <fieldset class="blue pad-10">
		        <legend>图片列表</legend>
		        <ul id="photos" class="picList unstyled">
			        <?php if(is_array($smeta)): foreach($smeta as $key=>$vo): ?><li id="savedimage<?php echo ($key); ?>">
                            <img src="<?php echo sp_get_asset_upload_path($vo['url']);?>" style="width: 100px;" />
				        	<input type="hidden" name="photos_url[]" value="<?php echo sp_get_asset_upload_path($vo['url']);?>" title='双击查看' style="width:310px;" ondblclick="image_priview(this.value);" class="input">
				        	<input type="text" name="photos_alt[]" value="<?php echo ($vo["alt"]); ?>" style="width:160px;" class="input" onfocus="if(this.value == this.defaultValue) this.value = ''" onblur="if(this.value.replace(' ','') == '') this.value = this.defaultValue;">
				        	<a href="javascript:remove_img('savedimage<?php echo ($key); ?>')">移除</a>
				        </li><?php endforeach; endif; ?>
		        </ul>
				</fieldset>
				<a href="javascript:;" style="margin: 5px 0;" onclick="javascript:flashupload('albums_images', '图片上传','photos',change_images,'10,gif|jpg|jpeg|png|bmp,0','swfupload','','')" class="btn">添加图片 </a>
			  
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="control-label col-md-2">缩略图</label>
            <div class="col-md-10">
                    <div  style="text-align: center;">
                      <input type='hidden' name='post[photo]' id='thumb' value="<?php echo ((isset($post["photo"]) && ($post["photo"] !== ""))?($post["photo"]):''); ?>">
        			<a href='javascript:void(0);' onclick="flashupload('thumb_images', '附件上传','thumb',thumb_images,'1,jpg|jpeg|gif|png|bmp,1,,,1','','','');return false;">
        			
        			<?php if(empty($post[photo])): ?><img src="/fang/statics/images/icon/upload-pic.png" id='thumb_preview' width='135' height='113' style='cursor:hand' />
        			<?php else: ?>
        				<img src="<?php echo ($post["photo"]); ?>" id='thumb_preview' width='135' height='113' style='cursor:hand' /><?php endif; ?>
        			
        			</a>
        			<!-- <input type="button" class="btn" onclick="crop_cut_thumb($('#thumb').val());return false;" value="裁减图片">  -->
                    <input type="button"  class="btn" onclick="$('#thumb_preview').attr('src','/fang/statics/images/icon/upload-pic.png');$('#thumb').val('');return false;" value="取消图片">
                    </div>
            </div>
       </div>
       
        <div class="form-group">
            <label class="control-label col-md-2">入住时间</label>
            <div class="col-md-3">
                <input type="text" name="post[ruzhudate]" id="updatetime" value="<?php echo ($post["ruzhudate"]); ?>" size="21" class="form-control input-small J_datetime" ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">姓名</label>
            <div class="col-md-3">
                <input type="text" name="post[ename]" required value="<?php echo ($post["ename"]); ?>" class="form-control" placeholder="尊姓大名"  />
              	
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-2">联系电话</label>
            <div class="col-md-5">
                <input type='text' name='post[ephone]' id='ephone' required value='<?php echo ($post["ephone"]); ?>'  class='form-control' placeholder='请输入手机号'>
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                
                <input type="hidden" name="post[eid]" value="<?php echo ($post["eid"]); ?>">
                <button class="btn btn-success btn_submit J_ajax_submit_btn" type="submit">提交</button>
                <a class="btn" href="<?php echo I('session.jumpUrledit');?>">返回</a>
            </div>
      </div>
      </div>
  <!-------------------------------------------------------------------------------------------------------->
  </div>
  
 </form>
 
 <?php $leibie=C('leibie'); $housetype=C('housetype'); $paytype=C('paytype'); $peitao=C('peitao'); $mypeitao=explode(",",$post['peitao']); $myshopfor=explode(",",$post['shopfor']);?>
 <?php switch($post["serveritem"]): case "1": ?><!--====================================住宅别墅基本信息=======================================-->
       <section id="house" style="display: none;">
       
            <!--出租方式-->
            <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-3">
                    <?php if(is_array($leibie['house'])): $i = 0; $__LIST__ = $leibie['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" onclick="hezu(<?php echo ($key); ?>);" id="houseleibie<?php echo ($key); ?>" type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" <?php echo ($post[leibie]==$key?"checked":""); ?> /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            
         <!--房屋类型-->
         <div class="form-group">
                <label class="control-label col-md-2">房屋类型</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[housetype]" onchange="housetype_change(this);">
              
                <?php if(is_array($housetype['house'])): $i = 0; $__LIST__ = $housetype['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[housetype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
                </div>
            </div>
        
            <!--户型-->
           <div class="form-group">
                <label class="control-label col-md-2">户型</label>
                <div id="househx" >
                    <div class="col-md-5" ><!--整租户型-->
                        <div class="input-group">
                                <input type="text"  name="post[hxs]" required value="<?php echo ($post["hxs"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">室</span>
                                <input type="text"  name="post[hxt]" required value="<?php echo ($post["hxt"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">厅</span>
                                <input type="text"  name="post[hxw]" required value="<?php echo ($post["hxw"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                                <span class="input-group-addon">卫</span>
                                </div>
                    </div>
                </div>
            </div> 
            <!--面积-->
            <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" id="mianji" name="post[mj]" required value="<?php echo ($post["mj"]); ?>"  class="mianji form-control input_hd J_title_color" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
            
            <!--装修-->
            <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[zhuangxiu]">
              
                <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[zhuangxiu]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
            
            <!--  朝向-->
            <div class="form-group">
                <label class="control-label col-md-2">朝向</label>
                <div class="col-md-3">
                    <select class="form-control" name="post[caoxiang]">
              
                <?php $_result=C('caoxiang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[caoxiang]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
            
            <!-- 楼层-->
            <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value="<?php echo ($post["lc"]); ?>"  class="floor form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value="<?php echo ($post["lcall"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
            
            <!-- 楼栋号-->
            <div class="form-group">
                <label class="control-label col-md-2">楼栋号</label>
                <div class="col-md-6">
                    <div class="input-group">
                            <input type="text"  name="post[lhh]" required value="<?php echo ($post["lhh"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">幢/号/层</span>
                            <input type="text"  name="post[lhd]" required value="<?php echo ($post["lhd"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">单元</span>
                            <input type="text"  name="post[lhs]" required value="<?php echo ($post["lhs"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">室 (楼栋号不对外显示[只能填写数字])</span>
                            </div>
                </div>
            </div>	
 

            <!--租金-->
            <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-4">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value="<?php echo ($post["zj"]); ?>"  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">元/月</span>
                            <input type="hidden" value="3" name="post[pricetype]" />
                            <select class="form-control"   name="post[paytype]">
              
                                <?php if(is_array($paytype['house'])): $i = 0; $__LIST__ = $paytype['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[pricetype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                				</select>
                            </div>
                </div>
            </div>
            
            <!--配套设施-->
            <div class="form-group">
                <label class="control-label col-md-2">配套设施</label>
                <div class="col-md-8" id="zzpeitao"><!--住宅配套-->
                    <?php if(is_array($peitao['house'])): $i = 0; $__LIST__ = $peitao['house'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"  <?php echo in_array($key,$mypeitao)?"checked":"";?>><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="col-md-8" id="bspeitao" style="display: none;"><!--别墅配套-->
                    <?php if(is_array($peitao['biesu'])): $i = 0; $__LIST__ = $peitao['biesu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">								
							<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"  <?php echo in_array($key,$mypeitao)?"checked":"";?>><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>            
          </section><?php break;?>
          <?php case "2": ?><!--============================================================写字楼基本信息=====================================================-->
 
         <section id="office" style="display: none">
            <!--写字楼出租方式-->
            <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-3">
                    <?php if(is_array($leibie['office'])): $i = 0; $__LIST__ = $leibie['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="officeleibie<?php echo ($key); ?>" type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" <?php echo ($post[leibie]==$key?"checked=checked":""); ?> /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
         <!--写字楼类型级别-->
         <div class="form-group">
                <label class="control-label col-md-2">类型</label>
                <div class="col-md-6">
                    <div class="input-group">
                    <select class="form-control"  name="post[housetype]">
              
                <?php if(is_array($housetype['office'])): $i = 0; $__LIST__ = $housetype['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[housetype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
                <span class="input-group-addon">级别</span>
                <select name="post[officegrade]" class="form-control">
              
                <?php $_result=C('officegrade');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[officegrade]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                    </div>
                    
                </div>
            </div>
         
         <!--写字楼面积-->
         <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[mj]" required value="<?php echo ($post["mj"]); ?>" class="mianji form-control input_hd J_title_color" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
         <!-- 写字楼楼层-->
         <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value="<?php echo ($post["lc"]); ?>"  class="floor form-control input_hd J_title_color"  />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value="<?php echo ($post["lcall"]); ?>"  class="form-control input_hd J_title_color"  />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
         <!-- 写字楼租金-->
         <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-6">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value="<?php echo ($post["zj"]); ?>"  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">
                            <?php $_result=C('pricetype');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[pricetype]" <?php echo ($post[pricetype]==$key?"checked":""); ?> /><?php echo ($vo); ?>
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
              
                <?php if(is_array($paytype['office'])): $i = 0; $__LIST__ = $paytype['office'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[paytype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
         
         <!--写字楼是否包含物业费-->
         <div class="form-group">
                <label class="control-label col-md-2">是否包含物业费</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" type="radio" name="post[officewuye]" <?php echo ($post[officewuye]==1?"checked":""); ?> />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[officewuye]" <?php echo ($post[officewuye]==0?"checked":""); ?> />否
							</label>
                </div>
            </div>
         
         <!--写字楼物业费金额-->
         <div class="form-group">
                <label class="control-label col-md-2">物业金额</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text"  name="post[officewuyefei]" required value="<?php echo ($post["officewuyefei"]); ?>"  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">元/平米·月 </span>
                            </div>
                </div>
            </div>
         
         <!--写字楼物业公司-->
         <div class="form-group">
                <label class="control-label col-md-2">物业公司</label>
                <div class="col-md-6">
                    
                            <input type="text"  name="post[officecompany]" required value="<?php echo ($post["officecompany"]); ?>"  class="form-control input_hd J_title_color" />
                            
                </div>
            </div>
        
         <!--写字楼是否可分割-->
         <div class="form-group">
                <label class="control-label col-md-2">是否可分割</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" id="officefenge" type="radio" name="post[fenge]" <?php echo ($post[genge]==1?"checked":""); ?>  />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[fenge]" <?php echo ($post[genge]==0?"checked":""); ?> />否
							</label>
                </div>
            </div>
         
         <!--写字楼装修程度-->
         <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[zhuangxiu]">
                  
                    <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[zhuangxiu]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    				</select>
                </div>
            </div>
         
         <!-- 写字楼有效期-->
         <div class="form-group">
                <label class="control-label col-md-2">有效期</label>
                <div class="col-md-3">
                    <select class="form-control"   name="post[expiry]">             
                                          
        					<option value="30" <?php echo ($post[expiry]==30?"selected":""); ?>>30</option>
                            <option value="60" <?php echo ($post[expiry]==60?"selected":""); ?>>60</option>
                            <option value="7" <?php echo ($post[expiry]==7?"selected":""); ?>>7</option>
                            <option value="15" <?php echo ($post[expiry]==15?"selected":""); ?>>15</option>
                            
                        
    				</select>
                </div>
            </div>
         
         </section><?php break;?>
          <?php case "3": ?><!--==============================商品基本信息===============================-->
        <section id="shop" style="display: none">
        <!--商铺类别-->
        <div class="form-group">
                <label class="control-label col-md-2">出租方式</label>
                <div class="col-md-3">
                    <?php if(is_array($leibie['shop'])): $i = 0; $__LIST__ = $leibie['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" id="shopleibie<?php echo ($key); ?>"  type="radio" name="post[leibie]" title="<?php echo ($vo); ?>" <?php echo ($post[leibie]==$key?"checked":""); ?> /><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        <!--商铺类型-->
        <div class="form-group">
                <label class="control-label col-md-2">类型</label>
                <div class="col-md-3">
                    
                    <select class="form-control"  name="post[housetype]">
              
                <?php if(is_array($housetype['shop'])): $i = 0; $__LIST__ = $housetype['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[housetype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>            
                    
                    
                </div>
            </div>
       
        <!--商铺当前状态-->
        <div class="form-group">
                <label class="control-label col-md-2">当前状态</label>
                <div class="col-md-3">
                    <?php $_result=C('shopstate');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[shopstate]" <?php if($key == $post[shopstate]): ?>checked="checked"<?php endif; ?>><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
       
        <!--商铺可经营类别-->
        <div class="form-group">
                <label class="control-label col-md-2">可经营类别</label>
                <div class="col-md-8">
                    <?php $_result=C('shopfor');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[shopfor][]"  <?php echo in_array($key,$myshopfor)?"checked":"";?> ><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
         
        <!--商铺房屋配套-->
        <div class="form-group">
                <label class="control-label col-md-2">配套设施</label>
                <div class="col-md-8">
                    <?php if(is_array($peitao['shop'])): $i = 0; $__LIST__ = $peitao['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline">
								
								<input value="<?php echo ($key); ?>" type="checkbox" name="post[peitao][]"  <?php echo in_array($key,$mypeitao)?"checked":"";?>><?php echo ($vo); ?>
							</label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
       
        <!--商铺出租面积----------------->
        <div class="form-group">
                <label class="control-label col-md-2">建筑面积</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[mj]" required value="<?php echo ($post["mj"]); ?>"  class="mianji form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">平方米</span>
                            </div>
                </div>
            </div>
         <!--商铺楼层--------------------->
         <div class="form-group">
                <label class="control-label col-md-2">楼层</label>
                <div class="col-md-3">
                    <div class="input-group">
                            <input type="text" name="post[lc]" required value="<?php echo ($post["lc"]); ?>"  class="floor form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层，共</span>
                            <input type="text"  name="post[lcall]" required value="<?php echo ($post["lcall"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">层</span>
                            </div>
                </div>
            </div>
         <!--商铺租金--------------------->
         <div class="form-group">
                <label class="control-label col-md-2">租金</label>
                <div class="col-md-6">
                    <div class="input-group">
                            <input type="text"  name="post[zj]" required value="<?php echo ($post["zj"]); ?>"  class="form-control input_hd J_title_color" />
                            <span class="input-group-addon">
                            <?php $_result=C('pricetype');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio-inline">
								
								<input value="<?php echo ($key); ?>" type="radio" name="post[pricetype]" <?php echo ($post[pricetype]==$key?"checked":""); ?> /><?php echo ($vo); ?>
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
              
                <?php if(is_array($paytype['shop'])): $i = 0; $__LIST__ = $paytype['shop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[paytype]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
                </div>
            </div>
        
        
        
        <!--商铺是否可分割--------------->
        <div class="form-group">
                <label class="control-label col-md-2">是否可分割</label>
                <div class="col-md-3">
                    <label class="radio-inline">
								
								<input value="1" id="shopfenge" type="radio" name="post[fenge]" <?php echo ($post[fenge]==1?"checked":""); ?> />是
							</label> 
                            <label class="radio-inline">
								
								<input value="0" type="radio" name="post[fenge]" <?php echo ($post[fenge]==0?"checked":""); ?> />否
							</label>
                </div>
            </div>
        <!--商铺装修程度-----------------> 
        <div class="form-group">
                <label class="control-label col-md-2">装修程度</label>
                <div class="col-md-3">
                    <select class="form-control"  name="post[zhuangxiu]">
                  
                    <?php $_result=C('zhuangxiu');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php echo ($post[zhuangxiu]==$key?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    				</select>
                </div>
            </div>
        <!--商铺有效期------------------->
        <div class="form-group">
                <label class="control-label col-md-2">有效期</label>
                <div class="col-md-3">
                    <select class="form-control"   name="post[expiry]">             
                                          
        					<option value="30" <?php echo ($post[expiry]==30?"selected":""); ?>>30</option>
                            <option value="60" <?php echo ($post[expiry]==60?"selected":""); ?>>60</option>
                            <option value="7" <?php echo ($post[expiry]==7?"selected":""); ?>>7</option>
                            <option value="15" <?php echo ($post[expiry]==15?"selected":""); ?>>15</option>
                            
                        
    				</select>
                </div>
            </div>
        </section><?php break; endswitch;?>
        <!--合租户型-->
        
                    <div class="col-md-5" id="hzhx" style="display: none;">
                        
                        
                                    <div class="input-group">
                                    <select class="form-control"   name="post[hzhx]">
                          
                                    <?php $_result=C('hzhx');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo); ?>" <?php echo ($post[hzhx]==$vo?"selected":""); ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                				</select>
                                <span class="input-group-addon"></span>
                                            <select class="form-control" name="post[hzcount]">             
                                                  
                					<option value="1" <?php echo ($post[hzcount]==1?"selected":""); ?>>1</option>
                                    <option value="2" <?php echo ($post[hzcount]==2?"selected":""); ?>>2</option>
                                    <option value="3" <?php echo ($post[hzcount]==3?"selected":""); ?>>3</option>
                                    <option value="4" <?php echo ($post[hzcount]==4?"selected":""); ?>>4</option>
                                    <option value="5" <?php echo ($post[hzcount]==5?"selected":""); ?>>5</option>
                                    <option value="6" <?php echo ($post[hzcount]==6?"selected":""); ?>>6</option>
                                    <option value="7" <?php echo ($post[hzcount]==7?"selected":""); ?>>7</option>
                                    <option value="8" <?php echo ($post[hzcount]==8?"selected":""); ?>>8</option>
                                    <option value="9" <?php echo ($post[hzcount]==9?"selected":""); ?>>9</option>
                                
            				</select>
                            <span class="input-group-addon">户合租</span>
                             <select class="form-control"  name="post[hzlimit]">             
                                                  
                					<option value="性别不限" <?php echo ($post[hzlimit]=="性别不限"?"selected":""); ?>>性别不限</option>
                                    <option value="限男生" <?php echo ($post[hzlimit]=="限男生"?"selected":""); ?>>限男生</option>
                                    <option value="限女生" <?php echo ($post[hzlimit]=="限女生"?"selected":""); ?>>限女生</option>
                                    <option value="限夫妻" <?php echo ($post[hzlimit]=="限夫妻"?"selected":""); ?>>限夫妻</option>
                                    
                                
            				</select>
                                    </div>
                    
                    </div>
                    
                    
            
           <div class="col-md-5" id="zzhx" style="display: none;"><!--整租户型-->
                    
                        
                            <div class="input-group">
                            <input type="text"  name="post[hxs]" required value="<?php echo ($post["hxs"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">室</span>
                            <input type="text"  name="post[hxt]" required value="<?php echo ($post["hxt"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">厅</span>
                            <input type="text"  name="post[hxw]" required value="<?php echo ($post["hxw"]); ?>"  class="form-control input_hd J_title_color" onkeyup="strlen_verify(this, 'title_len', 20)" />
                            <span class="input-group-addon">卫</span>
                            </div>
                            
                        
                        
                        
                           
                    
                </div>     
        <!--==============================================信息结束=============================================-->
 
 
</div>
<script type="text/javascript" src="/fang/statics/js/common.js"></script>
<script type="text/javascript" src="/fang/statics/js/content_addtop.js?v=20151027"></script>
<script type="text/javascript" src="/fang/statics/js/autocomplete/jquery-ui.min.js"></script>
<script type="text/javascript"> 
$(function () {
	   	
	/////---------------------
	 Wind.use('validate', 'ajaxForm', 'artDialog', function () {
			//javascript
	        
	            
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
                    
                    'post[address]':{required:1},
                    'post[ephone]':{required:1},
                    'post[resume]':{editorcontent:true}
                    },
	            
	            //验证未通过提示消息
                messages: {
                    'post[ename]':{required:'请输入姓名'},
                    
                    'post[ephone]':{required:'手机号不能为空'},
                    'post[address]':{required:'家庭住址不能为空'},
                    'post[resume]':{editorcontent:'内容不能为空'}
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
    $("#housetype<?php echo ($post["serveritem"]); ?>").click();//设置默认房源选项
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
                        areaid: $("areaid").val()
                        
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