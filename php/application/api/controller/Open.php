<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\View;
use think\File;
use think\Db;
use think\Session;
use think\Route;
use think\Loader;
use think\cache\driver\Redis;
use plug\oosupload;
use jwt\ExpiredException;
define("TOKEN","linxcABCDEFGHIJGJJ");
define("Appid","wx3edf97fba911c055");
define("AppSecret","069f867e0970e0d563abbbe80b84ffc3");

class Open extends openInit
{
    /**
     * 微信接入验证
     * @return [type] [description]
    */
    public function index(){
        $view = new View();  
        if (!Session::get('jsoninfo')) {
	        if (array_key_exists('code',$_GET)||Session::get('wxopenid')) {
	        	if (Session::get('wxopenid')) {
	        		$openid = Session::get('wxopenid');
	        	}else{
		            $code = $_GET['code'];
		            $oauth2url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".Appid."&secret=".AppSecret."&code={$code}&grant_type=authorization_code";
	                $jsoninfo = $this->http_curl($oauth2url,null);
	                $access_token = $jsoninfo['access_token'];
	                $openid = $jsoninfo['openid'];
	        	}
                $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";      
                $jsoninfo = $this->http_curl($url,null);        
                Session::set('jsoninfo',$jsoninfo); 
                Session::set('wxopenid',$openid);              
		    }
		    else{
		        header(wechatRedirect('index'));   
		        exit(); 
		    }            	
        }
        // p($jsoninfo);
    }   

   
    /**
     * 获取全局的access_token方法
     * @return [type] [description]
     */
    public function getAccessToken(){
    	$field = 'access_token,modify_time';
    	$condition = array('token'=>TOKEN,'appid'=>Appid,'appsecret'=>AppSecret);
    	// $data = M('wechat')->field($field)->where($condition)->find();
    	// if($data['access_token'] && time()-$data['modify_time']<7000){
    	// 	$access_token = $data['access_token'];
    	// }else{
    		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.Appid.'&secret='.AppSecret.'';
    		$jsoninfo = $this->http_curl($url,null);
    		if(!$jsoninfo){
    			var_dump($jsoninfo);
    		}else{
    			$access_token = $jsoninfo['access_token'];
    			$data = array('access_token' =>$access_token,'modify_time'=>time());
    			// M('wechat')->where($condition)->save($data);
    		}
    	// }
    	return $access_token;
    }

    /**
     * curl方法
     * @param  [type] $url  [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function http_curl($url,$data){
	    //1.初始化curl
	    $ch = curl_init();
	    //2.设置curl的参数
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
	    if($data){
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: '.strlen($data)));
	    }
	    //3.采集
	    $output = curl_exec($ch);
	    //4.关闭
	    curl_close($ch);
	    $jsoninfo = json_decode($output, true);
	    return $jsoninfo;
    }
	/*
	 * 辅助方法1：微信接入验证
	 */
	public function main(){
	  $token = 'linxclinxc';
	  $nonce = $_GET["nonce"];  
	  $timestamp = $_GET["timestamp"];
	  // $echoStr = $_GET["echostr"];
	  $signature = $_GET["signature"];
	  $tmpArr = array($token, $timestamp, $nonce);
	  sort($tmpArr, SORT_STRING);
	  $tmpStr = implode( $tmpArr );
	  $tmpStr = sha1( $tmpStr );
	  // if( $tmpStr == $signature && $echoStr){
	  //   // $this->responseMsg();
	  //   ob_clean();
	  //   echo $echoStr;
	  //   exit;
	  // }else{
	    $this->responseMsg();
	  // }
	}

    /**
     * 发送消息
     * @return [type] [description]
     */
    public function responseMsg(){
      $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];               
      $postObj = simplexml_load_string($postStr,"SimpleXMLElement",LIBXML_NOCDATA);//XML转String
    //根据消息类型将信息分发
      if(strtolower( $postObj->MsgType) == 'event'){
          if(strtolower($postObj->Event) == 'subscribe'){
                $toUserName = $postObj->FromUserName;
                $fromUserName = $postObj->ToUserName;
                $createTime = time();
                $msgType = 'text';
                $content = "【私募招聘网】是一家专注私募行业求职、招聘的垂直平台；通过线上招聘+线下社交的创新模式为企业实现快速的人才战略。为私募企业和人才搭建桥梁；让招聘、求职变得更加简单、高效！
快速进入找工作：http://www.91smzpw.com/jobs
 【私募社群】是私募招聘网旗下专注私募行业的垂直社交平台；为用户提供人脉拓展、建立渠道合作、对接优质项目、交流学习的机会聚积地；我们的梦想是连接每一个私募人；在未来的道路上互相帮助、学习、成长！
 欢迎阁下加入；一起共创美好未来；点击下方的【私募社群】即可加入平台";
                $template ="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";
                $info = sprintf($template, $toUserName, $fromUserName,$createTime, $msgType,$content);
                echo $info;
          }
      }
    }
    
	public function img()
	{
	  $view = new View();  
	    return $view->fetch();
	}  
	public function attend()
	{
	  $view = new View();  
	    return $view->fetch();
	}  

	public function create_menu(){
	  $appid = Appid;
	  $appsecret = AppSecret;
	  //下面是测试号的appid和appsecrect
	  // $appid = 'wx855ea7a09cac1332';
	  // $appsecret = '61898f7349e81bda57297d900bdb67ba';
	  $accestoken = $this->getAccessToken($appid,$appsecret);
	  $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$accestoken}";
	  $menu = '{
	    "button": [
	        {
	            "type": "view",
	            "name": "再梦江南",
	            "url" : "https://open.weixin.qq.com/connect/oauth2/authorize?appid='.Appid.'&redirect_uri=http%3a%2f%2fwww.chenbaozhong.com%2findex.php%2fIndex%2findex&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
	        },    
	        {
	            "type": "view",
	            "name": "找工作",
	            "url" : "http://www.91smzpw.com"
	        },  
	        {
	            "type": "view", 
	            "name": "BOSS微信", 
	            "url":"http://www.91smzpw.com/simu/index.php/index/img"
	        } 
	    ]
	  }';  
	    $jsoninfo = $this->http_curl($url,$menu);
	    var_dump($jsoninfo);
	    exit;
	}



	//app下载路径
	public function getysqcore (){

		$qrode['qr']="宇衫二维码";
		$qrode['tip']="下载宇衫APP随时随地的使用";
		$qrode['downurl']="www.baidu.com.....appimg....";
		$qrode['img']=".....二维码的图片地址....";

		return rejson($code=1,$msg='成功',$data=$qrode);
	}

	//职位类型树
	public function jobtypetree(){
		$field='id,parentid,categoryname';
		$trees=get_datalist('category_jobs',$where=null,$field,$num=null,$sort=null);

		foreach ($trees as $k=>$v){
			if($v['parentid']==0){
				$arr[$k] = $v;//dump($arr[$v['id']]);
				foreach ($trees as $kkk=>$vvv){
					if($vvv['parentid']==$v['id']){
						$arr[$k]['chllist'][]= $vvv;
					}
				}
			}
		}

		sort($arr);//重新生成索引下标

		return rejson($code=1,$msg='成功',$data=$arr);
	}

	//职位详情页面的公司和hr头像信息
	public function gethrinfo1(){
		/*$uid=94;
		$where['uid']=94;
		$fie='id,companyname,subcompany,trade_cn,scale_cn,logo,avatar,nickname,business,certification';
		$data=get_datalist('usercom',$where,$fie,$num=null,$sort=null);
		return rejson(1,'success',$data[0]);*/

		$jobid=25;
		$com_id=Db::name('jobs')->where('id','$jobid')->field('company_id')->find();

		$fie='companyname,subcompany,trade_cn,scale_cn,logo,avatar,nickname,business,certification';
		$where['id']=$jobid;
		$data=get_datalist('usercom',$where, $field=$fie);
		return rejson(1,'success',$data);
	}

	//获取HR头像、公司信息
	public function gethrinfo(){
		//$uid=session('uid');
		if(!input('uid'))return rejson('0','uid未设置');
		$uid=input('uid');
		$where['uid']=$uid;
		//$field='id,companyname,scale,scale_cn,logo,avatar,nickname,email';
		$comp=get_datalist('jobs_company',$where,'',$num=null,$sort=null);

		$where1['id']=$uid;
		$field1='nickname,headimg,email,city';
		$user=get_datalist('admin_user',$where1,$field1,$num=null,$sort=null);
		if(!$user){return rejson('0','无此用户信息');}
		$compinfo['nickname']=$user[0]['nickname'];
		$compinfo['headimg']=$user[0]['headimg'];
		$compinfo['email']=$user[0]['email'];
		$compinfo['city']=$user[0]['city'];

		$data=array_merge($comp[0],$compinfo);
		if($data){
			return rejson($code=1,$msg='成功',$data);
		}else{
			return rejson('0','无此公司信息');
		}
	}

	/*public function getcompanyjobtypes(){
		//step1:获取公司发布的职位总数
		$com_id=28;
		$sum=Db::name('jobs')->where('company_id',$com_id)->count('company_id');
		$cate=Db::name('jobs')->where('company_id',$com_id)->field('category,sum(topclass)')->group('category')->select();
		$data = array();
		foreach ($cate as $value) {
			$data[$value['category']] = $value['sum(topclass)'];
		}
		return rejson(1,'success',$data);
	}*/

	//获取发布职位与数量
	public function getcompanyjobtypes(){
		if(!input('companyid')){return rejson('0','companyid未设置');}
		$field='id,parentid,categoryname';
		$where['parentid']=0;
		$job_yi=get_datalist('jobs_category',$where,$field,$num=null,$sort=null);

		foreach ($job_yi as $k=>$v){
			$job_yi[$k]['num']=0;
		}//dump($job_yi);

		//step1:获取公司发布的职位总数
		$com_id=input('companyid');
		$sum=Db::name('jobs')->where('company_id',$com_id)->count('company_id');
		$cate=Db::name('jobs')->where('company_id',$com_id)->field('category,sum(topclass)')->group('category')->select();

		foreach ($cate as $kk =>$vv){
			$exist=Db::name('jobs_category')->where('id','=',$vv['category'] and 'parentid','=',0)->find();
			if($exist){
				foreach ($job_yi as $k=>$v){
					if($v['id']==$exist['id']){
						$job_yi[$k]['num']+=$vv['sum(topclass)'];
					}
				}
			}else{
				$farent_exist=Db::name('jobs_category')->where('parentid','=',$vv['category'] and 'parentid','=',0)->find();
				if($farent_exist){
					$job_yi[$k]['num']+=$vv['sum(topclass)'];
				}
			}
		}

		foreach($job_yi as $key => $value ) {
			if($value['num']==0) unset($job_yi[$key]);
		}
		sort($job_yi);//重新生成索引下标

		return rejson(1,'success',$data=$job_yi);
	}











/*


===========公共方法=============


 */

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

	    //调用模型层接口
	    $data = get_datalist($arr['tbn'],$where,'',input('top'),$order);

	   
	    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
	    $datalist = set_codeid($data,$arr['num']);
	      if($datalist){ 
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
	public function ucom_detail()
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
  			 $arr2 = get_data('admin_user',$uwhere,$field);
  			 if(!$arr2){return rejson('0','该用户不存在');} 	
  			 if($arr){
  			 	$data =  array_merge($data, $arr2);
  			 } 

	       //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
	       $datav = set_codeid([$data],$arr['num']);  
	         return rejson(1,'查询成功',$datav[0],$arr);
	      }else{
	      return rejson(0,'查询失败',[],$arr); 	
	      } 
	    }    
	
	public function ucom_list()
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

	    //调用模型层接口
	    $data = get_datalist($arr['tbn'],$where,'',input('top'),$order);

	    foreach ($data as $key => $value) {
	    	$uwhere['id']=$value['uid'];
	    	$field = 'nickname,headimg';
	    	$ud=get_data('admin_user',$uwhere,$field);
	    	if(!$ud){return rejson('0','该用户不存在');} 
	    	$value['nickname']=$ud['nickname'];
	    	$value['headimg']=$ud['headimg'];
	    }
	   
	    //对返回去的记录进行加密codeid，方便后面再次调用公共接口； 
	    $datalist = set_codeid($data,$arr['num']);
	      if($datalist){ 
	         return rejson(1,'查询成功',$datalist,$arr);
	      }else{
	      return rejson(0,'查询失败',[],$arr); 	
	      }
}
 
	// 有分页查询列表 
	public function ucom_list_page()
	{
		$curPage = input('curPage') ? input('curPage') : 1;
		$listnum = input('listnum') ? input('listnum') : 10;
		//对codeid 进行解密；
		$arr = explain_codeid(input('codeid'));
		$tbn = $arr['tbn'];
      $where = dealwhere(input('post.'));
      $order = dealorder(2);
		//各表不同，关键字对应字段不同，走配置化
		if (input('keyword')) {
			$keyword = $arr['kws'] == '' ? 'keyword' : $arr['kws'];
			$where[$keyword] = ['like', '%' . input('keyword') . '%'];
		}
		
		$data = get_datalist_page($tbn, $where, $curPage, $listnum,$order);
		if(!$data['datalist']){return rejson('0','无数据',['datalist' => [], 'total' => 0],$arr);}

		if($tbn=='relationship'){
			if(is_array($_GET)&&count($_GET)>0){
				if(isset($_GET['token'])){
					$uid=get_uid($_GET['token']);
					foreach ($data['datalist'] as $key => &$value) {
							$zanarr=explode(',',$value['zanUser']);
							$collegearr=explode(',',$value['collegeUser']);
							$value['iszan']=in_array($uid,$zanarr)?1:0;
							$value['iscollege']=in_array($uid,$collegearr)?1:0;

						if($uid==$value['uid']){
							$value['ismine']=1;
						}else{
							$value['ismine']=0;
						}
					}
				}
			}
		}
		//对结果进行加密主键id为codeid；
		$data['datalist'] = set_codeid($data['datalist'], $arr['num']);
//查询对应的用户
		$uids = getids($data['datalist'], 'uid');
		$uwhere['id'] = ['in', $uids];
		$field = 'nickname,id,headimg,job';
		$arr2 = get_datalist('admin_user', $uwhere, $field);
		// if(!$arr2){return rejson('0','该用户不存在');} 
		if($arr2)
		$data['datalist'] = jointwoarr($data['datalist'], $arr2, 'uid', 'id');


		if (count($data['datalist']) > 0) {
			return rejson(1, '查询成功', $data, $arr);
		} else {
			return rejson(0, '查询失败', ['datalist' => [], 'total' => 0],$arr);
		}
	}

	// 有分页查询列表 
	public function myucom_list_page()
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

		$where['uid']=get_uid($_GET['token']);
		
		$data = get_datalist_page($tbn, $where, $curPage, $listnum,$order);
		if(!$data['datalist']){return rejson('0','无数据',['datalist' => [], 'total' => 0],$arr);}
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


//文件图片上传    
public function formupload(){
    $rd = array('code'=>0,'msg'=>'fail','data'=>array());
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('file');
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->move(ROOT_PATH . 'upload');
    if($info){
        $path = $info->getSaveName();

        $path = str_replace("\\","/",$path);
        $rd = array('code'=>1,'msg'=>'success','data'=>array('pathurl'=>$path));
    }
    return json($rd);
}



 //文件图片上传    
 public function _upload() {
    import("ORG.Upload");
    $upload = new UploadFile();
    //设置上传文件大小
    $upload->maxSize = 3292200;
    //设置上传文件类型
    $upload->allowExts = explode(',', 'jpg,gif,png,jpeg,mp3');
    //设置附件上传目录
    $upload->savePath = './data/attachments/';
    //设置需要生成缩略图，仅对图像文件有效
    $upload->thumb = true;
    // 设置引用图片类库包路径
    $upload->imageClassPath = '@.ORG.Image';
    //设置需要生成缩略图的文件后缀
    $upload->thumbPrefix = 'm_';
    //生产2张缩略图
    //设置缩略图最大宽度
    $upload->thumbMaxWidth = '720';
    //设置缩略图最大高度
    $upload->thumbMaxHeight = '400';
    //设置上传文件规则
    $upload->saveRule = uniqid;
    //删除原图
    $upload->thumbRemoveOrigin = true;
    if (!$upload->upload()) {
        //捕获上传异常
        return $upload->getErrorMsg();
    } else {
        //取得成功上传的文件信息
        $uploadList = $upload->getUploadFileInfo();
        return $uploadList;
    }
}

/**
 *菜单查询列表或者一条
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl  
 */
public function menutree_select(){   
     

      // $sort = 'listorder asc';
      // $list = get_datalist('system_menu','','','',$sort);
      // $arr = [];
      // foreach ($list as $key => $value) { 
      //   if($value['pid']==0){
      //     $arr[] = $value;
      //   } 
      // }


      // foreach ($arr as $key => &$value) { 
      //   foreach ($list as $k => $val) {
      //     if($value['id']==$val['pid']){
      //       $value['chllist'][] = $val;
      //     }  
      //   } 

      //   foreach ($value['chllist'] as $key => &$v) { 
      //   foreach ($list as $k => $va) {
      //     if($v['id']==$va['pid']){
      //       $v['chllist'][] = $va;
      //     }  
      //   } 
      // }     

         


      // } 
   
  return rejson(1,'查询成功',[],set_comview_admin());
}






//判断是否登录
public function islogin(){
	try{
	    if(isset($_GET['token'])){
	      $token=explaintoken($_GET['token']);
		    if(cache($token->uuid)){
				return rejson('1','已是登录状态');
			}else{
				return rejson('0','未登录状态');
			}
	    }else{
	    	return rejson('0','未登录状态');
	    }
    }catch(\Exception $e){
        return rejson('0','未登录状态');
    }  
}


























/**
 *用户信息存入session,从session拿出用户信息
 * @param    string   cookie("PHPSESSID")
 * @return   stringcookie("PHPSESSID")
 * @author  qwx <1042096282@qq.com>
 */



  // 2.公共查询列表分页--含用户信息
  public function ucom_list_page2(){
  	 if(!input('codeid')){return rejson(0,'参数错误');} 
	  //对codeid进行解析； 
     $curPage = input('curPage') ? input('curPage') : 1;
     $listnum = input('listnum') ? input('listnum') : 10;   
	 $arr = explain_codeid(input('codeid')); 
     $tbn= 'relationship';//$arr['tbn'];
     $where['isdel']=['=','0'];
     $total = Db::name($tbn)->where($where)->count();
     $pages = ceil($total/$listnum);
     $field = 'a.id,a.uid,b.headimg,b.nickname,b.workname,a.createtime,a.content,a.thumb,a.forwarding,a.comnum,a.thumbcount';
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0")->field($field)->page($curPage)->limit($listnum)->order('a.createtime desc')->select();
 	if(!$data){
 		return rejson(0,'失败');
 	}
     $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
     return rejson(1,'success',$arr);
  }

  // // 提供举报类型
  // public function apply_report(){
  //   $data = db('report')->select();
  //   if(!$data){
  //     return rejson(0,'查询失败');
  //   }
  //   return rejson(1,'success',$data);
  // }




// function get_datalist_page($tbn=null,$where=null,$curPage=null,$listnum=null,$order=null,$field=null){

//     $where['isdel']=['=','0'];

//     $total = Db::name($tbn)->where($where)->count();
//     // p($total);
//     $pages = ceil($total/$listnum);
//     $data=Db::name($tbn)->where($where)->field($field)->page($curPage)->limit($listnum)->order($order)->select();
//     $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
//     return $arr;
// }











//获取评论列表
public function get_qzcomment(){
	if(!input('id')){return rejson(0,'id未设置');}
    $curPage = input('curPage') ? input('curPage') : 1;
    $listnum = input('listnum') ? input('listnum') : 10; 
	$data=get_soncomment(input('id'));

	//判断是否是自己的评论（登陆后）
	if(is_array($_GET)&&count($_GET)>0){
		if(isset($_GET['token'])){	
			foreach ($data as $key => &$value) {

					$uid=get_uid($_GET['token']);
					$value['ismine']=$uid==$value['uid']?1:0;
				
			}
		}
	}
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































 //评论列表项
 public function ucom_list_page1(){
 	if(!input('codeid')){return rejson(0,'参数错误');} 
	  //对codeid进行解析; 
	 $arr = explain_codeid(input('codeid')); 
     $tbn= $arr['tbn'];
     $curPage = input('curPage');
     $listnum = input('listnum');
     $relationshipid = input('relationshipid');
     $total = Db::name($tbn)->where("isdel =0 AND relationshipid = $relationshipid")->count();
     $pages = ceil($total/$listnum);
     $field = 'b.headimg,b.nickname,a.createtime,a.content,a.thumbcount,a.pid,a.ptitle';
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0 AND a.relationshipid = $relationshipid")->field($field)->page($curPage)->limit($listnum)->order('a.createtime desc')->select();
     if(!$data){
     	return rejson(0,'失败');
     }
     $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
     return rejson(1,'success',$arr);
 } 

 


/**
 * 建筑圈详情
 * @author qwx <1042096282@qq.com>
 */
  //建筑圈详情信息
public function arch_info(){
  if(Request()->ispost()){
	$id = input('id');
	$field = 'b.headimg,b.nickname,b.workname,a.createtime,a.content,a.thumb,a.forwarding,a.commentnum,a.thumbcount';
	$data = db('relationship')->alias('a')->join('ys_admin_user b','b.id = a.uid')->where('a.id','=',$id)->field($field)->find();
	if(!$data){
		return rejson(0,'失败');
	}
	return rejson(1,'成功',$data);
  }
}
//建筑圈详情评论
public function com_add(){
	if(Request()->isPost()){
	    $data = [
			'relationshipid' => input('relationshipid'),
			'pid' => input('pid'),
			'to_id' => input('to_id'),
			'to_nickname' => input('to_nickname'),
			'content' => input('content'),
			'createtime' => time(),
			'uid' => get_uid($_GET['token'])
		];
		$res = db('relation_comment')->insert($data);
		if(!$res){
			return rejson(0,'失败');
		}
		return rejson(1,'success');
	}
}
//建筑圈详情热门动态(热门动态规则：将转发量,评论数,点赞数的count()作为参考)
public function list_page_detail(){
	if(!input('codeid')){return rejson(0,'参数错误');} 
	  //对codeid进行解析； 
	 $arr = explain_codeid(input('codeid')); 
     $tbn= $arr['tbn'];
     $curPage =input('curPage');
     $listnum = input('listnum');
     $where['isdel']=['=','0'];
     $total = Db::name($tbn)->where($where)->count();
     $pages = ceil($total/$listnum);
     $field = 'b.headimg,b.nickname,b.workname,a.createtime,a.content,a.thumb,a.forwarding,a.commentnum,a.thumbcount';
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0")->field($field)->page($curPage)->limit($listnum)->order('a.forwarding+a.commentnum+a.thumbcount desc')->select();
 	if(!$data){
 		return rejson(0,'失败');
 	}
     $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
     return rejson(1,'success',$arr);	
}
 

// 建筑圈详情页评论列表  --跟建筑圈的一致
// public function com_list(){

// }
 
//删除建筑圈详情页 
public function arch_delete(){
	if(request()->ispost()){
		$id = input('id');
		$re = db('relationship')->where('id','=',$id)->setField('isdel',1);
		if(!$re){
			return rejson(0,'失败');
		}
		return rejson(1,'success');

	}
}

//置顶建筑圈---改变对应的createtime
public function arch_overhead(){
	if(request()->ispost()){
		$id = input('id');
		$time = time();
		$re = db('relationship')->where('id','=',$id)->setField('createtime',$time);
		if(!$re){
			return rejson(0,'失败');
		}
		return rejson(1,'success');
	}
}

/**
 * 宇衫建筑--问答列表
 * @author qwx <1042096282@qq.com>
 */


//2.问答首页列表--这个跟建筑圈的ucom_list_page一致;区别：字段不一样  
public function question_list(){
	if(!input('codeid')){return rejson(0,'参数错误');} 
	  //对codeid进行解析； 
	 $arr = explain_codeid(input('codeid')); 
     $tbn='question'; //$arr['tbn'];
     $curPage = input('curPage');
     $listnum = input('listnum');
     $where['isdel']=['=','0'];
     $total = Db::name($tbn)->where($where)->count();
     $pages = ceil($total/$listnum);
     //$field = 'b.headimg,b.nickname,a.createtime,a.content,a.thumb,a.comnum,a.viewnum,a.colnum';
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0")/*->field($field)*/->page($curPage)->limit($listnum)->order('a.createtime desc')->select();
 	if(!$data){
 		return rejson(0,'失败');
 	}
     $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
     return rejson(1,'success',$arr);
}
//3.问答首页周采纳排行版
public function adoptionlist(){
	 if(!input('codeid')){return rejson(0,'参数错误');} 
	  //对codeid进行解析； 
	 $arr = explain_codeid(input('codeid')); //获取tbn
     $tbn= $arr['tbn'];
     $curPage = input('curPage')?input('curPage'):1;
     $listnum = input('listnum')?input('listnum'):10;  
     $where['isdel']=['=','0'];
     $where['cateid']=93;
     $total = db($tbn)->where($where)->count();
     $pages = ceil($total/$listnum);
     $field = 'b.headimg,b.nickname,sum(bestanswer) as adopnum';
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0 AND a.bestanswer = 1")->
     field($field)->page($curPage)->limit($listnum)->group('uid')->order('adopnum desc')->select();
     if(!$data){
     	return rejson(0,'失败');
     }

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


//4.回答提问
public function answer(){
	$data = [
		'questionid' =>input('questionid'),
		'pid' => input('pid'),
		'to_id' => input('to_id'),
		'to_nickname' => input('to_nickname'),
		'content' => input('content'),
		'from_id' =>get_uid($_GET['token']),
		'from_nickname' => user_auth()['username']
	];
	$res = db('answer')->insert($data);
	if(!$res){
		return rejson(0,'失败');
	}
	return rejson(1,'success',null);
}

// 5.查看
 public function view(){
 	$id = 1;
 	$res = db('question')->where('id','=',$id)->setInc('viewnum');
 	if(!$res){
 		return rejson(0,'失败');
 	}
 	return rejson(1,'成功');

 }

 //6.点赞  --跟建筑圈点赞一致

//问答详情 --
//
//1.问答详情单页信息
public function question_info(){
	$id = 1;
	$field = 'b.headimg,b.nickname,a.createtime,a.content,a.thumb,a.comnum,a.viewnum,a.colnum';
	$data = db('question')->alias('a')->join('ys_admin_user b','b.id = a.uid')->where('a.id','=',$id)->field($field)->find();
	if(!$data){
		return rejson(0,'失败');
	}
	return rejson(1,'成功',$data);
}

//2.追问
public function qu_comment_add(){
	$data = [
		'questionid' =>input('questionid'),
		'pid' => input('pid'),
		'to_id' => input('to_id'),
		'to_nickname' => input('to_nickname'),
		'content' => input('content'),
		'from_id' =>get_uid($_GET['token']),
		'from_nickname' => user_auth()['username']
	];
	$res = db('answer')->insert($data);
	if(!$res){
		return rejson(0,'失败');
	}
	return rejson(1,'success',null);

}
// 4.热门问答列表 --跟建筑圈的热门一致
public function hot_question_list(){

}

//5.设置为最佳答案
public function set_best_answer(){
	// if(request()->ispost()){
		$id = 1;
		$res = db('answer')->where('id','=',$id)->setField('bestanswer',1);
		if(!$res){
			return rejson(0,'失败');
		}	
		return rejson(1,'成功');
	// }
}
//6.取消最佳答案
//
public function cancel_best_answer(){
		if(request()->ispost()){
		$id = input('id');
		$res = db('answer')->where('id','=',$id)->setField('bestanswer',0);
		if(!$res){
			return rejson(0,'失败');
		}
		return rejson(1,'成功');
	}

}
// 6.取消网友推荐
// public function cancel_net_answer(){
// }
// 取消这个功能
 


 // 6.提问的答复列表 --跟问答的答复列表一致
 // 
 public function answer_list(){

 }

 //删除提问
 
public function question_delete(){
	if(request()->ispost()){
		$id = input('id');
		$res = db('question')->where('id','=',$id)->setField('isdel',1);
	}
	if(!$res){
		return rejson(0,'失败');
	}
	return rejson(1,'成功');
}
//8提问表顶置
public function question_overhead(){
	if(request()->ispost()){
		$id = input('id');
		$time = time();
		$re = db('question')->where('id','=',$id)->setField('createtime',$time);
		if(!$re){
			return rejson(0,'失败');
		}
		return rejson(1,'success');
	}
}

//9举报  ----跟建筑圈方法一致，操作的表不同
  public function question_report(){
    $id = input('relationshiid');
    $report = input('report_type');
    $val = db('question')->where('id','=',$id)->value('report');
    $val = $val.','.$report;
    $re = db('relationship')->where('id','=',$id)->update(['report',$val]);
    if(!$re){
      return rejson(0,'举报失败');
    }
    return rejson(1,'success',null);
  }

/**
 * 建筑圈--需求模块
 * @author qwx <1042096282@qq.com>
 */
//1.发布需求
public function need_add(){
	$data = [
		'content' => input('content'),
		'needtype' => input('needtype'),
		'uid' =>get_uid($_GET['token']),
		'createtime' => time()
	];
	$res = db('need')->insert($data);
	if(!$res){
		return rejson(0,'失败');
	}
	return rejson(1,'成功');
}
//2.搜索标签
public function tag(){
$tag = '生产需求';
$tagname = '%'.$tag.'%';
$str = substr($tag,0,6);

$data = db('tags')->where('tagname','like',$tagname)->find();
if(!$data){
		$str = '%'.$str.'%';

		// var_dump($str);exit;
		$res = db('tags')->where('tagname','like',$str)->find();
		if($res){
			db('tags')->where('id','=',$res['id'])->setInc('toptrending');
			exit;
		}else{
		$d = ['tagname' => $tag];
		db('tags')->insert($d);
		}
	}
	db('tags')->where('id','=',$data['id'])->setInc('toptrending');
}



//2.需求列表  --跟建筑圈的需求列表一致
public function need_list(){

}

//3.用户登录
public function user_login(){
	
	$username = input('username');
	$password = input('password');
	$data = db('backuser')->where('username','=',$username)->find();
	if(!$data){
		return rejson(0,'用户名不存在，请注册使用！');
	}
	$psw =$data['username'];
	if($psw == $password){
		return rejson(1,'success');
	}else{
		return rejson(0,'密码错误,请再次输入！');
	}
}



/**
 *用户信息存入session,从session拿出用户信息
 * @param    string   cookie("PHPSESSID")
 * @return   stringcookie("PHPSESSID")
 * @author  qwx <1042096282@qq.com>
 */

/*知识库*/
// 1.知识库首页banner图列表
public function banner_list(){
	if(!input('codeid')){return rejson(0,'参数错误');} 
	 $arr = explain_codeid(input('codeid')); 
     $tbn= $arr['tbn'];
     $curPage = input('curPage')?input('curPage'):1;
     $listnum = input('listnum')?input('listnum'):10;
     $where['isdel']=['=','0'];
     $total = Db::name($tbn)->where($where)->count();
     $pages = ceil($total/$listnum);
     $data = db($tbn)->where($where)->select();
     if(!$data){
     	return rejson(0,'失败');
     }
     return rejson(1,'成功',$data);
}

//2.知识库栏目分类一
public function column_one(){
	if(!input('codeid')){return rejson(0,'参数失败');}
	$arr = explain_codeid(input('codeid'));
	$tbn = $arr['tbn'];
	$curPage = input('curPage')?input('curPage'):1;
	$listnum = input('listnum')?input('listnum'):10;
	$where = 'isdel = 0 AND type = video';
	$total = Db::name($tbn)->where($where)->count();
    $pages = ceil($total/$listnum);
    $field = 'thumb,title';
    $data = db($tbn)->where($where)->field($field)->order('createtime desc')->limit($listnum)->page($curPage)->select();
    if(!$data){
    	return rejson(0,'失败');
    }
    $arr = array('pages' =>$pages,'datalist' => $data,'total'=>$total);
    return rejson(1,'成功',$arr);
}

//3.宇衫基本信息 公共接口不在重写


//4.热门标签
public function hot_tag(){
	$where['isdel'] = ['=','0'];
	$data = db('hottag')->where($where)->order('level desc,hotnum desc')->limit(10)->field('tagname')->select();
	if(!$data){
		return rejson(0,'失败');
	}
	return rejson(1,'成功',$data);
}
//4.1 热门标签写入
/**
 * [hottag_add description]
 * @param  [type] $str 传入数据的tag
 */
 public function hottag_add($str){
	$arr = explode(';',$str);
	foreach($arr as $key => $value){
		$tagname = $value;
		$res = db('hottag')->where('tagname','=',$tagname)->find();
		if(!$res){
			$result = db('hottag')->insert(['tagname'=>$tagname]);
			if(!$result){return false;}
		}else{
			$result = db('hottag')->where('tagname','=',$tagname)->setInc('hotnum');
			if(!$result){return false;}
		}	
	}
}
//4.2热门标签写入--搜索记录
public function hottag_addbysearch(){
	$tagname = input('tagname');
	$res = db('hottag')->where('tagname','=',$tagname)->find();
	if(!$res){
		$result = db('hottag')->insert(['tagname'=>$tagname]);
		if(!$result){return false;}
	}else{
		$result = db('hottag')->where('tagname','=',$tagname)->setInc('hotnum');
		if(!$result){return false;}
	}
}


//5.知识库栏目分类二
public function column_two(){
	if(!input('codeid')){return rejson(0,'参数失败');}
	$arr = explain_codeid(input('codeid'));
	$tbn = $arr['tbn'];
	$curPage = input('curPage')?input('curPage'):1;
	$listnum = input('listnum')?input('listnum'):10;
	$where = 'isdel = 0 AND type = article';
	$total = Db::name($tbn)->where($where)->count();
    $pages = ceil($total/$listnum); 
    $field = 'thumb,title';
    $data = db($tbn)->where($where)->field($field)->order('createtime desc')->limit($listnum)->page($curPage)->select();
    if(!$data){
    	return rejson(0,'失败');
    }
    $arr = array('pages' =>$pages,'datalist' => $data,'total'=>$total);
    return rejson(1,'成功',$arr);
}

//6.热门干货列表
public function hotknow_list(){
	if(!input('codeid')){return rejson(0,'参数失败');}
	$arr = explain_codeid(input('codeid'));
	$tbn = $arr['tbn'];
	$curPage = input('curPage')?input('curpage'):1;
	$listnum = input('listnum')?input('listnum'):10;
	$where['isdel'] = ['=','0'];
	$total = Db::name($tbn)->where($where)->count();
	$pages = ceil($total/$listnum);
	$field = 'thumb,title,createtime';
	$data = db($tbn)->where($where)->field($field)->order('thumbcount desc')->limit($listnum)->page($curPage)->select();
	if(!$data){
		return rejson(0,'失败');
	}
	$arr = array('pages' =>$pages,'datalist' => $data,'total'=>$total);
	return rejson(1,'成功',$arr);
}

/**
 *知识库视频详情页
 */
//1.知识库视频详情信息
public function know_info(){
   if(!input('id')){return rejson('参数错误');}
	$id = input('id');
	$field = 'b.username,a.title,a.createtime,a.thumb,a.content,a.url,a.tag,a.collectnum,a.thumbcount';
	$data = db('know')->alias('a')->join('ys_admin_user b','b.id = a.uid')->where('a.id','=',$id)->field($field)->find();
	if(!$data){
		return rejson(0,'失败');
	}
	return rejson(1,'成功',$data);
  }
 
//2.知识库视频详情评论添加
  public function know_comment_add(){
    if(Request()->ispost()){
      $data = [
        "knowid" => input('knowid'),//建筑圈id
        "pid" => input('pid'),
        "to_id" => input('to_id'),
        "to_nickname" => input('to_nickname'),
        "content" => input('content'),
        "from_id" => get_uid($_GET['token']),//当前登录用户的id
        "from_name" => session('username'),//当前的登录用户名
      ];
      $res = db('know_comment')->insert($data);
      if(!$res){
        return rejson(0,'失败');
      }

      return rejson(1,'success',null);

    }
  }

//3.知识库详情评论列表
public function know_comment(){
	if(!input('codeid')){return rejson(0,'参数失败');}
	$arr = explain_codeid(input('codeid'));
	$tbn = $arr['tbn'];
	$knowid = input('knowid');
	$curPage = input('curPage')?input('curpage'):1;
	$listnum = input('listnum')?input('listnum'):10;
	$where = "isdel = 0 AND knowid = $knowid";
	$total = db('know_comment')->where($where)->count();
	$pages = ceil($total/$listnum);
	$field = 'b.headimg,b.username,a.content';
	$data = db('know_comment')->alias('a')->join('ys_admin_user b','b.id = a.uid')->where("a.isdel = 0 AND a.knowid = $knowid")->field($field)->page($curPage)->limit($listnum)->order('a.createtime desc')->select();
	if(!$data){
		return rejson(0,'错误');
	}
	$arr = array('pages' =>$pages,'datalist' => $data,'total'=>$total);
	return rejson(1,'成功',$arr);
}

//4.点赞
 public function know_thumbcount(){
     $id = input('id');
     $uid = get_uid($_GET['token']);  //当前登录用户的id
     $data = db('know')->where('id','=',$id)->find();
     $user = explode(",", $data['zanUser']);
     if(in_array($uid, $user)){
      return rejson(0,'您已经点过赞了！');
     }
     $data['zanUser'] = $data['zanUser'].','.$uid ;
     $thumbcount = db('know')->where('id','=',$id)->value('thumbcount');

     $data['thumbcount'] += 1;
     $res = db('know')->where('id','=',$id)->update($data);
     if(!$res){
      return rejson(0,'点赞失败');
     }
     return rejson(1,'成功');
  }


  //5.知识库收藏
  public function know_collect(){
    $id = input('id');
    $uid = get_uid($_GET['token']);//当前登录用户的id
    $data = db('know')->where('id','=',$id)->find();
    $user = explode(",", $data['collectUser']);
    if(in_array($uid, $user)){
      return rejson(0,'您已经收藏了！');
     }
    $data['collectUser'] = $data['collectUser'].','.$uid;
    $res = db('know')->where('id','=',$id)->update($data);
     if(!$res){
      return rejson(0,'收藏失败');
     }
     return rejson(1,'成功');
  }

  /**
   * 知识库文章发布
   */
  //1.知识库干货发布-文档
  public function info_publish_article(){
  	if(Request()->isPost()){
  		$data = [
	  		'title'=>input('title'),
	  		'type'=>input('type'),
	  		'tag'=>input('tag'),
	  		'content'=>input('content')	
  		];
  		//此处将前端传来的tag内容同步保存到hottag表
  		if(!empty($data['tag'])){
			$arr = explode(';',$data['tag']);
			foreach($arr as $key => $value){
			$tagname = $value;
		    $res = db('hottag')->where('tagname','=',$tagname)->find();
		        if(!$res){
			          $result = db('hottag')->insert(['tagname'=>$tagname]);
			          if(!$result){return false;}
		        }else{
			          $result = db('hottag')->where('tagname','=',$tagname)->setInc('hotnum');
			          if(!$result){return false;}
		        }	
            }
  		}
  		//判断是否有上传文件
  		$url = request()->file('file');
  		if(!$url==null){
   			$info = $file->move(ROOT_PATH . 'public/static' . DS . '/uploads');	
   			$data['url'] = '/static/uploads/'.date('Ymd').'/'.$info->getFilename();
  		}
  		$data['url'] = null;
  		$res = db('know')->insert($data);
  		if(!$res){
  			return rejson(0,'失败');
  		}
  		return rejson(1,'成功');
  	}
  }

/**
 * 知识库文章详情---跟之前视屏视频一致
 */

/**
 * 知识库干货发布-视频 --跟文档一致
 */














































































































public function test(){

// $hex='00100018';
// $bin=base_convert($hex, 16, 2);
// $bin=strrev($bin);
// for ($i=0; $i <strlen($bin) ; $i++) { 
// 	if(!isset($data['status'])){
// 		if($bin[$i]==1&&$i==0)$data['status']=0;//低电状态
// 		if($bin[$i]==1&&$i==1)$data['status']=1;//出围栏状态
// 		if($bin[$i]==1&&$i==2)$data['status']=2;//进围栏状态
// 		if($bin[$i]==0&&$i==3)$data['status']=3;//手环戴上状态
// 		if($bin[$i]==1&&$i==4)$data['status']=4;//手表运行静止状态
// 		if($bin[$i]==1&&$i==3)$data['status']=5;//手环取下状态
// 	}else{
// 		if($bin[$i]==1&&$i==0)$data['status'].=',0';//低电状态
// 		if($bin[$i]==1&&$i==1)$data['status'].=',1';//出围栏状态
// 		if($bin[$i]==1&&$i==2)$data['status'].=',2';//进围栏状态
// 		if($bin[$i]==0&&$i==3)$data['status'].=',3';//手环戴上状态
// 		if($bin[$i]==1&&$i==4)$data['status'].=',4';//手表运行静止状态
// 		if($bin[$i]==1&&$i==3)$data['status'].=',5';//手环取下状态
// 	}
// 	if($bin[$i]==1&&$i==16)$data['type']=4;//求救报警
// 	if($bin[$i]==1&&$i==17)$data['type']=4;//低电报警
// 	if($bin[$i]==1&&$i==18)$data['type']=4;//出围栏报警
// 	if($bin[$i]==1&&$i==19)$data['type']=4;//进围栏报警
// 	if($bin[$i]==1&&$i==20)$data['type']=4;//手环拆除报警
// }

// return json($data);

// 	$str='2017年4月12日';
// 	$str=str_replace('年','-',$str);
// 	$str=str_replace('月','-',$str);
// 	$str=str_replace('日','',$str);
// return json(strtotime($str));

// preg_match_all('/\[(.*?)\]/is','[3G*4700564253*0008*LK,0,0,4][3G*4700564253*0161*UD2,010817,104718,A,22.568578,N,113.8903600,E,0.00,303.2,0.0,9,88,9,0,0,00000001,7,255,460,1,9537,4946,142,9537,4944,140,9537,4964,131,9537,4945,131,9537,4524,126,9537,4525,123,9537,4526,122,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-59,santalland,bc:d1:77:96:1:8e,-77,maixiang,88:25:93:f6:a6:66,-77,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-85,20.1][3G*4700564253*0155*UD2,010817,104729,A,22.568573,N,113.8903183,E,4.11,3.1,0.0,8,100,9,0,0,00000001,7,0,460,1,9537,4946,140,9537,4944,138,9537,4945,134,9537,4964,134,9537,4154,125,9537,4524,125,9537,4526,123,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-64,maixiang,88:25:93:f6:a6:66,-78,santalland,bc:d1:77:96:1:8e,-80,WHJYH,dc:ef:9:1:c2:b0,-86,20.3][3G*4700564253*015B*UD2,010817,104739,A,22.568568,N,113.8903100,E,0.00,191.7,0.0,8,90,9,0,0,00000001,7,255,460,1,9537,4946,142,9537,4944,138,9537,4964,135,9537,4945,130,9537,4524,125,9537,4525,124,9537,4154,123,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-63,maixiang,88:25:93:f6:a6:66,-81,WHJYH,dc:ef:9:1:c2:b0,-86,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-87,19.4][3G*4700564253*0161*UD2,010817,104750,A,22.568433,N,113.8903767,E,2.28,162.3,0.0,8,96,9,0,0,00000001,7,255,460,1,9537,4946,138,9537,4944,139,9537,4964,135,9537,4945,131,9537,4525,125,9537,4526,124,9537,4154,124,5,yushan22,dc:fe:18:e4:6a:3e,-55,HT_AP0,0:c:43:26:60:40,-63,santalland,bc:d1:77:96:1:8e,-78,maixiang,88:25:93:f6:a6:66,-78,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-86,19.4][3G*4700564253*015C*UD2,010817,104800,A,22.568432,N,113.8903883,E,0.00,112.0,0.0,8,100,9,0,0,00000001,7,255,460,1,9537,4946,144,9537,4944,137,9537,4964,134,9537,4945,130,9537,4525,123,9537,4524,123,9537,4526,121,5,yushan22,dc:fe:18:e4:6a:3e,-52,HT_AP0,0:c:43:26:60:40,-63,maixiang,88:25:93:f6:a6:66,-76,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-84,WHJYH,dc:ef:9:1:c2:b0,-86,18.8][3G*4700564253*0162*UD2,010817,104811,A,22.568432,N,113.8903883,E,0.00,112.0,0.0,9,100,9,0,0,00000001,7,255,460,1,9537,4946,147,9537,4964,137,9537,4944,137,9537,4945,136,9537,4525,125,9537,4524,123,9537,4154,122,5,yushan22,dc:fe:18:e4:6a:3e,-55,HT_AP0,0:c:43:26:60:40,-58,maixiang,88:25:93:f6:a6:66,-74,santalland,bc:d1:77:96:1:8e,-77,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-84,18.5][3G*4700564253*0161*UD2,010817,104821,A,22.568418,N,113.8904350,E,2.90,28.1,0.0,9,100,9,0,0,00000001,7,0,460,1,9537,4946,146,9537,4945,144,9537,4964,137,9537,4944,134,9537,4154,127,9537,4525,126,9537,4526,121,5,yushan22,dc:fe:18:e4:6a:3e,-54,maixiang,88:25:93:f6:a6:66,-78,santalland,bc:d1:77:96:1:8e,-79,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-87,yangxi,30:fc:68:8c:34:94,-90,18.8][3G*4700564253*0165*UD2,010817,104831,A,22.568473,N,113.8904700,E,0.00,109.6,0.0,9,98,9,0,0,00000001,7,255,460,1,9537,4946,142,9537,4945,143,9537,4944,137,9537,4964,131,9537,4154,128,9537,4525,125,9537,4526,122,5,yushan22,dc:fe:18:e4:6a:3e,-56,HT_AP0,0:c:43:26:60:40,-58,santalland,bc:d1:77:96:1:8e,-80,ChinaNet-q6yv,0:bd:82:3:41:34,-85,TP-LINK_NG420 ,a8:57:4e:eb:a:76,-87,18.4][3G*4700564253*015F*UD2,010817,104842,A,22.568473,N,113.8904700,E,0.00,109.6,0.0,9,98,9,0,0,00000001,7,0,460,1,9537,4946,144,9537,4945,143,9537,4944,136,9537,4964,133,9537,4154,128,9537,4525,124,9537,4526,120,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-61,maixiang,88:25:93:f6:a6:66,-76,santalland,bc:d1:77:96:1:8e,-78,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-85,18.8][3G*4700564253*0159*UD2,010817,104852,A,22.568543,N,113.8904333,E,6.09,25.9,0.0,10,100,9,0,0,00000001,7,0,460,1,9537,4946,144,9537,4945,143,9537,4944,137,9537,4964,133,9537,4525,126,9537,4154,125,9537,4524,122,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-60,maixiang,88:25:93:f6:a6:66,-73,ChinaNet-q6yv,0:bd:82:3:41:34,-86,WHJYH,dc:ef:9:1:c2:b0,-89,19.6][3G*4700564253*0150*UD2,010817,104902,A,22.568698,N,113.8904000,E,8.86,9.0,0.0,9,100,9,0,0,00000001,6,0,460,1,9537,4946,145,9537,4945,139,9537,4944,135,9537,4964,133,9537,4525,121,9537,4524,121,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-56,maixiang,88:25:93:f6:a6:66,-74,santalland,bc:d1:77:96:1:8e,-77,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-82,20.0][3G*4700564253*0156*UD2,010817,104912,A,22.568663,N,113.8904233,E,2.42,47.8,0.0,7,100,9,0,0,00000001,6,0,460,1,9537,4946,147,9537,4945,139,9537,4944,133,9537,4964,131,9537,4525,123,9537,4524,121,5,yushan22,dc:fe:18:e4:6a:3e,-53,HT_AP0,0:c:43:26:60:40,-60,santalland,bc:d1:77:96:1:8e,-75,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-84,TP-LINK_NG420 ,a8:57:4e:eb:a:76,-86,20.8][3G*4700564253*0154*UD2,010817,104922,A,22.568607,N,113.8904583,E,0.00,97.6,0.0,8,100,9,0,0,00000001,6,0,460,1,9537,4946,147,9537,4945,137,9537,4964,132,9537,4944,132,9537,4525,125,9537,4062,119,5,yushan22,dc:fe:18:e4:6a:3e,-56,HT_AP0,0:c:43:26:60:40,-60,santalland,bc:d1:77:96:1:8e,-78,ChinaNet-q6yv,0:bd:82:3:41:34,-83,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-84,20.0][3G*4700564253*0143*UD2,010817,104933,A,22.568563,N,113.8905117,E,1.98,37.2,0.0,9,100,4,0,0,00000001,5,0,460,1,9537,4946,147,9537,4944,136,9537,4945,135,9537,4964,133,9537,4525,125,5,yushan22,dc:fe:18:e4:6a:3e,-55,HT_AP0,0:c:43:26:60:40,-62,santalland,bc:d1:77:96:1:8e,-75,maixiang,88:25:93:f6:a6:66,-80,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-84,20.3][3G*4700564253*0143*UD2,010817,104943,A,22.568558,N,113.8905300,E,0.00,28.8,0.0,8,100,4,0,0,00000001,5,0,460,1,9537,4946,147,9537,4944,139,9537,4945,136,9537,4964,134,9537,4525,126,5,yushan22,dc:fe:18:e4:6a:3e,-55,HT_AP0,0:c:43:26:60:40,-64,maixiang,88:25:93:f6:a6:66,-78,santalland,bc:d1:77:96:1:8e,-78,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-81,20.3][3G*4700564253*0147*UD2,010817,104953,A,22.568553,N,113.8905167,E,2.31,225.0,0.0,10,100,4,0,0,00000001,5,255,460,1,9537,4946,142,9537,4945,135,9537,4944,131,9537,4964,130,9537,4525,125,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-63,maixiang,88:25:93:f6:a6:66,-78,santalland,bc:d1:77:96:1:8e,-78,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-87,20.6][3G*4700564253*0161*UD2,010817,105003,A,22.568485,N,113.8904283,E,6.05,238.0,0.0,10,98,4,0,0,00000001,7,255,460,1,9537,4946,139,9537,4945,141,9537,4964,131,9537,4944,130,9537,4525,123,9537,4526,121,9537,4062,116,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-58,santalland,bc:d1:77:96:1:8e,-76,maixiang,88:25:93:f6:a6:66,-77,ChinaNet-q6yv,0:bd:82:3:41:34,-84,21.3][3G*4700564253*015E*UD2,010817,105014,A,22.568420,N,113.8904667,E,0.00,306.6,0.0,8,82,4,0,0,00000001,7,0,460,1,9537,4946,144,9537,4944,135,9537,4964,133,9537,4945,130,9537,4525,123,9537,4062,122,9537,4524,121,5,yushan22,dc:fe:18:e4:6a:3e,-52,HT_AP0,0:c:43:26:60:40,-65,santalland,bc:d1:77:96:1:8e,-78,ChinaNet-q6yv,0:bd:82:3:41:34,-81,maixiang,88:25:93:f6:a6:66,-85,22.7][3G*4700564253*0156*UD2,010817,105024,A,22.568458,N,113.8904767,E,0.00,351.9,0.0,8,100,4,0,0,00000001,7,0,460,1,9537,4946,146,9537,4944,136,9537,4945,136,9537,4964,133,9537,4525,125,9515,48616,125,9537,4062,121,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-69,santalland,bc:d1:77:96:1:8e,-80,maixiang,88:25:93:f6:a6:66,-82,ATT,fc:d7:33:1:3:c6,-87,23.4][3G*4700564253*015F*UD2,010817,105034,V,22.568513,N,113.8905583,E,3.72,42.9,0.0,8,100,4,0,0,00000001,7,0,460,1,9537,4946,146,9537,4945,135,9537,4964,135,9537,4944,134,9515,48616,125,9537,4524,125,9537,4062,120,5,yushan22,dc:fe:18:e4:6a:3e,-56,HT_AP0,0:c:43:26:60:40,-64,maixiang,88:25:93:f6:a6:66,-79,ChinaNet-q6yv,0:bd:82:3:41:34,-82,santalland,bc:d1:77:96:1:8e,-83,26.3]
// [3G*4700564253*0162*UD2,010817,105044,A,22.568543,N,113.8905600,E,3.26,10.8,0.0,8,100,4,0,0,00000001,7,0,460,1,9537,4946,145,9537,4944,137,9537,4964,135,9537,4945,132,9515,48616,125,9537,4524,123,9537,4062,120,5,yushan22,dc:fe:18:e4:6a:3e,-54,HT_AP0,0:c:43:26:60:40,-65,ChinaNet-q6yv,0:bd:82:3:41:34,-82,maixiang,88:25:93:f6:a6:66,-82,ChinaNet-GYQF,e0:30:5:8e:f5:d2,-87,24.9]
// [3G*4700564253*015D*UD,010817,105054,V,22.568553,N,113.8905450,E,0.00,1.3,0.0,8,100,4,0,0,00000001,7,0,460,1,9537,4946,145,9537,4944,140,9537,4945,139,9537,4964,128,9537,4154,127,9515,48616,125,9537,4524,120,5,yushan22,dc:fe:18:e4:6a:3e,-53,HT_AP0,0:c:43:26:60:40,-68,santalland,bc:d1:77:96:1:8e,-78,maixiang,88:25:93:f6:a6:66,-78,ChinaNet-q6yv,0:bd:82:3:41:34,-84,26.2]',$array);



// foreach ($array[1] as $key => &$value) {
// 	//str_replace("\""," ",$value);
// 	$value=explode(",",$value);
	
// }

// return json($array[1]);

// 	return json(ossupload::get());


// 	   //  $iat = time();
// 	   //  $exp = $iat+12000;


// 	   // $token = array(
// 	   //      "iss" => "http://api.ysjianzhu.com",
// 	   //      "aud" => "http://zhaopin.ysjianzhu.com",
//     //         "iat" => $iat,
//     //         "exp" => $exp,
// 	   //      "nbf" => '',
// 	   //      "uuid"=>'53f2c24f-49a5-a496-8639-f833c012ced5'
// 	   //  );

// 	   // $t=settoken($token);
// 	   // $data=explaintoken($t);
// 	   // $where['uuid']=$data->uuid;
// 	   // $d=get_data('admin_user',$where);

// 	   // return json($d);




	  $where2['tbname']=['=','relationship'];
      $data2=get_data('system_conf',$where2);
      $num=$data2['tbnum'];

  $data=get_datalist('relationship');
  return json(set_codeid($data,$num));
}




}
