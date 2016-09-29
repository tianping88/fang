<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.jiazhengyc.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tuolaji <497731598@qq.com>
// +----------------------------------------------------------------------
/**
 * 查询文章列表，不做分页
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 *  ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @param array $where 查询条件，（暂只支持数组），格式和thinkphp where方法一样；
 */
function sp_sql_jz($tag,$where=array()){
	if(!is_array($where)){
		$where=array();
	}
	
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '';
	$order = !empty($tag['order']) ? $tag['order'] : 'eid desc';


	//根据参数生成查询条件
	$where['b.status'] = array('eq',1);
	

	if (isset($tag['cid'])) {
		$where['termid'] = array('in',$tag['cid']);
	}
	
	if (isset($tag['ids'])) {
		$where['eid'] = array('in',$tag['ids']);
	}

	$join = "".C('DB_PREFIX').'jz_employee as b on a.term_id =b.termid';
	$join2= "".C('DB_PREFIX').'users as c on b.uid = c.id';
	$rs= M("Terms");

	$posts=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->order($order)->limit($limit)->select();
	return $posts;
}


/**
 * 查询文章列表，支持分页
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 *  ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @param array $where 查询条件，（暂只支持数组），格式和thinkphp where方法一样；
 * @param int $pagesize 每页条数.
 * @param array $pagesetting 分页设置<br> 
 * 	参数形式：<br>
 * 	array(<br>
 * 		&nbsp;&nbsp;"listlong" => "9",<br>
 * 		&nbsp;&nbsp;"first" => "首页",<br>
 * 		&nbsp;&nbsp;"last" => "尾页",<br>
 * 		&nbsp;&nbsp;"prev" => "上一页",<br>
 * 		&nbsp;&nbsp;"next" => "下一页",<br>
 * 		&nbsp;&nbsp;"list" => "*",<br>
 * 		&nbsp;&nbsp;"disabledclass" => ""<br>
 * 	)
 * @param string $pagetpl 以字符串方式传入,例："{first}{prev}{liststart}{list}{listend}{next}{last}"
 * @return array 包括分页的文章列表<br>
 * array(<br>
 * 	&nbsp;&nbsp;"posts"=>"",//文章列表，array<br>
 * 	&nbsp;&nbsp;"page"=>""//分页html<br>
 * )
 */

function sp_jz($tag,$where=array(),$pagesize=20,$pagesetting=array(),$pagetpl='{first}{prev}{liststart}{list}{listend}{next}{last}'){
	$where=is_array($where)?$where:array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '10';
	$order = !empty($tag['order']) ? $tag['order'] : 'post_date';

	//根据参数生成查询条件
	$where['a.status'] = array('eq',1);
	

	if (isset($tag['serveritem'])) {
		$where['serveritem'] = array('in',$tag['serveritem']);
	}

	if (isset($tag['ids'])) {
		$where['eid'] = array('in',$tag['ids']);
	}
	
	if (isset($tag['where'])) {
		$where['_string'] = $tag['where'];
	}

	$join = "".C('DB_PREFIX').'district as b on a.areaid =b.id';
	$join2= "".C('DB_PREFIX').'jz_area as c on a.xqid = c.id';
	$rs= M("JzEmployee");
	$totalsize=$rs->alias("a")->join($join,'LEFT')->join($join2,'LEFT')->field($field)->where($where)->count();

	import('Page');
	if ($pagesize == 0) {
		$pagesize = 20;
	}
	$PageParam = C("VAR_PAGE");
	$page = new \Page($totalsize,$pagesize);
	$page->setLinkWraper("li");
	$page->__set("PageParam", $PageParam);
	$pagesetting=!empty($pagesetting)?$pagesetting: array("listlong" => "9", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => "");
	$page->SetPager('default', $pagetpl,$pagesetting);
	$posts=$rs->alias("a")->join($join,'LEFT')->join($join2,'LEFT')->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();

	$content['posts']=$posts;
	$content['page']=$page->show('default');
	return $content;
}

/**
 * 功能：根据分类文章分类ID 获取该分类下所有文章（包含子分类中文章），调用方式同sp_sql_posts
 * @author labulaka 2014-11-09 14:30:49
 * @param int $cid 文章分类ID.
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 * 		cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 		field:调用post指定字段,如(id,post_title...) 默认全部
 * 		limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)
 * 		order:排序方式，如：post_date desc<br>
 * 		where:查询条件，字符串形式，和sql语句一样
 * @param array $where 查询条件，（暂只支持数组），格式和thinkphp where方法一样；
 */

function sp_sql_posts_bycatid($cid,$tag,$where=array()){
	$cid=intval($cid);
	$catIDS=array();
	$terms=M("Terms")->field("term_id")->where("status=1 and ( term_id=$cid OR path like '%-$cid-%' )")->order('term_id asc')->select();

	foreach($terms as $item){
		$catIDS[]=$item['term_id'];
	}
	if(!empty($catIDS)){
		$catIDS=implode(",", $catIDS);
		$catIDS="cid:$catIDS;";
	}else{
		$catIDS="";
	}
	$content= sp_sql_jz($catIDS.$tag,$where);
	return $content;

}

/**
 * 文章分页查询方法
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 * 	ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @param int $pagesize 每页条数.
 * @param string $pagetpl 以字符串方式传入,例："{first}{prev}{liststart}{list}{listend}{next}{last}"
 * @return array 带分页数据的文章列表
 
 */

function sp_sql_jz_paged($tag,$pagesize=20,$pagetpl='{first}{prev}{liststart}{list}{listend}{next}{last}'){
	$where=array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '';
	$order = !empty($tag['order']) ? $tag['order'] : 'post_date';

	//根据参数生成查询条件
	$where['b.status'] = array('eq',1);
	

	if (isset($tag['cid'])) {
		$where['termid'] = array('in',$tag['cid']);
	}

	if (isset($tag['ids'])) {
		$where['eid'] = array('in',$tag['ids']);
	}
	
	if (isset($tag['where'])) {	   
		$where['_string'] = $tag['where'];
	}

	$join = "".C('DB_PREFIX').'jz_employee as b on a.term_id =b.termid';
	$join2= "".C('DB_PREFIX').'users as c on b.uid = c.id';
	$rs= M("Terms");
	$totalsize=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->count();
	
	import('Page');
	if ($pagesize == 0) {
		$pagesize = 9;
	}
	$PageParam = C("VAR_PAGE");
	$page = new \Page($totalsize,$pagesize);
	$page->setLinkWraper("li");
	$page->__set("PageParam", $PageParam);
	$page->SetPager('default', $pagetpl, array("listlong" => "5", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => "disabled"));
	$posts=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();

	$content['posts']=$posts;
	$content['page']=$page->show('default');
	$content['count']=$totalsize;
	return $content;
}

/**
 * 功能：根据关键字 搜索文章（包含子分类中文章），已经分页，调用方式同sp_sql_posts_paged<br>
 * @author WelkinVan 2014-12-04
 * @param string $keyword 关键字.
 * @param string $tag 查询标签，以字符串方式传入,例："field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 * 		field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 		limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 		order:排序方式，如：post_date desc<br>
 * 		where:查询条件，字符串形式，和sql语句一样
 * @param int $pagesize 每页条数.
 * @param string $pagetpl 以字符串方式传入,例："{first}{prev}{liststart}{list}{listend}{next}{last}"
 */
function sp_sql_jz_paged_bykeyword($keyword,$tag,$pagesize=20,$pagetpl='{first}{prev}{liststart}{list}{listend}{next}{last}'){
	$where=array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '';
	$order = !empty($tag['order']) ? $tag['order'] : 'post_date';


	//根据参数生成查询条件
	$where['status'] = array('eq',1);
	
	$where['ename'] = array('like','%' . $keyword . '%');
	
	if (isset($tag['cid'])) {
		$where['termid'] = array('in',$tag['cid']);
	}

	if (isset($tag['ids'])) {
		$where['eid'] = array('in',$tag['ids']);
	}

	$join = "".C('DB_PREFIX').'jz_employee as b on a.term_id =b.termid';
	$join2= "".C('DB_PREFIX').'users as c on b.uic = c.id';
	$rs= M("Terms");
	$totalsize=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->count();
	import('Page');
	if ($pagesize == 0) {
		$pagesize = 20;
	}
	$PageParam = C("VAR_PAGE");
	$page = new Page($totalsize,$pagesize);
	$page->setLinkWraper("li");
	$page->__set("PageParam", $PageParam);
	$page->SetPager('default', $pagetpl, array("listlong" => "9", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => ""));
	$posts=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();
	$content['count']=$totalsize;
	$content['posts']=$posts;
	$content['page']=$page->show('default');
	return $content;
}

/**
 * 功能：根据分类文章分类ID 获取该分类下所有文章（包含子分类中文章），已经分页，调用方式同sp_sql_posts_paged<br>
 * @author labulaka 2014-11-09 14:30:49
 * @param int $tid 文章分类ID.
 * @param string $tag 查询标签，以字符串方式传入,例："field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 * 		field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 		limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 		order:排序方式，如：post_date desc<br>
 *		where:查询条件，字符串形式，和sql语句一样
 * @param int $pagesize 每页条数.
 * @param string $pagetpl 以字符串方式传入,例："{first}{prev}{liststart}{list}{listend}{next}{last}"
 */

function sp_sql_jz_paged_bycatid($cid,$tag,$pagesize=20,$pagetpl='{first}{prev}{liststart}{list}{listend}{next}{last}'){
	$cid=intval($cid);
	$catIDS=array();
	$terms=M("Terms")->field("term_id")->where("status=1 and ( term_id=$cid OR path like '%-$cid-%' )")->order('term_id asc')->select();
	
	foreach($terms as $item){
		$catIDS[]=$item['term_id'];
	}
	if(!empty($catIDS)){
		$catIDS=implode(",", $catIDS);
		$catIDS="cid:$catIDS;";
	}else{
		$catIDS="";
	}
	$content= sp_sql_jz_paged($catIDS.$tag,$pagesize,$pagetpl);
	return $content;

}
/**
 * 获取指定id的文章
 * @param int $tid 分类表下的tid.
 * @param string $tag 查询标签，以字符串方式传入,例："field:post_title,post_content;"<br>
 *	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * @return array 返回指定id的文章
 */
function sp_sql_jz_byid($eid,$tag){
	$where=array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';

	//根据参数生成查询条件
	$where['status'] = array('eq',1);
	$where['eid'] = array('eq',$eid);

	$join = "".C('DB_PREFIX').'jz_employee as b on a.term_id =b.termid';
	$join2= "".C('DB_PREFIX').'users as c on b.uic = c.id';
	$rs= M("Terms");
	

	$post=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->find();
	return $post;
}

/**
 * 获取指定条件的页面列表
 * @param string $tag 查询标签，以字符串方式传入,例："ids:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 * 	ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @return array 返回符合条件的所有页面
 */
function sp_sql_pages($tag){
	$where=array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '';
	$order = !empty($tag['order']) ? $tag['order'] : 'eid desc';

	//根据参数生成查询条件
	$where['status'] = array('eq',1);
	
	
	if (isset($tag['ids'])) {
		$where['id'] = array('in',$tag['ids']);
	}
	
	if (isset($tag['where'])) {
		$where['_string'] = $tag['where'];
	}

	$posts_model= M("JzEmployee");

	$pages=$posts_model->field($field)->where($where)->order($order)->limit($limit)->select();
	return $pages;
}

/**
 * 获取指定id的页面
 * @param int $id 页面的id
 * @return array 返回符合条件的页面
 */
function sp_sql_page($id){
	$where=array();
	$where['eid'] = array('eq',$id);

	$rs= M("JzEmployee");
	$post=$rs->where($where)->find();
	return $post;
}



/**
 * 查询公司列表，不做分页
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 *  ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @param array $where 查询条件，（暂只支持数组），格式和thinkphp where方法一样；
 */
function sp_sql_gongsi($tag,$where=array()){
	if(!is_array($where)){
		$where=array();
	}
	
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '';
	$order = !empty($tag['order']) ? $tag['order'] : 'id desc';


	//根据参数生成查询条件
	$where['status'] = array('eq',1);
	

	if (isset($tag['cid'])) {
		$where['item'] = array('in',$tag['cid']);
	}
	
	if (isset($tag['ids'])) {
		$where['id'] = array('in',$tag['ids']);
	}	


	
	
	$rs= M("JzGongsi");

	$posts=$rs->field($field)->where($where)->order($order)->limit($limit)->select();
	return $posts;
}


/**
 * 查询文章列表，支持分页
 * @param string $tag  查询标签，以字符串方式传入,例："cid:1,2;field:post_title,post_content;limit:0,8;order:post_date desc,listorder desc;where:id>0;"<br>
 *  ids:调用指定id的一个或多个数据,如 1,2,3<br>
 * 	cid:数据所在分类,可调出一个或多个分类数据,如 1,2,3 默认值为全部,在当前分类为:'.$cid.'<br>
 * 	field:调用post指定字段,如(id,post_title...) 默认全部<br>
 * 	limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)<br>
 * 	order:排序方式，如：post_date desc<br>
 *	where:查询条件，字符串形式，和sql语句一样
 * @param array $where 查询条件，（暂只支持数组），格式和thinkphp where方法一样；
 * @param int $pagesize 每页条数.
 * @param array $pagesetting 分页设置<br> 
 * 	参数形式：<br>
 * 	array(<br>
 * 		&nbsp;&nbsp;"listlong" => "9",<br>
 * 		&nbsp;&nbsp;"first" => "首页",<br>
 * 		&nbsp;&nbsp;"last" => "尾页",<br>
 * 		&nbsp;&nbsp;"prev" => "上一页",<br>
 * 		&nbsp;&nbsp;"next" => "下一页",<br>
 * 		&nbsp;&nbsp;"list" => "*",<br>
 * 		&nbsp;&nbsp;"disabledclass" => ""<br>
 * 	)
 * @param string $pagetpl 以字符串方式传入,例："{first}{prev}{liststart}{list}{listend}{next}{last}"
 * @return array 包括分页的文章列表<br>
 * array(<br>
 * 	&nbsp;&nbsp;"posts"=>"",//文章列表，array<br>
 * 	&nbsp;&nbsp;"page"=>""//分页html<br>
 * )
 */

function sp_gongsi($tag,$where=array(),$pagesize=20,$pagesetting=array(),$pagetpl='{first}{prev}{liststart}{list}{listend}{next}{last}'){
	$where=is_array($where)?$where:array();
	$tag=sp_param_lable($tag);
	$field = !empty($tag['field']) ? $tag['field'] : '*';
	$limit = !empty($tag['limit']) ? $tag['limit'] : '10';
	$order = !empty($tag['order']) ? $tag['order'] : 'a.id desc';

	//根据参数生成查询条件
	$where['status'] = array('eq',1);
	

	if (isset($tag['cid'])) {
		$where['item'] = array('in',$tag['cid']);
	}

	if (isset($tag['ids'])) {
		$where['id'] = array('in',$tag['ids']);
	}
	
	if (isset($tag['where'])) {
		$where['_string'] = $tag['where'];
	}

	
	
	$rs= M("JzGongsi");
	$totalsize=$rs->field($field)->where($where)->count();

	import('Page');
	if ($pagesize == 0) {
		$pagesize = 20;
	}
	$PageParam = C("VAR_PAGE");
	$page = new \Page($totalsize,$pagesize);
	$page->setLinkWraper("li");
	$page->__set("PageParam", $PageParam);
	$pagesetting=!empty($pagesetting)?$pagesetting: array("listlong" => "9", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => "");
	$page->SetPager('default', $pagetpl,$pagesetting);
	$posts=$rs->alias("a")->join($join)->join($join2)->field($field)->where($where)->order($order)->limit($page->firstRow . ',' . $page->listRows)->select();

	$content['list']=$posts;
	$content['page']=$page->show('default');
	return $content;
}
/**
 * 根据不同类型生成查询参数
 * 0-1-2-3-4-5-6-7.html 0为房源分类，1为区域，2为户型，3为租金，4为房屋类型，5为出租方式，6为小区,7为商铺行业
 * @param $key 关键字位置
 * @param $val 相应的值
 */
function genparam($key=0,$val=0){
    $input=I('param.');
    
    $param=array();
    if(isset($input['id']) && strpos($input['id'],'-')){
        $param=explode('-',$input['id']);
    }
    else{
        $param=array(0,0,0,0,0,0,0,0);        
        
    }
        //在设置区域的时候，应该将小区取消，不然有冲突
        if($key===1){
            $param[6]=0;
        }
        
        $param[$key]=$val;
        $input['id']=implode('-',$param);
        
        $url=leuu('Jiazheng/index/fangyuan',$input);
        return $url;
    
}
/**
 * 判断该值是否在范围内
 * 
 * 
 */
function checkme($key=0,$val=0){
    $input=I('param.');
    $param=array();
    if(isset($input['id'])&&strpos($input['id'],'-')){
        $param=explode('-',$input['id']); 
        
    }
    else{
       $param=array(0,0,0,0,0,0,0,0);  
    }    
    return $param[$key]==$val?true:false;
}
/**
 * 获取省市地址
 * @param $pid 父ID
 * 
 * 
 */
 function getcity($pid=0){ 
    $map['upid'] = C('AREAID');
    $list = D('ChinaCity/District')->_list($map);
    return $list;
 }
 
 /**
  *根据搜索条件组成title 
  * 0-1-2-3-4-5-6-7.html 0为房源分类，1为区域，2为户型，3为租金，4为房屋类型，5为出租方式，6为小区,7为商铺行业
  * 
  */
  function gentitle(){
    $input=I('param.');    
    $param=array();
    if(isset($input['id']) && strpos($input['id'],'-')){
        $param=explode('-',$input['id']);
    }
    else{
        $param=array(0,0,0,0,0,0,0,0);        
        
    }
    $title=array();
    $data=array();
    //房源类型
    $fangyuan='';//房源类型
    $area='永川区';//区域
    $fangsi='';//出租方式
    $huxing='';//户型
    $housefield=C('housefield');
    $housefield=$housefield[$param[0]];
    
    if($param[0]){
        //房源类型
        
        $itemdata=C('serveritem');
        $fangyuan=$itemdata[$param[0]];       
        //区域
        if($param[1]){            
            $areadata=D('ChinaCity/District')->getdistrict_bypinyin($param[1]);
            $area=$area.$areadata['name'];            
        }
        //出租方式
        if($param[5]){
            
            $data=C('leibie');
            $data=$data[$housefield];
            $fangsi=$data[$param[5]];
        }else{            
            $fangsi=$param[0]==='1'?'整租合租':'出租转让';
        }
        //以房源类型+区域+出租方式为基础来增加关键字
        $title[]=$area.$fangyuan.$fangsi;//区域+房源+方式
        
        if($param[2]){            
            if(intval($param[5])===2){
                $data=C('hzhx');                
            }else{
                $data=C('hx');                
            }
            $huxing=$data[$param[2]];
            $title[]=$area.$huxing.$fangyuan.$fangsi;//区域+户型+房源+方式
            
        }
        //租金
        if($param[3]){            
            $data=C('zujin');
            $title[]='房租'.$data[$param[3]];
        }
        
        //房屋类型
        if($param[4]){
            $v=$param[4];        
            $housetype=C('housetype');
            $housetype=$housetype[$housefield];        
            $title[]=$area.$huxing.$housetype[$v].$fangyuan.$fangsi;//区域+户型+房屋类型+方式
        }
        //小区
        if($param[6]){
            $v=$param[6];
            $d=D('Common/JzArea')->getarea_bypinyin($v);
            if($d){
               $title[]=$d['name'].$huxing.$fangyuan.$fangsi; //小区+户型+房源+方式
            }        
            
        }
        //商铺行业
        if($param[7]){
            $v=$param[7];
            $shopfor=C('shopfor');           
            $title[]=$shopfor[$v].$fangyuan.$fangsi; //小区+户型+房源+方式
                    
            
        }
    }
    
    
    
    
    
    
    
    
    return implode(',',$title);
    
  }
  /**
  *根据搜索条件组成洋葱皮 
  * 0-1-2-3-4-5-6-7.html 0为房源分类，1为区域，2为户型，3为租金，4为房屋类型，5为出租方式，6为小区,7为商铺行业
  * 顺序为：房源类型，区域，小区
  */
  function genpath($serveritem=0,$pinyin=''){
    
    if($serveritem){
        $v=$serveritem;
        $serveritem=C('serveritem');
        $title[]=array('url'=>"/yongchuanzufang/$v-0-0-0-0-0-0-0.html",'title'=>"永川$serveritem[$v]出租");
        if($pinyin){
            
            $area=D('ChinaCity/District');
            $data=$area->getdistrict_bypinyin($pinyin);
            if($data){
                $title[]=array('url'=>"/yongchuanzufang/$v-$data[pinyin]-0-0-0-0-0-0.html",'title'=>"$data[name]$serveritem[$v]出租");
            }
            
        }
        
    }
    
    return $title;
    
  }
  
   /**
  *根据地址组成查询条件 
  * 0-1-2-3-4-5-6-7.html 0为房源分类，1为区域，2为户型，3为租金，4为房屋类型，5为出租方式，6为小区,7为商铺行业
  * 
  */
  function genwhere(){
    $input=I('param.');    
    $param=array();
    if(isset($input['id']) && strpos($input['id'],'-')){
        $param=explode('-',$input['id']);
    }
    else{
        $param=array(0,0,0,0,0,0,0,0);        
        
    }
    $title=array();
    $data=array();
    
    if($param[0]){
        //serveritem     服务项目，用，号隔开   
        $title['serveritem']=$param[0];
        //$title['_string']='FIND_IN_SET('.$param[1].', serveritem)';
    }
    if($param[1]){
        $v=$param[1];//工作区域
        $title['b.pinyin']=$v; 
        //$title[]='FIND_IN_SET('.$v.', workadress)';      
        //$title['workadress']=array('like','%,'.$v.',%');
    }
    if($param[2]){
        $v=$param[2];//户型,大于5，则不一样
        $title['hxs']=$v>=5?array('egt',$v):$v;      
        //$title['eskill']=array('like','%,'.$v.',%');
    }
    
    if($param[3]){
        $v=$param[3];//租金
        switch($v){
            case '1':
                $title['zj']=array('elt',500);//租金小于500;
                break;
                
            case '2':
                $title['zj']=array('between','500,1000');//<=500;
                break;
            case '3':
                $title['zj']=array('between','1000,2000');//<=500;
                break;
            case '4':
                $title['zj']=array('between','2000,3000');//<=500;
                break;
            case '5':
                $title['zj']=array('between','3000,5000');//<=500;
                break;
            case '6':
                $title['zj']=array('egt',5000);//<=500;
                break;            
        }
        
    }
    if($param[4]){
        $v=$param[4];//房屋类型
        $title['housetype']=$v;
    }
    if($param[5]){
        $v=$param[5];//XUELI
        $title['leibie']=$v;
    }
    if($param[6]){
        $v=$param[6];//jiguan
         //$title[]='FIND_IN_SET('.$v.', jiguan)';     
        $title['c.pinyin']=$v;
    }
    if($param[7]){
        $v=$param[7];//jiguan
         //$title[]='FIND_IN_SET('.$v.', jiguan)';        
        $title[]='FIND_IN_SET('.$v.', shopfor)'; 
    }
    return $title;
    
  }
  /**
   * 格式化日期
   * 
   * 
   */
function formatDate($sTime) {
 //sTime=源时间，cTime=当前时间，dTime=时间差
 $cTime  = time();
 $dTime  = $cTime - $sTime;
 $dDay  = intval(date("Ymd",$cTime)) - intval(date("Ymd",$sTime));
 $dYear  = intval(date("Y",$cTime)) - intval(date("Y",$sTime));
 if( $dTime < 60 ){
  $dTime =  $dTime."秒前";
 }elseif( $dTime < 3600 ){
  $dTime =  intval($dTime/60)."分钟前";
 }elseif( $dTime >= 3600 && $dDay == 0  ){
  $dTime =  "今天".date("H:i",$sTime);
 }elseif($dYear==0){
  $dTime =  date("m-d H:i",$sTime);
 }else{
  $dTime =  date("Y-m-d H:i",$sTime);
 }
 return $dTime;
}
