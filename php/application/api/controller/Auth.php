<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\View;
use think\Session;
use think\Db;
use think\Route;
use think\Loader;
define("TOKEN","linxcABCDEFGHIJGJJ");
define("Appid","wx3edf97fba911c055");
define("AppSecret","069f867e0970e0d563abbbe80b84ffc3");
 

class Auth extends Init
{
    public function getcodeid()
    {
        return 'json';
    }

  //公共方法
    // 无分页查询列表
  public function com_list()
      {     
 
      if(!input('codeid')){return rejson(0,'参数错误');} 
      //对codeid进行解析； 
      $arr = explain_codeid(input('codeid'));  
      $tbn=$arr['tbn'];
      $where = array();

      $where = dealwhere(input('post.'));
      $order = dealorder(input('post.orderstrid'));
      
         //各表不同，关键字对应字段不同，走配置化
      if(input('keyword')){
         $keyword= $arr['kws']==''?'keyword':$arr['kws'];
        $where[$keyword] = ['like','%'.input('keyword').'%'];
      } 
     if(input('diarytype')){
        $where['diarytype'] = ['=',input('diarytype')];
      } 

      //调用模型层接口
      $data = get_datalist($arr['tbn'],$where,'',input('top'),$order);

 
      //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
      $datalist = set_codeid($data,$arr['num']); 
        if(count($datalist)>0){ 
           return rejson(1,'查询成功',$datalist,$arr);
        }else{
        return rejson(0,'查询失败',[],$arr);   
        } 
      }
  
  // 有分页查询列表 
  public function com_list_page()
      {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 

        $tbn = $arr['tbn']; 
        $where = array();

        $where = dealwhere(input('post.'));
        $order = dealorder(input('post.orderstrid'));

           //各表不同，关键字对应字段不同，走配置化
        if(input('keyword')){
           $keyword= $arr['kws']==''?'keyword':$arr['kws'];
          $where[$keyword] = ['like','%'.input('keyword').'%'];
        }
  
          
        $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);

   
        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['datalist'=>[],'total'=>0],$arr); 
        }  
      }
  
  // 无分页查询列表
  public function com_detail()
      {
      if(!input('codeid')){return rejson(0,'参数错误');} 
      //对codeid进行解析； 
      $arr = explain_codeid(input('codeid')); 
         
      $tbn = $arr['tbn']; 
      $where[$arr['id']]=['=',$arr['idv']];
  
      //调用模型层接口
      $data = get_data($tbn,$where); 
       
        if($data>0){
         //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
         $datav = set_codeid([$data],$arr['num']); 

           return rejson(1,'查询成功',$datav[0],$arr);
        }else{
        return rejson(0,'查询失败',[],$arr);   
        } 
      }    
  

  // 含用户信息的详情
  public function com_artdetail()
      {
      if(!input('codeid')){return rejson(0,'参数错误');} 
      //对codeid进行解析； 
      $arr = explain_codeid(input('codeid')); 
      $tbn = $arr['tbn']; 
      $where[$arr['id']]=['=',$arr['idv']];
       //  return json($arr);
      //调用模型层接口
      $data = get_data($tbn,$where);  
       
        if($data>0){
          //查询用户信息         
           $uwhere['id'] = ['=',$data['uid']];
           $field = 'nickname,headimg,city,usertype';
         $arr2 = get_data('user',$uwhere,$field);   
         if($arr){
          $data =  array_merge($data,$arr2);
         } 
        //对数据进行处理
        if($tbn=='comment'||$tbn=='module_news'){
         $data=data_handle($data,user_auth()['id'],$tbn);
      }

         //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
         $datav = set_codeid([$data],$arr['num']);  
           return rejson(1,'查询成功',$datav[0],$arr);
        }else{
        return rejson(0,'查询失败',[],$arr);   
        } 
      }    
  


 /** 
 *宇杉公共方法——获取文章，以及头像公共接口
 * @param    {codeid:"asdfdsd"}  
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
    public function com_artlist()
    {
    if(!input('codeid')){return rejson(0,'参数错误');} 
    //对codeid进行解析； 
    $arr = explain_codeid(input('codeid')); 
    // p($arr); 
    $where = array();
    $tbn=$arr['tbn'];

      $where = dealwhere(input('post.'));
      $order = dealorder(input('post.orderstrid'));

   //各表不同，关键字对应字段不同，走配置化
if(input('keyword')){
   $keyword= $arr['kws']==''?'keyword':$arr['kws'];
  $where[$keyword] = ['like','%'.input('keyword').'%'];
}

    //调用模型层接口
    $data = get_datalist($arr['tbn'],$where,'',input('top'),$order); 

    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
    $data = set_codeid($data,$arr['num']); 
//查询对应的用户
  $uids = getids($data,'uid'); 
  $uwhere['id'] = ['in',$uids];
  $field = 'nickname,id,headimg,city,usertype';
  $arr2 = get_datalist('user',$uwhere,$field); 
  $data = jointwoarr($data,$arr2,'uid','id');

    

      if(count($data)>0){ 
         return rejson(1,'查询成功',$data,$arr);
      }else{
      return rejson(0,'查询失败',[],$arr);   
      }  
    }

 
  // 有分页查询列表 
  public function com_artlist_page()
      {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 
        $tbn = $arr['tbn'];  
        $where = array();

        $where = dealwhere(input('post.'));
        $order = dealorder(input('post.orderstrid'));

           //各表不同，关键字对应字段不同，走配置化
        if(input('keyword')){
           $keyword= $arr['kws']==''?'keyword':$arr['kws'];
          $where[$keyword] = ['like','%'.input('keyword').'%'];
        }

        $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);

        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);  
        //查询对应的用户
          $uids = getids($data['datalist'],'uid'); 
          $uwhere['id'] = ['in',$uids];
          $field = 'nickname,id,headimg,city,usertype';
          $arr2 = get_datalist('user',$uwhere,$field); 
          $data['datalist'] = jointwoarr($data['datalist'],$arr2,'uid','id');




        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['datalist'=>[],'total'=>0],$arr); 
        }  
      }




// 公共删除方法；

/** 
 *宇杉公共方法——删  增c、删d、改u、查r 
 * @param    {codeid:"asdfdsd"}  
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
public function com_delete()
    { 
      if(!input('codeid')){return rejson(0,'参数错误');} 
      $codeid=explode(",",input('codeid'));
      $str=['tbn'=>'','id'=>'','idv'=>[]];
      foreach ($codeid as $key => $value) { 
        $str = explain_codeid($value);
        $arr['tbn'] = $str['tbn'];
        $arr['id']=$str['id'];
        $arr['idv'][]=$str['idv'];
      }   
      //调用模型层——删除表中记录
      $del = delete_data($arr['tbn'],$arr['id'],$arr['idv']); 
      if($del){
        return rejson(1,'删除成功！',[],$arr); 
      }else{
        return rejson(0,'删除失败！',[],$arr); 
      } 
}


    //公共方法
    // 无分页查询列表
	public function mycom_list()
	    { 

 
	    if(!input('codeid')){return rejson(0,'参数错误');} 
	    //对codeid进行解析； 
	    $arr = explain_codeid(input('codeid'));
      $tbn=$arr['tbn'];
	    $where = array();

      $where = dealwhere(input('post.'));
      $order = dealorder(input('post.orderstrid'));

      $where['uid']=get_uid($_GET['token']);
	       //各表不同，关键字对应字段不同，走配置化
			if(input('keyword')){
				 $keyword= $arr['kws']==''?'keyword':$arr['kws'];
				$where[$keyword] = ['like','%'.input('keyword').'%'];
			}

	
	    //调用模型层接口
	    $data = get_datalist($arr['tbn'],$where,'',input('top'),$order);
      if($arr['tbn']=='linkuser'){
          foreach ($data as $key => $value) {
              $data[$key]['namesort'] = getFirstChar($value['name']); 
          }
          $sort=array('direction'=>'SORT_ASC','field'=>'namesort');
          $arr2=array();
          foreach ($data as $uniqid => $value) {
              foreach ($value as $key => $val) {
                  $arr2[$key][$uniqid]=$val;
              }
          }
          if($sort['direction']){
              array_multisort($arr2[$sort['field']],constant($sort['direction']),$data);
          }
      }
	    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
	    $datalist = set_codeid($data,$arr['num']); 
	      if(count($datalist)>0){ 
	         return rejson(1,'查询成功',$datalist,$arr);
	      }else{
	      return rejson(0,'查询失败',[],$arr); 	
	      } 
	    }
	
// 有分页查询列表 
public function mycom_list_page()
    {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
        //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 
        $tbn = $arr['tbn']; 
        $where = array();
        $where = dealwhere(input('post.'));
        $order = dealorder(input('post.orderstrid'));
        //各表不同，关键字对应字段不同，走配置化
        if(input('keyword')){
            $keyword= $arr['kws']==''?'keyword':$arr['kws'];
            $where[$keyword] = ['like','%'.input('keyword').'%'];
        }
        if(input('diarystyle')){
            $where['diarystyle'] = ['=',input('diarystyle')];
        }
        if(input('begintime')&&!input('endtime')){
            $where['createtime'] = ['>',strtotime(input('begintime'))];
        }
        if(!input('begintime')&&input('endtime')){
            $where['createtime'] = ['<',strtotime(input('endtime'))];
        }
        if(input('begintime')&&input('endtime')){
            $where['createtime'] = [['>',strtotime(input('begintime'))],['<',strtotime(input('endtime'))],'and'];
        }
        $where['uid']=get_uid($_GET['token']);
        $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);
        //对结果进行加密主键id为codeid；
        $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
            return rejson(1,'查询成功',$data,$arr);
        }else{
            return rejson(0,'查询失败',['datalist'=>[],'total'=>0,'pages'=>0],$arr); 
        }  
    }
	
	// 无分页查询列表
	public function mycom_detail()
	    {
	    if(!input('codeid')){return rejson(0,'参数错误');} 
	    //对codeid进行解析； 
	    $arr = explain_codeid(input('codeid')); 
         
	    $tbn = $arr['tbn']; 
	    //$where[$arr['id']]=['=',$arr['idv']];
	    $where['uid']=get_uid($_GET['token']);
	    //调用模型层接口
	    $data = get_data($tbn,$where);
	     
	      if($data>0){
	       //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
	       $datav = set_codeid([$data],$arr['num']); 

	         return rejson(1,'查询成功',$datav[0],$arr);
	      }else{
	      return rejson(0,'查询失败',[],$arr); 	
	      } 
	    }    
	
	


// 公共删除方法；

/** 
 *宇杉公共方法——删  增c、删d、改u、查r 
 * @param    {codeid:"asdfdsd"}  
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
public function mycom_delete()
    { 
      if(!input('codeid')){return rejson(0,'参数错误');} 
      $codeid=explode(",",input('codeid'));
      $str=['tbn'=>'','id'=>'','idv'=>[]];
      foreach ($codeid as $key => $value) { 
        $str = explain_codeid($value);
        $arr['tbn'] = $str['tbn'];
        $arr['id']=$str['id'];
        $arr['idv'][]=$str['idv'];
      }   
      //调用模型层——删除表中记录
      $del = delete_data($arr['tbn'],$arr['id'],$arr['idv']); 
      if($del){
        return rejson(1,'删除成功！',$del,$arr); 
      }else{
        return rejson(0,'删除失败！',[],$arr); 
      } 
}






public function mycom_editadd()
{
    if(!input('codeid')){return rejson(0,'参数错误');}  
    $p = input('post.');
    if(count($p)==0){return rejson(0,'参数不齐全');} 
    //$p['createtime'] = time(); 
    $arr = explain_codeid(input('codeid'));
    //return json($arr); 
    if($arr['idv']){
        //id值为不为空，这里是编辑更新
        $content= real_data($p,$arr);
        unset($content['data']['createtime']);
        $content['data']=editaddtime_format($content['data']);
        $content['data']['uid']=get_uid($_GET['token']);
        $content['data']['updatetime'] =time();
        // return json($content);
        $where[$arr['id']]=['=',$arr['idv']];
        $re = update_one($arr['tbn'],$where,$content['data']); 
    }else{
        //id值为空，这里是插入
        $content = real_data_noid($p,$arr);
        $content['data']['createtime']=time(); 
        $content['data']=editaddtime_format($content['data']);
        $content['data']['uid']=get_uid($_GET['token']);
        $re = insert_data($arr['tbn'],$content['data']);    
    } 
    if($re){
        return rejson(1,'提交成功！',$re,$arr); 
    }else{
        return rejson(0,'提交失败！',[],$arr); 
    } 
}

public function com_editadd(){
    if(!input('codeid')){return rejson(0,'参数错误');}  
    $p = input('post.');
    if(count($p)==1){return rejson(0,'参数不齐全');} 
    //$p['createtime'] = time(); 
    $arr = explain_codeid(input('codeid'));
    //return json($arr); 
    if($arr['idv']){
    //id值为不为空，这里是编辑更新

    $content= real_data($p,$arr);
    unset($content['data']['createtime']);
    $content['data']=editaddtime_format($content['data']);
    $content['data']['updatetime'] =time();
    // return json($content);
       $where[$arr['id']]=['=',$arr['idv']]; 
       $re = update_one($arr['tbn'],$where,$content['data']); 
  }else{
    //id值为空，这里是插入
     $content = real_data_noid($p,$arr);
     $content['data']['createtime']=time(); 
     $content['data']=editaddtime_format($content['data']);
      $re = insert_data($arr['tbn'],$content['data']);   
      if($arr['tbn']=='dict'){
        $re2=array();
        $where['c_id']=$re;
        $re2 = get_data($arr['tbn'],$where);
        $re2['codeid'] = jiami('5'.'*'.$re);
        if($re2){
          return rejson(1,'提交成功！',$re2,$arr); 
          }else{
              return rejson(0,'提交失败！',[],$arr); 
          } 
      }
  } 
  if($re){
    return rejson(1,'提交成功！',$re,$arr); 
    }else{
        return rejson(0,'提交失败！',[],$arr); 
    } 
}

/** 
 *日记更新多条单字段记录
 * @param    {codeid:"asdfdsd"}  
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
public function diary_editadd()
    { 
      if(!input('codeid')){return rejson(0,'参数错误');} 
      $codeid=explode(",",input('codeid'));
      $post=input('post.')['diarystyle'];
      $str=['tbn'=>'','id'=>'','idv'=>[]];
      foreach ($codeid as $key => $value) { 
        $str = explain_codeid($value);
        $arr['tbn'] = $str['tbn'];
        $arr['id']=$str['id'];
        $arr['idv'][]=$str['idv'];
      }   
      //调用模型层——改变表中记录
      
      Db::name($arr['tbn'])->where($arr['id'],'in',$arr['idv'])->setField('updatetime',time());
      $update = update_more($arr['tbn'],$arr['id'],$arr['idv'],'diarystyle',$post); 
      if($update){
        return rejson(1,'修改成功！',[],$arr); 
      }else{
        return rejson(0,'修改失败！',[],$arr); 
      } 
}
// 获取推荐牛人列表
  public function get_recommend_list()
  {
    $uid=get_uid($_GET['token']);
    if(!input('codeid'))return rejson('0','参数设置错误');

    $curPage = input('curPage') ? input('curPage') : 1;
    $listnum = input('listnum') ? input('listnum') : 10;
    //对codeid 进行解密；
    $arr = explain_codeid(input('codeid'));
    $tbn = $arr['tbn'];
     // $where = dealwhere(input('post.'));
      $order = dealorder(input('post.orderstrid'));



    //先查该用户发布的最新职位
    $w['uid']=$uid;
    $field='id,jobs_name';
    $jobsorder=dealorder(1);
    $jobs=get_datalist('jobs',$w,$field,$jobsorder);
    if(!$jobs)return rejson('0','该用户未发布职位');
    $where='isdel=0 and (intention_jobs like ';
    // foreach ($jobs as $key => $value) {
    //   $jobsarr[]=$value['jobs_name'];
    //   $where.="'%".$value['jobs_name']."%' or ";
    // }
    for ($i=0; $i <count($jobs) ; $i++) { 
      $jobsarr[]=$jobs[$i]['jobs_name'];
      if($i==(count($jobs)-1)){

        $where.="'%".$jobs[$i]['jobs_name']."%')";
        break;
      }
      $where.="'%".$jobs[$i]['jobs_name']."%' or ";
    }

 
    if(input('jobs_name'))$regexp=input('jobs_name');
    $where='intention_jobs regexp \''.$regexp.'\'';
    $order='updatetime desc';

    if (input('keyword')) {
      //$keyword = $arr['kws'] == '' ? 'keyword' : $arr['kws'];
      $where = $where.'and intention_jobs regexp \''. input('keyword') .'\'';
    }

    if(input('salary')){
      $where=$where.'and wage = \''.input('salary').'\'';
    }

    if(input('experience')){
      $where=$where.'and experience = \''.input('experience').'\'';
    }

    // if(input('jobs_name')){
    //   $where=$where.'and intention_jobs regexp \''.input('jobs_name').'\'';
    // }


    $total = Db::name($tbn)->where($where)->count();
    $pages = ceil($total/$listnum);
    $ddata=Db::name($tbn)->where($where)->page($curPage)->limit($listnum)->order($order)->select();
    $data = array('pages'=>$pages,'datalist'=>$ddata,'total'=>$total);


    //$data = get_datalist_page($tbn, $where, $curPage, $listnum,$order);return json($data['datalist']);

    if($data['datalist']){
      foreach ($data['datalist'] as $key => &$value) {
        if($value['uid']>$uid){
          $chatuser=$uid.",".$value['uid'];
        }else{
          $chatuser=$value['uid'].",".$uid;
        }
        $chatwhere['chatuser']=$chatuser;
        $chatlog=Db::name('chatlog')->where($chatwhere)->find();
        $value['ischat']=$chatlog?1:0;

        if($value['createtime']){
          $value['timestr']=time_handle($value['createtime']);
        }
      }
    }


    //对结果进行加密主键id为codeid；
    $data['datalist'] = set_codeid($data['datalist'], $arr['num']);
//查询对应的用户
    $uids = getids($data['datalist'], 'uid');
    if(!$uids)return rejson('0','无数据');
    $uwhere['id'] = ['in', $uids];
    $field = 'nickname,id,headimg';
    $arr2 = get_datalist('admin_user', $uwhere, $field);
    if(!$arr2){return rejson('0','该用户不存在');} 
    $data['datalist'] = jointwoarr($data['datalist'], $arr2, 'uid', 'id');


    if (count($data['datalist']) > 0) {
      return rejson(1, '查询成功', $data, $arr);
    } else {
      return rejson(0, '查询失败', ['datalist' => [], 'total' => 0]);
    }
  }



public function company_editadd()
    {
     if(!input('codeid')){return rejson(0,'参数错误');}  
    $p = input('post.');
  if(count($p)==0){return rejson(0,'参数不齐全');} 
  //$p['createtime'] = time(); 
    $arr = explain_codeid(input('codeid'));

    //return json($arr); 
  if($arr['idv']){
    //id值为不为空，这里是编辑更新
    $content= real_data($p,$arr);
    if($arr['tbn']=='jobs_company'){

      $content['data']['certification']=3;
      if(isset($content['data']['company_envirarr'])){
        $content['data']['company_envir']=implode(',',$content['data']['company_envirarr']);
      }
    }
    if($p['xinxi']==1){
      $content['data']['certification']=1;
    }
    unset($content['data']['createtime']);
    $content['data']['updatetime'] =time();
    // return json($content);
       $where[$arr['id']]=['=',$arr['idv']];
       $re = update_one($arr['tbn'],$where,$content['data']); 
  }else{
    //id值为空，这里是插入
     $content = real_data_noid($p,$arr);
     $content['data']['uid']=get_uid($_GET['token']);
    if($arr['tbn']=='jobs_company'){
      $content['data']['certification']=3;
    }
     $content['data']['createtime']=time(); 
      $re = insert_data($arr['tbn'],$content['data']);    
  } 
  if($re){
    return rejson(1,'提交成功！',$re,$arr); 
    }else{
        return rejson(0,'提交失败！',[],$arr); 
    } 
}






public function company_change(){
  $uid=get_uid($_GET['token']);
  if(!input('companyid'))return rejson('0','companyid未设置');
  $r1=delete_data('jobs_company','id',input('companyid'));

  $r2=delete_data('jobs','uid',$uid);
  if($r1&&$r2){
    return rejson('1','数据清除成功');
  }else{
    return rejson('0','数据清除失败');
  }
}









































/**
 *栏目树形结构
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function catetree(){ 
			
			 
 if(!input('codeid')){return rejson(0,'参数错误');} 
 		  //对codeid 进行解密；
	      $arr = explain_codeid(input('codeid')); 
	      $tbn = $arr['tbn'];  
      
		 $data = get_datalist('category');

 		 //对结果进行加密主键id为codeid；
	     $list = set_codeid($data,$arr['num']);	
			foreach ($list as $key => $value) { 
				if($value['pid']==0){
					$arr[] = $value;
				} 


			} 

			foreach ($arr as $key => &$value) { 
				$value['chllist'] = [];
				foreach ($list as $k => $val) {
					if($value['id']==$val['pid']){
						$value['chllist'][] = $val;
					}   
				} 
				 
						foreach ($value['chllist'] as $key => &$v) { 
									$v['chllist'] = [];	
									foreach ($list as $k => $va) {
										if($v['id']==$va['pid']){
											$v['chllist'][] = $va;
										}  
									} 
								}  
				 

			

			} 
	 
	return rejson(1,'查询成功',$arr);
}

/**
 *菜单查询列表或者一条
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menutree_select(){   
     

      $sort = 'listorder asc';
      $list = get_datalist('system_menu','','','',$sort);
      $arr = [];
      foreach ($list as $key => $value) { 
        if($value['pid']==0){
          $arr[] = $value;
        } 
      }


      foreach ($arr as $key => &$value) { 
        foreach ($list as $k => $val) {
          if($value['id']==$val['pid']){
            $value['chllist'][] = $val;
          }  
        } 

        foreach ($value['chllist'] as $key => &$v) { 
        foreach ($list as $k => $va) {
          if($v['id']==$va['pid']){
            $v['chllist'][] = $va;
          }  
        } 
      }     

         


      } 
   
  return rejson(1,'查询成功',$arr,set_comview_admin());
}

/**
 *首页接口 
 * @return   arr
 * @author  wyl  
 */
  public function base_select(){  
 
    $arr = [
    'version'=>'1.0',
    'huanjing'=>'',
    'system'=>'',
    'thinkver'=>'5.0.5',
    'phpver'=>'5.6',
    'msqlver'=>'5.5',
    'upload'=>'10M',


    'sitename'=>'YSframe',
    'team'=>'宇杉团队',
    'www'=>'www.ysframe.com',
    'address'=>'深圳市宝安区45区华丰裕安商务大厦',
    'qq'=>'181984609',
    'qun'=>'',
    'us'=>'0755-23011786'
    ];
    return rejson(1,'',$arr);
  }





/**
 *站点设置
 * @return   arr
 * @author  wyl  
 */
  public function website_select(){  
    
    $arr = get_datalist('system_setting'); 
    $re = array(); 
    foreach ($arr as $key => $value) {
      $re[$value['name']] = $value['value'];
    }
    return rejson(1,'',$re);
  }


/**
 *站点设置更新
 * @return   arr
 * @author  wyl  
 */
  public function website_update(){
  $arr = input('post.');  
    foreach ($arr as $key => $value) {
      $where['name'] = ['=',$key]; 
      $content = ['value'=>$value];
      update_one('system_setting',$where,$content); 
    }
    return rejson(1,'更新成功！');
  }


/**
 *数据库备份创建
 * @return   arr
 * @author  wyl  
 */
  public function database(){   
       $type=input("tp");
       $name=input("name");
       $sql=new \org\Baksql(config("database"));
       switch ($type)
        {
        case "backup": //备份
         $r = $sql->backup();
         if($r['code']==1){
          $data = ['createtime'=>time(),'name'=>$r['name']];
          insert_data('dbbase',$data);
          return rejson(1,$r['msg']);
         }else{
           return rejson(0,$r['msg']);
         }
         
          break;  
        case "dowonload": //下载
          $sql->downloadFile($name);
          break;  
        case "restore": //还原
          $re = $sql->restore($name);
          return rejson($re['code'],$re['msg']);
          break; 
        case "del": //删除
          $re = $sql->delfilename($name);
          return rejson($re['code'],$re['msg']);
          break;          
        default: //获取备份文件列表
            $data = $sql->get_filelist();
            return rejson(1,'数据库列表',$data);
          
        }
        
    }


/**
 *菜单增加
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menu_insert(){   
   
  return rejson(1,'插入成功',$data);
}

/**
 *菜单删除
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menu_del(){ 
  if(!input('id')){return rejson(0,'参数错误');}
  $ids = input('id');
  $arr = explode(',',$ids); 
  //查找下面是否有子栏目
  $v = 0;
  foreach ($arr as $key => $value) {
    $where['isdel'] = ['=','0']; 
    $where['pid'] = ['=',$value];
    $checkhasson = get_data('system_menu',$where); 
    if($checkhasson){$v++;}
   } 
   if($v>0){return rejson(0,'请先删除子栏目');}
  $re = delete_data('system_menu','id',$arr);
  $code = $re?1:0; 
  $msg = $re?'菜单删除成功':'菜单删除失败';
  return rejson($code,$msg);
}



/**
 *菜单修改更新
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menu_update(){ 
  if(!input('id')){return rejson(0,'参数错误');}
   
  $msg = $re?'菜单更新成功':'菜单更新失败';
  return rejson($code,$msg);
}



/**
 *菜单查询列表或者一条
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menu_select(){  
    if(input('id')){
      $where['id']=['=',input('id')];
      $data = get_data('system_menu',$where);
    }else{
      $sort = 'listorder asc';
      $list = get_datalist('system_menu',[],'','',$sort);
      foreach ($list as $key => &$value) {
        $value['namestr'] = $value['name'];
        $value['namelip'] = $value['name'];
      }
      $data = array();
        foreach ($list as $key => &$value) {
            if($value['pid']==0){
                $data[] = $value;
                $value['hasc'] = 0;
                $value['cststr'] = '';
                $value['cstlip'] = '';
                $data = getSons($value,$list,$data);
            } 
        } 
    } 
    $data = set_codeid($data,48);
  return rejson(1,'查询成功',$data);
}







/**
 *插入数据库表格
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function dbtable_insert(){ 
    $tbn = 'ys_module_'.input('tbname');
    if(tableexist($tbn)){ 
          $msg = '数据表'.input('tbname').'已存在';
          return rejson(0,$msg); 
      }
  $default_values = config('default_values'); 
  $createTableSql=createAddTableSql($tbn, $default_values,input('tbdesc')); 
  $re = Db::query($createTableSql); 
  return rejson(1,'数据表'.$tbn.'创建成功',$re);

}

/**
 *删除数据表
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function dbtable_del(){ 
   if(input('type')=='drop'){
        $re = Db::query('DROP TABLE IF EXISTS `'.input('name').'`;');
      return rejson(1,'删除成功',$re);
   }else if(input('type')=='clean'){
      $re = Db::query('TRUNCATE TABLE '.input('name').';');
      return rejson(1,'清除成功',$re);   
   }else{
    return rejson(0,'操作失败');  
   }

}

/**
 *查询数据库表格
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function dbtable_select(){ 
     $list  = Db::query('SHOW TABLE STATUS');
         $list  = array_map('array_change_key_case', $list);
         foreach ($list as $key => &$value) {
          $value['data_length'] = format_bytes($value['data_length']); 
         }
  return rejson(1,'查询成功',$list);
}


/**
 *插入数据库表字段
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function char_insert(){
  //表名
  //字段名
  //长度
  //备注
$arr = [
  'input'=>'varchar(255)',
  'textarea'=>'text',
  'cleareditor'=>'text',
  'editor'=>'text',
  'radio'=>'tinyint(1)',
  'checkbox'=>'varchar(255)',
  'select'=>'varchar(255)',
  'datetime'=>'int(10)',
  'input'=>'varchar(255)',
];

if(!input('type')){return rejson(0,'字段类型不能为空');}
if(!input('tbname')){return rejson(0,'表名不能为空');}
if(!input('Field')){return rejson(0,'字段名不能为空');} 
if(!input('Comment')){return rejson(0,'备注不能为空');}

if(input('Default')){
  $def = 'Default '.input('Default');
}else{
  $def = 'not null';  
}

  $re = Db::query('alter table  `'.input('tbname').'` add `'.input('Field').'` '.$arr[input('type')].' '.$def.' comment "'.input('Comment').'"');
  return rejson(1,'操作成功',$re);
}

/**
 *删除数据库表字段
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function char_del(){ 
  $re = Db::query('alter table '.input('tbname').' drop column '.input('Field'));
  return rejson(1,'查询成功',$re);
}

/**
 *查询数据库表格
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function char_select(){ 
  $re = Db::query('show full fields  from '.input('name'));
  return rejson(1,'查询成功',$re);
}






 

/**
 *导航栏目删除
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function nav_del(){ 
	if(!input('id')){return rejson(0,'参数错误');}
	$ids = input('id');
	$arr = explode(',',$ids); 
	//查找下面是否有子栏目
	$v = 0;
	foreach ($arr as $key => $value) {
		$where['isdel'] = ['=','0']; 
		$where['pid'] = ['=',$value];
	 	$checkhasson = get_data('category',$where); 
	 	if($checkhasson){$v++;}
	 } 
	 if($v>0){return rejson(0,'请先删除子栏目');}
	$re = delete_data('category','id',$arr);
	$code = $re?1:0; 
	$msg = $re?'菜单删除成功':'菜单删除失败';
	return rejson($code,$msg);
}


 


/**
 *导航栏目查询列表或者一条
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function nav_select(){  
		if(input('id')){
			$where['id']=['=',input('id')];
			$data = get_data('category',$where);
		}else{ 
			$sort = 'listorder asc'; 
			$list = get_datalist('category',[],'','',$sort);
			foreach ($list as $key => &$value) {
				$value['namestr'] = $value['name'];
				$value['namelip'] = $value['name'];
			}
			 
			$data = array();
		    foreach ($list as $key => &$value) { 
		        if($value['pid']==0){
		            $data[] = $value;
		            $value['hasc'] = 0;

		            $value['cststr'] = '';
		            $value['cstlip'] = '';
		            $data = getSons($value,$list,$data);
		        }
		    } 
		} 
		$data = set_codeid($data,5); 
	return rejson(1,'查询成功',$data);
}


// 省市列表
public function city_select()
    {  
      $arr = explain_codeid(input('codeid')); 
      $where = '';
      if(input('pid')){
        $where['pid']=input('pid');
      }
      $data = get_datalist('city',$where);
      $data = set_codeid($data,$arr['num']);
      if(count($data)>0){
         return rejson(1,'查询成功',$data,$arr);
      }else{
         return rejson(0,'查询失败'); 
    }  
}


  //子项目
    public function son_program()
      {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 
        $tbn = $arr['tbn']; 
        $where = '';
           //各表不同，关键字对应字段不同，走配置化
        if(input('id')){
          $where['prid']=input('id');
        }
          
        $data = get_datalist_page($tbn,$where,$curPage,$listnum);

      //对数据进行处理
       if($tbn=='comment'||$tbn=='module_news'){
        $data['datalist']=datas_handle($data['datalist'],user_auth()['id'],$tbn);
      }

        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['datalist'=>[],'total'=>0]); 
        }  
      }



    //部位列表
    public function part_select()
      {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 
        $tbn = $arr['tbn']; 
        $where = '';
           //各表不同，关键字对应字段不同，走配置化
        if(input('id')){
          $where['fid']=input('id');
        }
          
        $data = get_datalist_page($tbn,$where,$curPage,$listnum);

      //对数据进行处理
       if($tbn=='comment'||$tbn=='module_news'){
        $data['datalist']=datas_handle($data['datalist'],user_auth()['id'],$tbn);
      }

        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['datalist'=>[],'total'=>0]); 
        }  
      }


      //分项列表
      public function son_part()
      {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 
        $tbn = $arr['tbn']; 
        $where = '';
           //各表不同，关键字对应字段不同，走配置化
        if(input('id')){
          $where['tfid']=input('id');
        }
          
        $data = get_datalist_page($tbn,$where,$curPage,$listnum);

      //对数据进行处理
       if($tbn=='comment'||$tbn=='module_news'){
        $data['datalist']=datas_handle($data['datalist'],user_auth()['id'],$tbn);
      }

        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['datalist'=>[],'total'=>0]); 
        }  
      }


//city--weather
//       public function degree_select()
//       {  
//         $curPage = input('curPage')?input('curPage'):1;
//         $listnum = input('listnum')?input('listnum'):10;  

//         if(input('pid')){
//             $where['pid']=input('pid');
//             $where['isdel']=['=','0'];
//             $field='cityid';
//             $data=get_datalist('city',$where,$field);
//             foreach ($data as $key => $value) {
//             $w['ctid']=$value['cityid'];
//             $w['isdel']=['=','0'];
//             $temp=Db::name('weather')->where($w)->order('lastupdate desc')->select();
//           }
//         }elseif(input('id')){
//           $where['ctid']=input('id');
//             $where['isdel']=['=','0'];
//             $temp=Db::name('weather')->where($where)->order('lastupdate desc')->select();
//         }
//       $result=fenye($temp,$listnum);
//       $where2['tbname']=['=','weather'];
//       $data2=get_data('system_conf',$where2);
//       $num=$data2['tbnum'];
//       $re['pages']=ceil(count($temp)/$listnum);
//       $re['datalist']=set_codeid($result[$curPage-1],$num);
//       $re['total']=count($temp);
//         if($re){
//            return rejson(1,'查询成功',$re);
//         }else{
//            return rejson(0,'查询失败',['datalist'=>[],'total'=>0]); 
//         }  
//       }






      

// //建筑圈评论
//       public function get_comment_list(){
//         $curPage = input('curPage')?input('curPage'):1;
//         $listnum = input('listnum')?input('listnum'):10; 
//         $data=get_datalist('relation_comment');
//         foreach ($data as $key => &$value) {
//           $value['ptitle']='';
//           if($value['articleid']){
//             $where['id']=$value['articleid'];
//             $field='title';
//             $d=get_data('relationship',$where,$field);
//             $value['ptitle']=$d['title'];
//           }

//           if($value['pid']){
//             $where['id']=$value['pid'];
//             $field='comment';
//             $d=get_data('relation_comment',$where,$field);
//             $value['ptitle']=$d['comment'];
//           }

//           $w['id']=$value['uid'];
//           $field='nickname,headimg';
//           $userinfo[]=get_data('user',$w,$field);
//           $value=array_merge($value,$userinfo[0]);
//         }
//         $result=fenye($data,$listnum);
//         $where2['tbname']=['=','relation_comment'];
//       $data2=get_data('system_conf',$where2);
//       $num=$data2['tbnum'];
//         $data['pages']=ceil(count($data)/$listnum);
//         $data['datalist']=set_codeid($result[$curPage-1],$num);
//         $data['total']=count($data);
//         if($data){
//           return rejson('1','查询成功',$data);
//         }else{
//           return rejson('0','查询失败',['datalist'=>[],'total'=>0]);
//         }
//       }
//       public function complain_select(){
//         $curPage = input('curPage')?input('curPage'):1;
//         $listnum = input('listnum')?input('listnum'):10;
//         $where['type']=input('type'); 
//         $data=get_datalist('prosecute',$where);
//         foreach ($data['datalist'] as $key => &$value) {
//           $w['id']=$value['uid'];
//           $field='nickname,headimg';
//           $userinfo[]=get_data('user',$w,$field);
//           $value=array_merge($value,$userinfo[0]);
//         }
//         $result=fenye($data,$listnum);
//          $where2['tbname']=['=','prosecute'];
//       $data2=get_data('system_conf',$where2);
//       $num=$data2['tbnum'];
//         $data['pages']=ceil(count($data)/$listnum);
//         $data['datalist']=set_codeid($result[$curPage-1],$num);
//         $data['total']=count($data);
//         if($data){
//           return rejson('1','查询成功',$data);
//         }else{
//           return rejson('0','查询失败',['datalist'=>[],'total'=>0]);
//         }
//       }




//城市温度
    public function degree_select()
    {  
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
        $arr = explain_codeid(input('codeid')); 
        if(!input('pid')&&!input('id')){
            return rejson(0,'查询失败',['datalist'=>[],'total'=>0,'pages'=>0]); 
        }
        if(!input('pid')&&input('id')){
            return rejson(0,'查询失败',['datalist'=>[],'total'=>0,'pages'=>0]); 
        }
        if(input('pid')){
            $where['pid']=input('pid');
            $where['isdel']=['=','0'];
            $field='cityid';
            $data=get_datalist('city',$where,$field);
            foreach ($data as $key => $value) {
                $w['ctid']=$value['cityid'];
                $w['isdel']=['=','0'];
                $ord=['lastupdate' => 'desc'];
                $temp=get_datalist_page('weather',$w,$curPage,$listnum,$ord);
            }
        }
        if(input('pid')&&input('id')){
            $temp='';
            $h['ctid']=input('id');
            $h['isdel']=['=','0'];
            $order=['lastupdate' => 'desc'];
            $temp=get_datalist_page('weather',$h,$curPage,$listnum,$order);
        }
        $temp['datalist'] = set_codeid($temp['datalist'],$arr['num']);
        if(count($temp['datalist'])>0){
            return rejson(1,'查询成功',$temp);
        }else{
            return rejson(1,'查询失败',['total'=>0,'datalist'=>[],'pages'=>0]); 
        }  
    }
//建筑圈评论
    public function get_comment_list(){
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10; 
        $arr = explain_codeid(input('codeid')); 
        $order=['createtime' => 'desc'];
        $data=get_datalist_page('relation_comment','',$curPage,$listnum,$order);
        foreach ($data['datalist'] as $key => &$value) {
            $value['ptitle']='';
            if($value['articleid']){
                $where['id']=$value['articleid'];
                $field='title';
                $d=get_data('relationship',$where,$field);
                $value['ptitle']=$d['title'];
            }
            if($value['pid']){
                $where['id']=$value['pid'];
                $field='content';
                $d=get_data('relation_comment',$where,$field);
                $value['ptitle']=$d['content'];
            }
            $w['id']=$value['uid'];
            $field='nickname,headimg';
            $userinfo[]=get_data('user',$w,$field);
            $value=array_merge($value,$userinfo[0]);
        }
        $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if($data){
            return rejson('1','查询成功',$data);
        }else{
            return rejson('0','查询失败',['datalist'=>[],'total'=>0,'pages'=>0]);
        }
    }
//投诉建议请按5
    public function complain_select(){
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;
        $arr = explain_codeid(input('codeid'));
        $where['type']=input('type');  
        $order=['createtime' => 'desc'];
        $data=get_datalist_page('prosecute',$where,$curPage,$listnum,$order);
        foreach ($data['datalist'] as $key => &$value) {
            $w['id']=$value['uid'];
            $field='nickname,headimg';
            $userinfo[]=get_data('user',$w,$field);
            $value=array_merge($value,$userinfo[0]);
        }
        $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if($data){
            return rejson('1','查询成功',$data);
        }else{
            return rejson('0','查询失败',['datalist'=>[],'total'=>0,'pages'=>0]);
        }
    }


// 温度抓取
public function weather_edit(){
    $arr = explain_codeid(input('codeid'));
    $where = '';
    $where['cityid']=input('cityid');
    $data = get_data('city',$where);
    $data['collecttime']=time();
    $update=update_one('city',$where,$data);
    $hot = nethtml($data['url']); 
    $div=$hot->find("div");  
    $ali=$div->find('li')->deal();
    for ($j=0; $j < count($ali); $j++) { 
        for ($k=0; $k < count($ali[$j]); $k++) { 
            $tmparray = strpos($ali[$j][$k],"查看今日天气详情"); 
            if ($tmparray) {
                for ($l=0; $l < count($ali[$j]); $l++) { 
                    $title = nettext($ali[$j][$l]); 
                    $ltem=explode("℃",$title)[0];//拿掉℃
                    $htem=explode("～",$ltem);//获取最高温度
                    $length=strlen($htem[0]);//获取剩余字符串的长度
                    $ltem=(double)(substr($htem[0],$length-2,$length));//获取最低温度并且转为double类型
                    $htem=(double)($htem[1]);//转换为double类型
                    $vtem=($htem+$ltem)/2;
                    $wdate=explode("(",$title)[0];//获取当前天气日期
                    $time = date('Y-m-d H:i:s',time());
                    $year=((int)substr($time,0,4));//取得年份
                    $month=((int)substr($wdate,1,3));//取得月份
                    $day=((int)substr($wdate,6,8));//取得几号
                    $wdate=mktime(0,0,0,$month,$day,$year);
                    $insert = array('wdate' => $wdate,'lastupdate'=>time(),'htem'=>$htem,'ltem'=>$ltem,'vtem'=>$vtem,'ctid'=>$data['cityid'],'city'=>$data['city']);
                    $where['wdate']=$wdate;
                    $re = Db::name('weather')->where('ctid','=',$data['cityid'])->where('wdate','=',$wdate)->find();
                    if(!$re){
                        $result = Db::name('weather')->insert($insert);
                    }else{
                        $result = Db::name('weather')->where('ctid','=',$data['cityid'])->where('wdate','=',$wdate)->update($insert);
                    }
                }
                for ($m=0; $m < count($ali[$j+1]); $m++) { 
                    $title2 = nettext($ali[$j+1][$m]); 
                    $ltem2=explode("℃",$title2)[0];//拿掉℃
                    $htem2=explode("～",$ltem2);//获取最高温度
                    $length2=strlen($htem2[0]);//获取剩余字符串的长度
                    $ltem2=(double)(substr($htem2[0],$length2-2,$length2));//获取最低温度并且转为double类型
                    $htem2=(double)($htem2[1]);//转换为double类型
                    $vtem2=($htem2+$ltem2)/2;
                    $wdate2=explode("(",$title2)[0];//获取当前天气日期
                    $month2=((int)substr($wdate2,1,3));//取得月份
                    $day2=((int)substr($wdate2,6,8));//取得几号
                    $wdate2=mktime(0,0,0,$month2,$day2,$year);
                    $insert2 = array('wdate' => $wdate2, 'lastupdate'=>time(),'htem'=>$htem2,'ltem'=>$ltem2,'vtem'=>$vtem2,'ctid'=>$data['cityid'],'city'=>$data['city']);
                    $where['wdate']=$wdate2;
                    $re = Db::name('weather')->where('ctid','=',$data['cityid'])->where('wdate','=',$wdate2)->find();
                    if(!$re){
                        $result = Db::name('weather')->insert($insert2);
                    }else{
                        $result = Db::name('weather')->where('ctid','=',$data['cityid'])->where('wdate','=',$wdate2)->update($insert2);
                    }
                }
            }              
        }      
    }   
}





public function get_jobs_select(){
  
    $uid=get_uid($_GET['token']);
    $tbn='jobs';
    $where['uid']=$uid;
    $field='jobs_name,id';
    //调用模型层接口
    $data = DB::name($tbn)->where($where)->field($field)->group('jobs_name')->select();
    // foreach ($data as $key => $value) {
    //   $jobs[]=$value['jobs_name'];
    // }


    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
      if(count($data)>0){ 
         return rejson(1,'查询成功',$data);
      }else{
      return rejson(0,'查询失败',[]);   
      } 
}



// 获取职位信息列表 
  public function job_list_page()
      {  
        if(!input('codeid'))return rejson('0','参数设置错误');
        $uid=get_uid($_GET['token']);
        $curPage = input('curPage')?input('curPage'):1;
        $listnum = input('listnum')?input('listnum'):10;  
       //对codeid 进行解密；
        $arr = explain_codeid(input('codeid')); 

        $tbn = $arr['tbn']; 
        $where = array();

        $where = dealwhere(input('post.'));
        $order = dealorder(input('post.orderstrid'));

           //各表不同，关键字对应字段不同，走配置化
        if(input('keyword')){
           $keyword= $arr['kws']==''?'keyword':$arr['kws'];
          $where[$keyword] = ['like','%'.input('keyword').'%'];
        }

      if(input('salary')){
        $where['wage']=['=',input('salary')];
      }

      if(input('experience')){
        $where['experience']=['=',input('experience')];
      }

      if(input('jobs_name')){
        $where['jobs_name']=['like',"%".input('jobs_name')."%"];
      }

      if(input('job_status')){
        $where['job_status']=['=',input('job_status')];
      }

  
        $where['uid']=$uid;
        $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);

        foreach ($data['datalist'] as $key => &$value) {
          //处理每个职位沟通过得人数
          $w['jobid']=$value['id'];
          $chatnum=DB::name('chatlog')->where($w)->group('chatuser')->count();
          $value['chatnum']=$chatnum;

          //处理每个职位的浏览人数
          if($value['viewids']){
            $viewarr=explode(',',$value['viewids']);
            $value['viewnum']=count($viewarr);
          }else{
            $value['viewnum']=0;
          }
          unset($value['viewids']);
          unset($value['uid']);
          
          if($value['newstime']){
            $value['onlineday']=ceil((time()-$value['newstime'])/86400);
          }
        }
   
        //对结果进行加密主键id为codeid；
       $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
        if(count($data['datalist'])>0){
           return rejson(1,'查询成功',$data,$arr);
        }else{
           return rejson(0,'查询失败',['page'=>0,'datalist'=>[],'total'=>0]); 
        }  
      }


//招聘者：获取看过我的用户列表
public function get_look_user(){
  $curPage = input('curPage')?input('curPage'):1;
  $listnum = input('listnum')?input('listnum'):10;  

  $uid=get_uid($_GET['token']);
  $temp=array();
  $where['uid']=$uid;

    if(input('experience')){
      $where['experience']=['=',input('experience')];
    }

    if($salary=input('salary')){
      $where['wage']=['=',input('salary')];
    }

    if(input('jobs_name')){
      $where['jobs_name']=['like',"%".input('jobs_name')."%"];
    }

  $field='id,viewids,companyname,jobs_name,company_addtime,nature_cn,category_cn,scale_cn,district_cn';
  $job=get_datalist('jobs',$where,$field);
  
  foreach ($job as $key => $value) {
    if($value['viewids']){
      $ids=explode(',',$value['viewids']);
      foreach ($ids as $k => $v) {
        $uw['id']=$v;
        $field='nickname,headimg';
        $user=get_data('admin_user',$uw,$field);
        if(!$user){return rejson('0','该用户不存在');} 
        //搜索期望职位
        if(input('keyword'))$rw['intention_jobs']=['like', '%' . input('keyword') . '%'];
        
        $rw['uid']=$v;
        $resume=get_data('resume',$rw);
        if($user&&$resume)
        $temp[]=array_merge($user,$resume);
      }
    }

  }



   if(!$temp){return rejson('0','无数据');}


foreach ($temp as $key => &$value) {
  if($value['uid']>$uid){
          $chatuser=$uid.",".$value['uid'];
        }else{
          $chatuser=$value['uid'].",".$uid;
        }
        $chatwhere['chatuser']=$chatuser;
        $chatlog=Db::name('chatlog')->where($chatwhere)->find();
        $value['ischat']=$chatlog?1:0;

        if($value['createtime']){
          $value['timestr']=time_handle($value['createtime']);
        }
}
        




      $result=fenye($temp,$listnum);
            
      if ($curPage>ceil(count($temp)/$listnum)) {
        return rejson('0','该页无数据,页数超出范围');
      }

      $re['pages']=ceil(count($temp)/$listnum);
      $re['datalist']=set_codeid($result[$curPage-1],28);
      $re['total']=count($temp);


  if($temp){
    return rejson('1','查询成功',$re);
  }else{
    return rejson('0','查询失败');
  }
}






//获取公司信息职位类型
public function get_jobtype(){
  $list=get_datalist('jobs_category');
  if(!$list)return rejson('1','无数据');
  $data = array();
  foreach ($list as $key => &$value) {
        $value['namestr'] = $value['categoryname'];
        $value['namelip'] = $value['categoryname'];
      }
      $data = array();
        foreach ($list as $key => &$value) {
            if($value['pid']==0){
                $data[] = $value;
                $value['hasc'] = 0;
                $value['cststr'] = '';
                $value['cstlip'] = '';
                $data = getSons($value,$list,$data);
            } 
        } 
  if($data){
    return rejson('1','查询成功',$data);
  }else{
    return rejson('0','查询失败');
  }

}




public function char_editadd()
    {
     if(!input('codeid')){return rejson(0,'参数错误');}  
    $p = input('post.');
  if(count($p)==1){return rejson(0,'参数不齐全');} 
  //$p['createtime'] = time(); 
    $arr = explain_codeid(input('codeid'));
    //return json($arr); 
  if($arr['idv']){
    //id值为不为空，这里是编辑更新

    $content= real_data($p,$arr);
    unset($content['data']['createtime']);
    $content['data']['updatetime'] =time();
    // return json($content);
       $where[$arr['id']]=['=',$arr['idv']]; 
       $re = update_one($arr['tbn'],$where,$content['data']); 
  }else{
    //id值为空，这里是插入
     $content = real_data_noid($p,$arr);
     $content['data']['createtime']=time();
     $content['data']['typecode']=create_salt();  
      $re = insert_data($arr['tbn'],$content['data']);    
  } 
  if($re){
    return rejson(1,'提交成功！'); 
    }else{
        return rejson(0,'提交失败！'); 
    } 
    }




    public function company_del(){
       if(!input('codeid')){return rejson(0,'参数错误');}  
       $p = input('post.');
       if(count($p)==0){return rejson(0,'参数不齐全');} 
       $arr = explain_codeid(input('codeid')); 
       $tbn = $arr['tbn']; 

      foreach ($p as $key => $value) {
        $data[$key]='';
      }
       $where[$arr['id']]=$arr['idv'];
       $re=update_one($tbn,$where,$data);

       if($re){
        return rejson('1','清空成功');
       }else{
        return rejson('0','清空失败');
       }
    }


 //文件图片上传    
public function formupload(){
    $uid=get_uid($_GET['token']);
    $rd = array('code'=>0,'msg'=>'fail','data'=>array());
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('file');
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'upload');
    if($info){
        $path = $info->getSaveName();

        $path = str_replace("\\","/",$path);
        $path="http://api.ysjianzhu.com/upload/".$path;
        $rd = array('code'=>1,'msg'=>'success','filename'=>$file->getinfo()['name'],'data'=>array('pathurl'=>$path));
    }
    $data['photo_img']=$path;
    $re=update_one('resume',['uid'=>$uid],$data);
    if(!$re)return rejson('0','数据库更新失败');
    return json($rd);
}


//简历上传    
public function resumeupload(){
    $uid=get_uid($_GET['token']);
    $data['uid']=$uid;
    $resume=get_data('resume',['uid'=>$uid],'id');
    if(!$resume)return rejson('0','简历不存在');
    $data['pid']=$resume['id'];
    $data['type']=5;
    $rd = array('code'=>0,'msg'=>'fail','data'=>array());
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('file');
    // 移动到框架应用根目录/public/uploads/ 目录下
    

    $info = $file->move(ROOT_PATH . 'upload');
    if($info){

        $path = $info->getSaveName();

        $path = str_replace("\\","/",$path);
        $rd = array('code'=>1,'msg'=>'success','filename'=>$file->getinfo()['name'],'data'=>array('pathurl'=>$path));

        $data['attachment']="http://api.ysjianzhu.com/upload/".$path;
        $data['attachmentname']=$file->getinfo()['name'];
  
        //如果已经存在简历附件，先删除后增加------更改
        $where['uid']=$uid;
        $where['type']=5;
        Db::name('resume_others')->where($where)->setField('isdel',1);

        $re=insert_data('resume_others',$data);
        if(!$re)return rejson('0','数据库插入失败');
    }
    return json($rd);
}




























/*-----------------------------------个人中心------------------------------------------*/



//获取个人资料
public function self_info(){
    $uid=get_uid($_GET['token']);
    $field='username,nickname,sex,job,city,phone,email,status,summary,headimg';
    $data=get_data('admin_user',['id'=>$uid],$field);
    if(!$data)return rejson('0','此用户不存在');
    //获取用户对应的日记说说信息
    $data1 = Db::name('article')->where('isdel','=',0)->where('format','=',1)->where('uid','=',$uid)->select();
    $data2 = Db::name('article')->where('isdel','=',0)->where('format','=',2)->where('uid','=',$uid)->select();
    $data3 = Db::name('photo')->where('isdel','=',0)->where('uid','=',$uid)->select();
    $data['diarynum']=$data1?count($data1):0;
    $data['saynum']=$data2?count($data2):0;
    $data['photonum']=$data3?count($data3):0;
    return rejson(1,'查询成功',$data);
}




//个人资料修改
public function self_info_update(){

    //获取要修改的数据
    $data=dealwhere(input('post.'));
    if(!$data)return rejson('0','参数设置错误');

    //if(isset($data['companyname'])){unset($data['companyname']);}
    $where['id']=get_uid($_GET['token']);

    $re=update_one('admin_user',$where,$data);
    if($re){
        return rejson('1','更新成功');
    }else{
        return rejson('0','数据未更改');
    }
}







// //获取我的收藏列表
// public function get_college_list(){
//     $curPage = input('curPage')?input('curPage'):1;
//     $listnum = input('listnum')?input('listnum'):10;  
//    //对codeid 进行解密；
//     $arr = explain_codeid(input('codeid')); 

//     $tbn = $arr['tbn']; 
//     $where = array();
//     $uid=get_uid($_GET['token']);

//     $where = dealwhere(input('post.'));
//     $order = dealorder(input('post.orderstrid'));
//     if($arr['tbn']=='interview'){
//       $where['to_id']=$uid;
//     }

//        //各表不同，关键字对应字段不同，走配置化
//     if(input('keyword')){
//        $keyword= $arr['kws']==''?'keyword':$arr['kws'];
//       $where[$keyword] = ['like','%'.input('keyword').'%'];
//     }

//     //  p($where);
//     $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);


//     //对结果进行加密主键id为codeid；
//    $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
//     if(count($data['datalist'])>0){
//        return rejson(1,'查询成功',$data,$arr);
//     }else{
//        return rejson(0,'查询失败',['datalist'=>[],'total'=>0],$arr); 
//     }  
// }



//获取回答列表
public function get_QandA_list(){
    $curPage = input('curPage')?input('curPage'):1;
    $listnum = input('listnum')?input('listnum'):10;  
   //对codeid 进行解密；
    $arr = explain_codeid(input('codeid')); 

    $tbn = $arr['tbn']; 
    $where = array();

    $where = dealwhere(input('post.'));
    $order = dealorder(input('post.orderstrid'));
    $where['uid']=get_uid($_GET['token']);
    $where['cateid']=93;

       //各表不同，关键字对应字段不同，走配置化
    if(input('keyword')){
       $keyword= $arr['kws']==''?'keyword':$arr['kws'];
      $where[$keyword] = ['like','%'.input('keyword').'%'];
    }

    if(input('type')){
      unset($where['type']);
      if(input('type')=='answer'){//拿回答列表
        $where['pid']=['exp','is not null'];
      }else{//拿问题列表
        $where['pid']=['exp','is null'];
      }
    }

    $data = get_datalist_page($tbn,$where,$curPage,$listnum,$order);

    if($data['datalist']){
      foreach ($data['datalist'] as $key => &$value) {
        $w['id']=$value['uid'];
        $user=get_data('admin_user',$w,'nickname,headimg');
        if(!$user)return rejson('0','用户不存在');
        $value['nickname']=$user['nickname'];
        $value['headimg']=$user['headimg'];
      }
    }


    //对结果进行加密主键id为codeid；
   $data['datalist'] = set_codeid($data['datalist'],$arr['num']);
    if(count($data['datalist'])>0){
       return rejson(1,'查询成功',$data,$arr);
    }else{
       return rejson(0,'查询失败',['datalist'=>[],'total'=>0],$arr); 
    }    
}





//获取收藏列表
public function get_college_list(){
  $curPage = input('curPage')?input('curPage'):1;
  $listnum = input('listnum')?input('listnum'):10; 
  $uid=get_uid($_GET['token']);

  $where=array();

  if(input('keyword')){
    $where['title'] = ['like','%'.input('keyword').'%'];
  }



  $d=get_datalist('relationship',$where);
  //if(!$d){return rejson('0','无收藏记录');}


  $temp=array();
  foreach ($d as $key => $value) {
    $ar=explode(',',$value['collegeUser']);
    if(in_array($uid, $ar)){
      $user=get_data('admin_user',['id'=>$value['uid']],'nickname,headimg');
      $value['nickname']=$user['nickname'];
      $value['headimg']=$user['headimg'];
      $temp[]=$value;
    }
  }


  $result=fenye($temp,$listnum);
            
  if ($curPage>ceil(count($temp)/$listnum)) {
    $re['pages']=0;
    $re['datalist']=[];
    $re['total']=0;
    return rejson('0','无数据',$re);
  }

  $re['pages']=ceil(count($temp)/$listnum);
  $re['datalist']=set_codeid($result[$curPage-1],104);
  $re['total']=count($temp);

  if($re){
    return rejson('1','查询成功',$re);
  }else{
    return rejson(0,'查询失败',$re);
  }
}






// 获取动态列表 
  public function get_qzlist()
  {
    $curPage = input('curPage') ? input('curPage') : 1;
    $listnum = input('listnum') ? input('listnum') : 10;
    //对codeid 进行解密；
    $arr = explain_codeid(input('codeid'));
    $tbn = $arr['tbn'];
      $where = dealwhere(input('post.'));
      $order = dealorder(input('post.orderstrid'));
    //各表不同，关键字对应字段不同，走配置化
    if (input('keyword')) {
      $keyword = $arr['kws'] == '' ? 'keyword' : $arr['kws'];
      $where[$keyword] = ['like', '%' . input('keyword') . '%'];
    }

    $uid=get_uid($_GET['token']);
    $where['uid']=$uid;
    
    $data = get_datalist_page($tbn, $where, $curPage, $listnum,$order);

    if(!$data['datalist']){return rejson('0','无数据',['datalist' => [], 'total' => 0],$arr);}

    foreach ($data['datalist'] as $key => $value) {
      if($value['topUser']){
        $arr2=explode(',',$value['topUser']);
        if(in_array($uid,$arr2)){
          $temp=$data['datalist'][$key];
          unset($data['datalist'][$key]);
          array_unshift($data['datalist'],$temp);
        }
      }
    }

    $data['datalist']= array_values($data['datalist']);


    //对结果进行加密主键id为codeid；
    $data['datalist'] = set_codeid($data['datalist'], $arr['num']);
//查询对应的用户
    $uids = getids($data['datalist'], 'uid');
    $uwhere['id'] = ['in', $uids];
    $field = 'nickname,id,headimg';
    $arr2 = get_datalist('admin_user', $uwhere, $field);
    if(!$arr2){return rejson('0','该用户不存在');} 
    $data['datalist'] = jointwoarr($data['datalist'], $arr2, 'uid', 'id');


    if (count($data['datalist']) > 0) {
      return rejson(1, '查询成功', $data, $arr);
    } else {
      return rejson(0, '查询失败', ['datalist' => [], 'total' => 0],$arr);
    }
  }





//置顶
  public function setToTop(){
    if(!input('id')){return rejson('0','id未设置');}
    $uid=get_uid($_GET['token']);
    $where['id']=input('id');   
    $data=get_data('relationship',$where,'topUser');

    $data['topUser']=$data['topUser'].','.$uid;


    $re=update_one('relationship',$where,$data);

    if($re){
      return rejson(1,'置顶成功');
    }else{
      return rejson(0,'置顶失败');
    }
  }




//收到的评论
  public function get_receive_com(){
    /*
      1.获取自己收到的所有评论（根据时间排序）(评论的评论、文章类的评论)（审核不通过的不获取）
        1-1.获取自己发出的所有评论、通过这些评论再找到收到的评论（id->pid）
        1-2.获取自己发出的所有文章类（建筑圈、需求、知识库）,通过这些文章再找到收到的评论（id->articleid）

      2.分类收到的评论：
        2-1.评论的评论  2-2.文章类的评论

      3.根据不同类的评论去获取父级的数据（标题、内容、时间、发表人、发表人头像）
      4.对不同类的评论进行加密set_codeid
     */
    $curPage = input('curPage') ? input('curPage') : 1;
    $listnum = input('listnum') ? input('listnum') : 10;    


    $uid=get_uid($_GET['token']);
    $where['uid']=$uid;
    $where['approved']=2;//2是通过


    //获取自己发出的所有评论所收到的评论
    $com1=get_recomment($where,'comment');
    //设置codeid
    $com1=set_codeid($com1,60);
    //获取自己发出的所有文章类所收到的评论
    $com2=get_recomment($where,'relationship');
    //设置codeid
    $com2=set_codeid($com2,104);

    //获取别人对我评论的点赞
    $com3=get_rezan($where,'comment');
    //设置codeid
    $com3=set_codeid($com3,60);

    //获取别人对我所有文章类的点赞
    $com4=get_rezan($where,'relationship');
    //设置codeid
    $com4=set_codeid($com4,104);

    //把全部数据整合并根据时间排序
    $temp=array_merge($com1,$com2,$com3,$com4);

    foreach($temp as $v){  
        $flag[] = $v['createtime'];  
    }  
if(!$temp)return rejson(0,'无记录');       
    array_multisort($flag, SORT_DESC, $temp);

    //分页
    $result=fenye($temp,$listnum);
          
    if ($curPage>ceil(count($temp)/$listnum)) {
      return rejson('0','该页无数据,页数超出范围');
    }

    $re['pages']=ceil(count($temp)/$listnum);
    $re['datalist']=$result[$curPage-1];
    $re['total']=count($temp);

    if($re){
      return rejson('1','查询成功',$re);
    }else{
      return rejson(0,'无记录');
    }
  }






//发出的评论
  public function get_send_com(){
    $curPage = input('curPage') ? input('curPage') : 1;
    $listnum = input('listnum') ? input('listnum') : 10;    


    $uid=get_uid($_GET['token']);
    $where['uid']=$uid;
    $where['approved']=2;//2是通过
    $where['isdel']=0;

    //获取自己发出的所有评论
    $data=get_sendcomment($where,'comment');
if(!$data)return rejson(0,'无记录'); 
    //排序
    foreach($data as $v){  
        $flag[] = $v['createtime'];  
    }  
      
    array_multisort($flag, SORT_DESC, $data);

//分页
    $result=fenye($data,$listnum);
          
    if ($curPage>ceil(count($data)/$listnum)) {
      return rejson('0','该页无数据,页数超出范围');
    }

    $re['pages']=ceil(count($data)/$listnum);
    $re['datalist']=$result[$curPage-1];
    $re['total']=count($data);

    if($re){
      return rejson('1','查询成功',$re);
    }else{
      return rejson(0,'无记录');
    }
  }


























/*---------------------建筑圈-----------------------*/


// 添加建筑圈内容
 public function arch_add(){
    $uid = get_uid($_GET['token']); 
    $data = [
        'content'=> input('content'),
        'thumb'=> input('thumb'),
        'uid'=>$uid,
        'createtime'=>time(),
        'cateid'=>92//建筑圈
    ];

    if(input('type')=='repeat'){//转发
      $data['type']='repeat';
      $data['repeatid']=input('repeatid');
      Db::name('relationship')->where('id',input('repeatid'))->update(['forwarding' => ['exp','forwarding+1']]);
    }

    $re = insert_data('relationship',$data);
    if(!$re){
      return rejson(0,'失败');
    }
    return rejson(1,'success',null);

}

  //建筑圈举报
  public function report(){
    $data['uid']=get_uid($_GET['token']);
    $data['laiyuan']= input('id');
    $data['module']='quanzi';
    $data['report'] = input('report_type');
    $data['createtime']=time();
    $data['type']=1;
    $re=insert_data('prosecute',$data);
    // $val = db('relationship')->where('id','=',$id)->value('report');
    // $val = $val.','.$report;
    // $re = db('relationship')->where('id','=',$id)->update(['report',$val]);
    if(!$re){
      return rejson(0,'举报失败');
    }
    return rejson(1,'success',null);
  }




//增加评论
  public function comment_add(){

      $data = [
        "content" => input('content'),
        "uid" => get_uid($_GET['token']),//当前登录用户的id
        "createtime"=>time(),
        "comimg"=>input('comimg')
      ];

      if(input('articleid')){$data['articleid']=input('articleid');}//对文章类评论
      if(input('pid')){$data['pid']=input('pid');}//对评论评论


      if(input('pid')){//对评论进行评论
        $where['id']=['=',input('pid')];
        $re=get_data('comment',$where);
        if ($re) {//评论数
          Db::name('comment')->where('id',input('pid'))->update(['comnum' => ['exp','comnum+1']]);
        
          // //添加通知信息
          // $noticedata['user_id']=$user['id'];
          // $noticedata['from_id']=$re['uid'];
          // $noticedata['type']=1;
          // $noticedata['content']=$user['nickname']."评论了您的评论";
          // $noticedata['createtime']=time();
          // insert_data('notice',$noticedata);
        }
      }

      if(input('articleid')){//对评论进行评论
        $where['articleid']=['=',input('articleid')];
        $re=get_data('comment',$where);
        if ($re) {//评论数
          Db::name('relationship')->where('id',input('articleid'))->update(['comnum' => ['exp','comnum+1']]);    
          // //添加通知信息
          // $noticedata['user_id']=$user['id'];
          // $noticedata['from_id']=$re['uid'];
          // $noticedata['type']=1;
          // $noticedata['content']=$user['nickname']."评论了您的观点";
          // $noticedata['createtime']=time();
          // insert_data('notice',$noticedata);
        }
      }




      $res = db('comment')->insert($data);
      if(!$res){
        return rejson(0,'失败');
      }

      return rejson(1,'success',null);

    
  }



public function thumbcount(){

  if(!input('commentid')&&!input('articleid'))return rejson('0','参数设置错误');
     if(input('commentid')){//对评论进行点赞
      $tbn='comment';
      $id=input('commentid');
     }
     if(input('articleid')){//对文章类进行点赞
      $tbn='relationship';
      $id=input('articleid');
     }
     $uid = get_uid($_GET['token']);  //当前登录用户的id
     $data = db($tbn)->where('id','=',$id)->find();
     $user = explode(",", $data['zanUser']);
     $time = explode(",", $data['zanTime']);
     if(in_array($uid, $user)){//取消点赞和点赞时间
        foreach ($user as $key => $value) {
          if($value==$uid){
            unset($user[$key]);
            unset($time[$key]);
          }
        }
       $data['thumbcount'] -= 1;
       $data['zanUser'] = implode(',',$user);  
       $data['zanTime']=implode(',',$time);           
     }else{
      $data['thumbcount'] += 1;
      $data['zanUser'] = $data['zanUser'].','.$uid ;  
      $data['zanTime']=$data['zanTime'].','.time();    
     }


     $thumbcount = db($tbn)->where('id','=',$id)->value('thumbcount');

     $res = db($tbn)->where('id','=',$id)->update($data);
     if(!$res){
      return rejson(0,'点赞失败');
     }
     return rejson(1,'成功');
  }


  //建筑圈动态收藏
  public function college(){
    $id = input('id');
    $uid = get_uid($_GET['token']);//当前登录用户的id
    $data = db('relationship')->where('id','=',$id)->find();
    $user = explode(",", $data['collegeUser']);
    if(in_array($uid, $user)){
      //转换数组,默认数组的键值对是类似这样
      //array(0=>7,1=>12,2=>541);
      //转换后是array(7=>0,12=>1,541=>2);
      $arr_flip = array_flip($user);
      //删除为7的
      $delete_mark = $uid;
      unset($arr_flip[$delete_mark]);
      //数组再转回来
      $string_to_array = array_flip($arr_flip);
      //数组合成字符串
      $data['collegeUser'] = implode(",", $string_to_array);
     }else{
          $data['collegeUser'] = $data['collegeUser'].','.$uid;
     }
    $res = db('relationship')->where('id','=',$id)->update($data);
     if(!$res){
      return rejson(0,'收藏失败');
     }
     return rejson(1,'成功');
  }






//问答模块
//1.问答模块-新增提问
public function question_add(){
$data = [
  'content' => input('content'),
  'description' => input('description'),
  'thumb' =>input('thumb'),
  'createtime' => time(),
  'uid' => get_uid($_GET['token']),
  'cateid'=>93
];
if(input('id')){//有id即为回答问答
  $data['pid']=input('id');
}
$tnb = 'relationship';
  $re = insert_data($tnb,$data);
  if(!$re){
    return rejson(0,'失败');
  }
  return rejson(1,'success',null);
}


// 日志查询列表
public function diary_list1()
{     
    if(!input('codeid')){return rejson(0,'参数错误');} 
    //对codeid进行解析； 
    $arr = explain_codeid(input('codeid')); 
    $where = array();
    $where2 = array();
    $order = dealorder(input('post.orderstrid'));
    $uid = get_uid($_GET['token']);//当前登录用户的id
    $where['uid']=$uid;
    //各表不同，关键字对应字段不同，走配置化
    if(input('keyword')){
        $keyword= $arr['kws']==''?'keyword':$arr['kws'];
        $where[$keyword] = ['like','%'.input('keyword').'%'];
    } 
    if(input('diarytype')){
        $where['diarytype'] = ['=',input('diarytype')];
    } 

    if(input('c_alias')){
        $where2['c_alias'] = ['=',input('c_alias')];
    } 
    //调用模型层接口
    $data = get_datalist('article',$where,'','','');
    $arr['total'] = count($data);
    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
    $data2 = get_datalist('dict',$where2,'','',$order);
    foreach ($data2 as $key => $value) {
        $data2[$key]['total'] = 0;
        foreach ($data as $k => $val) {
            if($data2[$key]['c_id'] == $val['diarystyle']){
                $data2[$key]['total'] += 1;
            }
        }
    }
    $datalist = set_codeid($data2,$arr['num']); 
    if(count($datalist)>0){ 
        return rejson(1,'查询成功',$datalist,$arr);
    }else{
        return rejson(0,'查询失败',[],$arr);   
    } 
}

// 照片查询列表
public function album_list1()
{     
    if(!input('codeid')){return rejson(0,'参数错误');} 
    //对codeid进行解析； 
    $arr = explain_codeid(input('codeid')); 
    $where = array();
    $order = dealorder(input('post.orderstrid'));
    $uid = get_uid($_GET['token']);//当前登录用户的id
    $where['uid']=$uid;
    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
    $data = get_datalist('photogroup',$where,'','',$order);
    $data2 = get_datalist('photo',$where,'','','');
    foreach ($data as $key => $value) {
        $data[$key]['total'] = 0;
        foreach ($data2 as $k => $val) {
            if($data[$key]['id'] == $val['pid']){
                $data[$key]['total'] += 1;
            }
        }
    }
    $datalist = set_codeid($data,$arr['num']); 
    if(count($datalist)>0){ 
        return rejson(1,'查询成功',$datalist,$arr);
    }else{
        return rejson(0,'查询失败',[],$arr);   
    } 
}

// 照片插入
public function album_editadd()
{     
    $p = input('post.');
    $content = array();
    $content['pid']=$p['pid'];
    $content['uid']=get_uid($_GET['token']);
    foreach ($p['imgarr'] as $key => $value) {
        $content['img']=$value;
        $content['createtime']=time(); 
        $re = insert_data('photo',$content);    
    }
    if($re){
        return rejson(1,'提交成功！',$re); 
    }else{
        return rejson(0,'提交失败！',[]); 
    } 
}
//设为背景音乐
public function music_editadd(){
    if(!input('codeid')){return rejson(0,'参数错误');}  
    $p = input('post.');
    if(count($p)==1){return rejson(0,'参数不齐全');} 
    $arr = explain_codeid(input('codeid'));
    $b = get_uid($_GET['token']);
    if($arr['idv']){
       $a = Db::name('article')->where('format','=',4)->where('uid','=',$b)->where('status','=',1)->find();
    if($a){
      $re = Db::name('article')->where('id','=',$a['id'])->setField('status',0);
    }
    //id值为不为空，这里是编辑更新
    $content= real_data($p,$arr);
    unset($content['data']['createtime']);
    $content['data']=editaddtime_format($content['data']);
    $content['data']['updatetime'] =time();
    $content['data']['status'] =1;
       $where[$arr['id']]=['=',$arr['idv']]; 
       $re = update_one($arr['tbn'],$where,$content['data']); 
  }else{
    //id值为空，这里是插入
      // return json($p);
      $content = array();
      $content['format']=$p['format'];
      $content['uid']=get_uid($_GET['token']);
      foreach ($p['contentarr'] as $key => $value) {
          $content['content']=$value;
          $content['title']=$p['titlearr'][$key];
          $content['createtime']=time(); 
          $re = insert_data('article',$content);    
      }
  } 
  if($re){
    return rejson(1,'提交成功！',$re,$arr); 
    }else{
        return rejson(0,'提交失败！',[],$arr); 
    } 
}

// 无分页查询列表
  public function beijing_detail()
      {
      if(!input('codeid')){return rejson(0,'参数错误');} 
      //对codeid进行解析； 
      $arr = explain_codeid(input('codeid')); 
      $tbn = $arr['tbn']; 
      $where['format']=['=',4];
      $where['status']=['=',1];
      $where['uid']=get_uid($_GET['token']);
      //调用模型层接口
      $data = get_datalist('article',$where);
        if($data>0){
         //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
         $data = set_codeid($data,$arr['num']); 
           return rejson(1,'查询成功',$data,$arr);
        }else{
        return rejson(0,'查询失败',[],$arr);  
        } 
      }    
//日程内编辑
public function schedule_editadd()
{
    $p = input('post.');
    if(count($p)==0){return rejson(0,'参数不齐全');} 
    if(!input('codeid')&&input('dropcode')){
        $arr = [
            'id'=> 'id',
            'idv'=> (int)(input('dropcode')),
            'num'=> '2',
            'tbn'=> 'schedule'
        ];
    }else if(input('codeid')){
        $arr = explain_codeid(input('codeid'));
    }else{
        return rejson(0,'参数错误');
    }
    $content= real_data($p,$arr);
    unset($content['data']['createtime']);
    $content['data']=editaddtime_format($content['data']);
    $content['data']['uid']=get_uid($_GET['token']);
    $content['data']['updatetime'] =time();
    $where[$arr['id']]=['=',$arr['idv']];
    $re = update_one($arr['tbn'],$where,$content['data']); 
    if($re){
        return rejson(1,'提交成功！',$re,$arr); 
    }else{
        return rejson(0,'提交失败！',[],$arr); 
    } 
}











































































}
