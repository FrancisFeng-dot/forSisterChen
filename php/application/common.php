<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  
// +----------------------------------------------------------------------
use think\Request;
use think\View;
use think\Db;
use think\Session;
use think\Loader; 
use jwt\JWT; 
define("TOKEN2","linxcABCDEFGHIJGJJ");
define("Appid2","wx3edf97fba911c055");
define("AppSecret2","069f867e0970e0d563abbbe80b84ffc3");
// 配置验证器
/**
 * minishop md5加密方法
 * @author wyl  
 */
function yscheck($data)
{
  
$rule = [
        'group_name' => 'require',
        ];


$msg = [
        'group_name.require'  => '用户组不能为空',
       ]; 


    $validate = Loader::validate($data,$rule,$msg);
    $validate->loadLang();
    // 验证
    if(!$validate->check($data)){ 
        echo json_encode(['code'=>'0','msg'=>$validate->getError()]);
        exit(); 
    } 

     
}
function getFirstChar($s){  
    mb_internal_encoding("UTF-8");
    $s0 = mb_substr($s,0,1);           //获取名字的姓  
    $s = iconv('UTF-8','gb2312', $s0);       //将UTF-8转换成GB2312编码  
    if (ord($s0)>128) {                      //汉字开头，汉字没有以U、V开头的  
        $asc=ord($s{0})*256+ord($s{1})-65536;  
        if($asc>=-20319 and $asc<=-20284)return "A";  
        if($asc>=-20283 and $asc<=-19776)return "B";  
        if($asc>=-19775 and $asc<=-19219)return "C";  
        if($asc>=-19218 and $asc<=-18711)return "D";  
        if($asc>=-18710 and $asc<=-18527)return "E";  
        if($asc>=-18526 and $asc<=-18240)return "F";  
        if($asc>=-18239 and $asc<=-17760)return "G";  
        if($asc>=-17759 and $asc<=-17248)return "H";  
        if($asc>=-17247 and $asc<=-17418)return "I";              
        if($asc>=-17417 and $asc<=-16475)return "J";               
        if($asc>=-16474 and $asc<=-16213)return "K";               
        if($asc>=-16212 and $asc<=-15641)return "L";               
        if($asc>=-15640 and $asc<=-15166)return "M";               
        if($asc>=-15165 and $asc<=-14923)return "N";               
        if($asc>=-14922 and $asc<=-14915)return "O";               
        if($asc>=-14914 and $asc<=-14631)return "P";               
        if($asc>=-14630 and $asc<=-14150)return "Q";               
        if($asc>=-14149 and $asc<=-14091)return "R";               
        if($asc>=-14090 and $asc<=-13319)return "S";               
        if($asc>=-13318 and $asc<=-12839)return "T";               
        if($asc>=-12838 and $asc<=-12557)return "W";               
        if($asc>=-12556 and $asc<=-11848)return "X";               
        if($asc>=-11847 and $asc<=-11056)return "Y";               
        if($asc>=-11055 and $asc<=-10247)return "Z";   
    }else if(ord($s)>=48 and ord($s)<=57){ //数字开头  
        switch(iconv_substr($s,0,1,'utf-8')){  
            case 1:return "Y";  
            case 2:return "E";  
            case 3:return "S";  
            case 4:return "S";  
            case 5:return "W";  
            case 6:return "L";  
            case 7:return "Q";  
            case 8:return "B";  
            case 9:return "J";  
            case 0:return "L";  
        }                 
    }else if(ord($s)>=65 and ord($s)<=90){ //大写英文开头  
        return substr($s,0,1);  
    }else if(ord($s)>=97 and ord($s)<=122){ //小写英文开头  
        return strtoupper(substr($s,0,1));  
    }  
    else  
    {  
        return iconv_substr($s0,0,1,'utf-8');  
        //中英混合的词语，不适合上面的各种情况，因此直接提取首个字符即可  
    }  
}  

//封装设置token
function settoken($obj){
$key = config('tokenkey');    
return JWT::encode($obj, $key);
// sub: 该JWT所面向的用户
// iss: 该JWT的签发者
// iat(issued at): 在什么时候签发的token
// exp(expires): token什么时候过期
// nbf(not before)：token在此时间之前不能被接收处理
// jti：JWT ID为web token提供唯一标识
// $key = config('tokenkey');
// $token = array(
//     "iss" => "http://api.ysjianzhu.com",
//     "aud" => "http://zhaopin.ysjianzhu.com",
//     "iat" => 1356999524,
//     "nbf" => 1357000000
// );
// $jwt =  JWT::encode($token, $key);                     //对json进行加密
// $decoded = JWT::decode($jwt, $key, array('HS256'));    //对json进行解密
// print_r($decoded);  
}


//解析token
function explaintoken($str){
   $key = config('tokenkey');
   return JWT::decode($str, $key, array('HS256')); 

}

/**
 * 创建uuid,系统内唯一标识符
 * @author wyl <181984609@qq.com>
 */
function create_uuid()
{
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
    return $uuid;
}


 

/**
 * 获取uuid,系统内唯一标识符
 * @author tangtanglove <dai_hang_love@126.com>
 */
function get_uuid($model,$map)
{
    return Db::name($model)->where($map)->value('uuid');
}




// 公共调用，使用rejson(参数，参数，参数)进行调用
function rejson($code=0,$msg='',$data='',$arr=''){
        return json(['code'=>$code,'msg'=>$msg,'data'=>$data,'arr'=>$arr]); 
    }











 //配置数据表
function gettable($sub=null)
{
    $where['tbnum'] = ['=',$sub];
    $data = get_data('system_conf',$where); 
    return ['tbn'=>$data['tbname'],'id'=>$data['tbid'],'kws'=>$data['tbkeywords']];  
}

 

    function p($array){
        dump($array,1,'<pre>',0,'</pre>');
        exit;
    }
 //配置各个页面的codeid
function set_comview()
{
   $data = get_datalist('system_conf'); 
   $obj = array();
   foreach ($data as $key => &$value) {
       $code = $value['tbnum'].'*';
       $obj[$value['tbcodestr']] = jiami($code);
   } 
    return $obj; 
}


 //配置后台的codeid
function set_comview_admin()
{
   $data = get_datalist('system_conf'); 
   $obj = array();
   foreach ($data as $key => &$value) {
       $code = $value['tbnum'].'*';
        $vx = 'c'.$value['tbnum'];
       $obj[$vx] = jiami($code);
   } 
    return $obj; 
}



 //提供给前台的  配置各个页面的codeid
function set_comview_index()
{
  
   $data = get_datalist('system_conf'); 
   $obj = array();
   foreach ($data as $key => &$value) {
       $code = $value['tbnum'].'*'; 
        $obj[$value['tbcodestr']] = $value['adminonly']==0?jiami($code):'';
       
       
   } 
    return $obj; 
}



 // 算法类——公共函数**************************************************************************************************
 
/**
 *通过url 获取json数据
 * @param    string   $address     "json/pc/admin/menu.json" 
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
function getjson($url){ 
	// 从文件中读取数据到PHP变量
	$json_string = file_get_contents($url); 
	// 把JSON字符串转成PHP数组
	$data = json_decode($json_string, true);
	return $data; 
}



/**
 *创建盐
 * @param    string   
 * @return   string
 * @author  wyl <181984609@qq.com>
 */
function create_salt($length=-6)
{
    //return '111111';
    return $salt = substr(uniqid(rand()), $length);
}

/**
 *宇杉md5加密
 * @param    string   
 * @return   string
 * @author  wyl <181984609@qq.com>
 */
function ys_md5($string,$salt)
{
    return md5(md5($string).$salt);
}

/**
 *用户信息存入session,从session拿出用户信息
 * @param    string   cookie("PHPSESSID")
 * @return   stringcookie("PHPSESSID")
 * @author  wyl <181984609@qq.com>
 */
function user_auth($data=null){  
    if($data===null){
        return session('admin_sessid'); 
    }else{
        session('admin_sessid',$data); 
        return true; 
    } 
}; 


//处理token
function check_token($token){
    $data=explaintoken($token);
    $where['uuid']=$data['uuid'];
    $d=get_data('templogin',$where);
    if(!$d)return false;
    if(ceil((time()-$d['createtime'])/86400)>3)return false;

    return true;
}

/**
 *宇杉 加密
 * @param    string   2*56    2是表的下标，56是表的id
 * @return   string
 * @author  wyl <181984609@qq.com>
 */
 function jiami($str){
     $userdata = user_auth();
     return encrypt($str,'E',$userdata['salt']); 
    }

/**
 *宇杉 解密
 * @param    string   
 * @return   string
 * @author  wyl <181984609@qq.com>
 */
function jiemi($str){
$userdata = user_auth(); 
return encrypt($str,'D',$userdata['salt']);
    }

function setdate($num=0,$all=null){ 
    //$a = strtotime('2015-12-26');1451059200 H:i:s
    if($all==null){
      $d = $num==0?'':date("Y-m-d", $num); 
    }else{
      $d = $num==0?'':date("Y-m-d H:i:s", $num);
    } 
    return $d;
}

    /**
     * 通过递归获取当前节点的所有子节点
     * @param  [type] $parent     [description]
     * @param  [type] $list       [description]
     * @param  [type] $data       [description]
     * @return [type]             [description]
     */
    function getSons($parent,$list,$data){
        if(hasSon($parent,$list)){
        	 
            //数有几个孩子
            $v = 0;
            foreach ($list as $key => $value) {

                if($parent['id'] == $value['pid']){
                    $v++;
                }
            }

            $j = 0;//计数用的
            foreach ($list as $key => &$value){

                if($parent['id'] == $value['pid']){
                    $j++;
                    $a = 2;
                    if($j==$v){ $a = 3;}  
$value['namelip'] = $parent['cstlip'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--'.$value['namelip']; 
$value['namestr'] = $parent['cststr'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/images/m'.$a.'.png">'.$value['namestr']; 
$value['cststr'] = $parent['cststr'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/images/m1.png">';
$value['cstlip'] = $parent['cstlip'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--';

                     
                    $data[] = $value;
                    $data = getSons($value,$list,$data);
                }
            }
        }
        return $data;
    }

    /**
     * 判断是否有次级菜单
     * @param  [type]  $parent [description]
     * @param  [type]  $list   [description]
     * @return boolean         [description]
     */
    function hasSon($parent,$list){
        foreach ($list as $key => &$value) {
            if($parent['id']==$value['pid']){
                return true;
            }
        }
        return false;
    }


/**
 *宇杉 生成codeid
 * @param    string   
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */ 
function set_codeid($arr,$num){
    $id = gettable($num)['id'];
    /*生成codeid同时，删除原始ID； 0*6  */ 
    foreach ($arr as &$value) {
        $value['codeid'] = jiami($num.'*'.$value[$id]); 

        //对各个表时间戳进行转换
        isset($value["createtime"])?$value['createtime'] = setdate($value['createtime'],true):"";
        isset($value["precreatetime"])?$value['precreatetime'] = setdate($value['precreatetime'],true):"";
        isset($value["addtime"])?$value['addtime'] = setdate($value['addtime'],false):"";
        isset($value["newstime"])?$value['newstime'] = date('m月n',$value['newstime']):"";
        isset($value["refreshtime"])?$value['refreshtime'] = setdate($value['refreshtime'],true):"";
        isset($value["starttime"])?$value['starttime'] = setdate($value['starttime'],true):"";
        isset($value["endtime"])?$value['endtime'] = setdate($value['endtime'],true):"";
        isset($value["zanTime"])?$value['zanTime'] = setdate($value['zanTime'],true):"";
  // p($value);      
        isset($value["updatetime"])?$value['updatetime'] = setdate($value['updatetime'],true):"";
        isset($value["last_search_time"])?$value['last_search_time'] = setdate($value['last_search_time'],true):"";
        // isset($value["last_logintime"])?$value['last_logintime'] = setdate($value['last_logintime'],true):"";
        isset($value["logintime"])?$value['logintime'] = setdate($value['logintime'],true):"";

        if(isset($value["content"])){
            $value["content"] = htmlspecialchars_decode($value["content"]);
        }

        if(isset($value["thumb"])){
            $value["thumbarr"] = explode(';',$value["thumb"]);

        }

    }  
    return $arr;
}
 
/**
 *宇杉 解析codeid
 * @param    string   
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
function explain_codeid($codeid){ 
    $code = jiemi($codeid); 
    if($code=='')return false;
        $num_star_idv_arr = explode("*",$code);
        $num = $num_star_idv_arr[0]; 
        $a = gettable($num); 
        $arr =array(
        'tbn'=>$a['tbn'],
        'id'=>$a['id'],
        'kws'=>$a['kws'],
        'idv'=>intval($num_star_idv_arr[1]),
        'num'=>$num, 
        ); 
return $arr;
} 
/**
 *宇杉 还原成真实的对象： codeid=989709ykhyku&name=guyuan ————————————>  [data=>[prid=>9,name=>guyuan],tbn=program]  
 * @param    string   
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
function real_data($post,$obj){
$tbn = $obj['tbn'];
$id = $obj['id'];
$idv = $obj['idv'];

unset($post['codeid']);  
unset($obj['tbn']);
unset($obj['id']);
unset($obj['idv']);
unset($obj['num']); 
$obj[$id] = $idv;
$newarr = array_merge($post,$obj); 
return array('tbn'=>$tbn,'data'=>$newarr);

}


/**
 *宇杉 还原成真实的对象： codeid=989709ykhyku&name=guyuan ————————————>  [data=>[prid=>9,name=>guyuan],tbn=program]  
 * @param    string   
 * @return   arr
 * @author  wyl <181984609@qq.com>
 */
function real_data_noid($post,$obj){
$tbn = $obj['tbn']; 

unset($post['codeid']); 
unset($post['tablecodeid']);
unset($obj['tbn']);
unset($obj['id']);
unset($obj['idv']);
unset($obj['num']); 
$newarr = array_merge($post,$obj); 
return array('tbn'=>$tbn,'data'=>$newarr);

}

//加工查询条件
function dealwhere($p=[]){
    $where = array();
    if(isset($p['name'])){unset($p['name']);}
    if(isset($p['top'])){unset($p['top']);}
    if(isset($p['listnum'])){unset($p['listnum']);}
    if(isset($p['curPage'])){unset($p['curPage']);}
    if(isset($p['keyword'])){unset($p['keyword']);}
    if(isset($p['begintime'])){unset($p['begintime']);}
    if(isset($p['endtime'])){unset($p['endtime']);}
    if(isset($p['orderstrid'])){unset($p['orderstrid']);}
    if(isset($p['codeid'])){unset($p['codeid']);}
    if(isset($p['debug'])){unset($p['debug']);}
    if(isset($p['debugkey'])){unset($p['debugkey']);}
    if(isset($p['diarystyle'])){unset($p['diarystyle']);}
    foreach ($p as $key => $value) { 
        $where[$key]=$value;
    }
    return $where; 
}


function dealorder($id){
    $arr='';
    if(!$id)return $arr; 
    $arr=[
    '1'=>'company_addtime desc',
    '2'=>'createtime desc',
    '3'=>'createtime asc',
    '4'=>'updatetime desc'
    ];


    return $arr[$id];
}




/*********************************************************************
函数名称:encrypt
函数作用:加密解密字符串
使用方法:
加密 :encrypt('str','E','qingdou');
解密 :encrypt('被加密过的字符串','D','qingdou');
参数说明:
$string   :需要加密解密的字符串
$operation:判断是加密还是解密:E:加密   D:解密
$key  :加密的钥匙(密匙);
*********************************************************************/
function encrypt($string,$operation,$key='')
{
$src  = array("/","+","=");
$dist = array("_a","_b","_c");
if($operation=='D'){$string  = str_replace($dist,$src,$string);}
$key=md5($key);
$key_length=strlen($key);
$string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
$string_length=strlen($string);
$rndkey=$box=array();
$result='';
for($i=0;$i<=255;$i++)
{
$rndkey[$i]=ord($key[$i%$key_length]);
$box[$i]=$i;
}
for($j=$i=0;$i<256;$i++)
{
$j=($j+$box[$i]+$rndkey[$i])%256;
$tmp=$box[$i];
$box[$i]=$box[$j];
$box[$j]=$tmp;
}
for($a=$j=$i=0;$i<$string_length;$i++)
{
$a=($a+1)%256;
$j=($j+$box[$a])%256;
$tmp=$box[$a];
$box[$a]=$box[$j];
$box[$j]=$tmp;
$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
}
if($operation=='D')
{
if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8))
{
return substr($result,8);
}
else
{
return'';
}
}
else
{
$rdate  = str_replace('=','',base64_encode($result));
$rdate  = str_replace($src,$dist,$rdate);
return $rdate;
}
}



/**
 *发送邮件
 * @param    string   $address       地址
 * @param    string    $title 标题
 * @param    string    $message 邮件内容
 * @param    string $attachment 附件列表
 * @return   boolean
 */
function send_mail($address, $title, $message, $attachment = null)
{
    Vendor('PHPMailer.class#phpmailer');

    $mail = new PHPMailer;
    //$mail->Priority = 3;
    // 设置PHPMailer使用SMTP服务器发送Email
    $mail->IsSMTP();
    // 设置邮件的字符编码，若不指定，则为'UTF-8'
    $mail->CharSet   = 'UTF-8';
    $mail->SMTPDebug = 0; // 关闭SMTP调试功能
    $mail->SMTPAuth  = true; // 启用 SMTP 验证功能
    // $mail->SMTPSecure = 'ssl';  // 使用安全协议
    $mail->IsHTML(true); //body is html

    // 设置SMTP服务器。
    $mail->Host = C('CFG_EMAIL_HOST');
    $mail->Port = C('CFG_EMAIL_PORT') ? C('CFG_EMAIL_PORT') : 25; // SMTP服务器的端口号

    // 设置用户名和密码。
    $mail->Username = C('CFG_EMAIL_LOGINNAME');
    $mail->Password = C('CFG_EMAIL_PASSWORD');

    // 设置邮件头的From字段
    $mail->From = C('CFG_EMAIL_FROM');
    // 设置发件人名字
    $mail->FromName = C('CFG_EMAIL_FROM_NAME');

    // 设置邮件标题
    $mail->Subject = $title;
    // 添加收件人地址，可以多次使用来添加多个收件人
    $mail->AddAddress($address);
    // 设置邮件正文
    $mail->Body = $message;
    // 添加附件
    if (is_array($attachment)) {
        foreach ($attachment as $file) {
            is_file($file) && $mail->AddAttachment($file);
        }
    }

    // 发送邮件。
    //return($mail->Send());
    return $mail->Send() ? true : $mail->ErrorInfo;
}

 
/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}











 //数据库类——公共函数*********************************************************************************************************
// 数据库增删改查一些方法


// 1、单表查询列表 返回数组[]；
    function get_datalist($tbn=null,$where=[],$field=null,$num=null,$sort=null){
        $data = Db::name($tbn);
        if($field){$data = $data->field($field);}
        $where['isdel']=['=','0'];
        $data = $data->where($where);
        if($num){$data = $data->limit($num);}        
        if($sort){$data = $data->order($sort);}
        $re = $data->select();   
        return $re;
    }
// 2、单表查询列表分页 返回对象  {datalist:[],total:35}；

    function get_datalist_page($tbn=null,$where=null,$curPage=null,$listnum=null,$order=null){
    
    $where['isdel']=['=','0'];

    $total = Db::name($tbn)->where($where)->count();
   // p($total);
    $pages = ceil($total/$listnum); 
    $data=Db::name($tbn)->where($where)->page($curPage)->limit($listnum)->order($order)->select();
    $arr = array('pages'=>$pages,'datalist'=>$data,'total'=>$total);
    return $arr;
}   
// 3、单表查询1条记录 返回对象   {}；
    function get_data($tbn,$where=null,$field=null,$sort=null){
         $data = Db::name($tbn);
          if($field){$data = $data->field($field);}

           $where['isdel']=['=','0'];
           $data = $data->where($where); 
          if($sort){$data = $data->order($sort);}
          
          $re = $data->find(); 
          return $re; 
    }



 


// 7、增加 
function insert_data($tbn,$data){
      $re = Db::name($tbn)->insertGetId($data);
      return $re;
    };
// 删除采用物理删除 isdel字段， 0默认没删除，1已删除；
// 8、删除一条或者多条记录
    function delete_data($tbn,$id,$idarr){
        $re = Db::name($tbn)->where($id,'in',$idarr)->setField('isdel',1);
        return $re;
    };


// 9、更新一条记录
  function update_one($tbn,$where,$content){
    $data = Db::name($tbn)->where($where)->update($content); 
    return $data;
    };

// 10、更新多条记录

        function update_more($tbn,$id,$idarr,$field,$value){

         $re = Db::name($tbn)->where($id,'in',$idarr)->setField($field,$value);
        return $re;
    };

 










    /**
 * 写基础配置文件
 * @param $data
 */
function writeConfig($data)
{
    $path = APP_ROOT . '/config/group.conf';
    @file_put_contents($path, serialize($data));
    return true;
}

//读配置文件
function readConfig()
{
    $path = APP_ROOT . '/config/group.conf';
    $conf = file_get_contents($path);
    if(empty($conf))
        return [];

    return unserialize($conf);
}

//写聊天配置
function writeCtConfig($data)
{
    $path = APP_ROOT . '/config/chat.conf';
    @file_put_contents($path, serialize($data));
    return true;
}

//读聊天配置文件
function readCtConfig()
{
    $path = APP_ROOT . '/config/chat.conf';
    $conf = file_get_contents($path);
    if(empty($conf))
        return [];

    return unserialize($conf);
}

//获取评论
function getComment($blogId)
{
    $list = db('comment')->where('blog_id', $blogId)->select();
    if(empty($list)){

        echo "";
    }else{

        $html = '';
        foreach($list as $key=>$vo){
            $html .= '<a href="javascript:;" class="pull-left"><img alt="image" src="' . $vo['com_avatar'] . '"></a>';
            $html .= '<div class="media-body"><a href="javascript:;" style="color:#337AB7">' . $vo['com_user'];
            $html .= '&nbsp;&nbsp;&nbsp;&nbsp;</a>' . $vo['content'] . '<br/>';
            $html .= '<small class="text-muted">' . date('Y-m-d H:i', $vo['com_time']) . '</small></div>';
        }

        echo $html;
    }

}

//将对象转换成数组
function objToArr($obj)
{
    return json_decode(json_encode($obj), true)['data'];
}

//将内容进行UNICODE编码，编码后的内容格式：\u56fe\u7247 （原始：图片）  
function unicode_encode($name)  
{  
    $name = iconv('UTF-8', 'UCS-2', $name);  
    $len = strlen($name);  
    $str = '';  
    for ($i = 0; $i < $len - 1; $i = $i + 2)  
    {  
        $c = $name[$i];  
        $c2 = $name[$i + 1];  
        if (ord($c) > 0)  
        {    // 两个字节的文字  
            $str .= 'u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);  
        }  
        else  
        {  
            $str .= $c2;  
        }  
    }  
    return $str;  
} 

/**
 * 判断一个表是否已经存在
 * @param string $table_name 要判断的表名
 * @return boolean
 */
 
 
 
 /**
 * 获取表名
 * @param int    $moduleid  模型id
 * @param string $tablem    返回表名
 */
function gettbname($moduleid){
    $module=M('SystemModule');
    //获取数据表名称
    $table=$module->where('id='.$moduleid)->field('table_name')->find();
    $tablename=str_replace(C('DB_PREFIX'), '', $table['table_name']);
    $tablename=explode('_',$tablename);
    foreach($tablename as $k=>$v){
        $tablem.=ucfirst($v);
    }
    return $tablem;
}
function tableexist($table_name){ 
    $tableisexit=Db::query('SHOW TABLES LIKE \''.$table_name.'\'');
    if(count($tableisexit)){
        return true;
    }else{
        return false;
    }
}
/**
 * 生成创建表的sql语句
 * @param string $table_name  要创建的表名
 * @param array $default_value  默认有的字段,二维数组，每个子数组中需包含value_name字段名，value_title注释
 * @param string $table_description 表注释
 */
function createAddTableSql($table_name,$default_value,$table_description='无'){
    $varchar=array('input','radio','checkbox','select','image','date','datetime','time','file');
    $text=array('textarea','cleareditor','editor','imagelist','fileslist');
    $sql='CREATE TABLE IF NOT EXISTS `'.$table_name.'` (  
            `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
            `listorder` int(11) default 9999,
            `cloneid` int(11) default NULL,
            `url` varchar(200) default NULL,
            `createtime` char(20),
            `updatetime` char(20),
            `cateid` int(11) NOT NULL COMMENT \'所属栏目\',';
    foreach($default_value as $k=>$v){
        if(in_array($v['attr'],$varchar)){
            $sql.='`'.$v['value_name'].'` varchar(100) DEFAULT NULL COMMENT \''.$v['value_title'].'\',';
        }else if(in_array($v['attr'], $text)){
            $sql.='`'.$v['value_name'].'` text COMMENT \''.$v['value_title'].'\',';
        }
    }
    $sql.='  PRIMARY KEY (`id`)
            ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8  COMMENT=\''.$table_description.'\';';
    return $sql;
}
/**
 * 生成表字段的sql语句
 * @param string $table_name  要操作的表名
 * @param string $field_name  添加的字段名
 * @param string $table_type  字段类型
 * @param string $notnull   非空 
 * @param string $isunique  唯一值（）因现字段类型只有text 和varchar(100) 停用 
 * @param string $default   默认 
 * @param string $sql   返回sql语句 
 */
                            //表名，字段名，字段类型，非空，唯一，默认
function createAddFieldSql($table_name,$field_name,$table_type,$notnull,$isunique,$default){
    $varchar=array('input','radio','checkbox','select','image','date','datetime','time','file');
    $text=array('textarea','cleareditor','editor','imagelist','fileslist');
    //判断字段类型
    if(in_array($table_type,$varchar)){
        $table_type=' varchar(100) ';
    }else{
        $table_type=' text ';
        $default='';
    }
    //非空
    $notnull=($notnull==1)?' not null ':' ';
    //唯一
    $isunique=($isunique==1)?' unique ':' ';
    $sql='alter table '.$table_name.' add '.$field_name
    //类型
    .$table_type
    //非空
    .$notnull
    //唯一
    .$isunique
    //默认值
    .' default'.$default;
/*  .' default"'.$default.'"'; */
    $result['sql']=$sql;
    return $sql;
} 


/**
 * 获取 获取数组的id数组
 * @param 
 * @return   arr
 * @author  wyl
 */
function getids($data,$id){
    $narr = [];
    foreach ($data as $key => $value) {
         $narr[] = $value[$id];
    }
    return $narr;
}

/**
 * 获取 两个数组通过某个id进行拼接
 * @param 
 * @return   arr
 * @author  wyl
 */
function jointwoarr($arr1,$arr2,$id1,$id2){ 
    foreach ($arr1 as $key => &$value) {
         foreach ($arr2 as $k => $val) {
            if($value[$id1]==$val[$id2]){
                unset($val[$id2]);
                $value = array_merge($value, $val);
            }
         }
    }
    return $arr1;
}
 



/**
 * 设备 浏览器
 * @param 
 * @return   arr
 * @author  xubo
 */
function getAgentInfo(){  
    $agent = $_SERVER['HTTP_USER_AGENT'];  
    $brower = array(  
        'MSIE' => 1,  
        'Firefox' => 2,  
        'QQBrowser' => 3,  
        'QQ/' => 3,  
        'UCBrowser' => 4,  
        'MicroMessenger' => 9,  
        'Edge' => 5,  
        'Chrome' => 6,  
        'Opera' => 7,  
        'OPR' => 7,  
        'Safari' => 8,  
        'Trident/' => 1  
    );  
    $system = array(  
        'Windows Phone' => 4,  
        'Windows' => 1,  
        'Android' => 2,  
        'iPhone' => 3,  
        'iPad' => 5  
    );  
    $browser_num = 0;//未知  
    $system_num = 0;//未知  
    foreach($brower as $bro => $val){  
        if(stripos($agent, $bro) !== false){  
            $browser_num = $bro;  
            break;  
        }  
    }  
    foreach($system as $sys => $val){  
        if(stripos($agent, $sys) !== false){  
            $system_num = $sys;  
            break;  
        }  
    }  
    return array('sys' => $system_num, 'bro' => $browser_num);  
} 







/***********************微信*************************
/**
 * 判断重定向
 * @param    string   
 * @return   arr
 * @author  lxc
 */
function wechatRedirect($url){
    $url = str_replace("","%2f",$url);
    // if (Session::get('jsoninfo')) {
        $scope = 'snsapi_base';
    // }else{
        // $scope = 'snsapi_userinfo';
    // }
    $reurl = 'Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3edf97fba911c055&redirect_uri=http%3a%2f%2fwww.chenbaozhong.com%2findex.php%2fIndex%2f'.$url.'&response_type=code&scope='.$scope.'&state=1#wechat_redirect';
    return $reurl;
} 

/**
 * 获取微信用户信息
 * @param    string   
 * @return   arr
 * @author  lxc
 */
function getWxinfo($GET){
    if (!Session::get('jsoninfo')) {
        if (array_key_exists('code',$GET)||Session::get('wxopenid')) {
            if (Session::get('wxopenid')) {
                $openid = Session::get('wxopenid');
            }else{
                $code = $GET['code'];
                $oauth2url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".Appid2."&secret=".AppSecret2."&code={$code}&grant_type=authorization_code";
                $jsoninfo = http_curl($oauth2url,null);
                $access_token = $jsoninfo['access_token'];
                $openid = $jsoninfo['openid'];
            }
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";      
            $jsoninfo =http_curl($url,null);        
            Session::set('jsoninfo',$jsoninfo); 
            Session::set('wxopenid',$openid);              
        }
        else{
            header(wechatRedirect('index'));   
            exit(); 
        }                
    }else{
        $jsoninfo = Session::get('jsoninfo');
    }
    return $jsoninfo;
} 



/**
 * 获取全局的access_token方法
 * @return [type] [description]
 */
function getAccessToken(){
    $field = 'access_token,modify_time';
    $condition = array('token'=>TOKEN,'appid'=>Appid,'appsecret'=>AppSecret);
    // $data = M('wechat')->field($field)->where($condition)->find();
    // if($data['access_token'] && time()-$data['modify_time']<7000){
    //  $access_token = $data['access_token'];
    // }else{
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.Appid.'&secret='.AppSecret.'';
        $jsoninfo = http_curl($url,null);
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
function http_curl($url,$data){
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
/**
 * 发送消息
 * @return [type] [description]
 */
function responseMsg(){
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
//***********************微信*************************
 





function fenye($temp,$listnum){
         $c=0;
         $result=[];
          $num=count($temp);
        for ($j=1; $j <=$num; $j++) { 
          $result[$c][]=$temp[$j-1];
          if($j!=0&&$j%$listnum==0&&$listnum!=1){$c++;}
          if ($listnum==1) {
            $c++;
          }
      }
      return $result;
}


//文件与图片上传不同路径 函数
 function _path($files) {       
        $file = explode('.',$files);
      $filepath = in_array($file[1], array('jpg','gif','png','jpeg')) ? 'image/' : 'file/';
      return $filepath;
 }




function nethref($value){
    $href = explode("href=\"",$value);
    $realhref = explode("\"",$href[1])[0];
    return $realhref;
}
function nettext($value){
    $text = preg_replace("/\<.*?\>|\<.*?\>/", '', $value);
    return $text;
} 
function nethtml($url){
    $html=curl_get($url);
    header('content-Type:text/html;charset=utf-8');
    $html = mb_convert_encoding($html,'utf-8','gb2312'); 
    $query = new \org\Vquery($html); 
    return $query;
}  
function filehtml($url){
    header('content-Type:text/html;charset=utf-8');
    $html = file_get_contents($url); 
    $query = new \org\Vquery($html); 
    return $query;
}  
function curl_get($url, $gzip=false){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
    if($gzip) curl_setopt($curl, CURLOPT_ENCODING, "gzip"); // 关键在这里
    $content = curl_exec($curl);
    curl_close($curl);
    return $content;
}

// //时间处理
function time_handle($time){
    $t=(time()-$time)/60/60/24;
    if ($t<1) {//时间差小于一天
        (String)$t=floor($t*24);
        if($t<1){
            $m=floor((time()-$time)/60);
            $result=$m.'分钟前';
        }else{
        $result=$t.'小时前';
        }
    }elseif ($t<3) {//时间差小于三天
        (String)$t=floor($t);
        $result=$t.'天前';
    }else{//时间差大于三天
        $result=date('Y年m月d日',$time);
    }
    return $result;
}


function get_weidu($from_id,$to_id){
    $weidu=DB::name('chatlog')->where('from_id='.$from_id.' AND to_id='.$to_id.'')->whereOr('from_id='.$to_id.' AND to_id='.$from_id.'')->select();
          $weidushu=0;
          foreach ($weidu as $k => $v) {
            if($v['need_send']==1)$weidushu++;
          }
    return $weidushu;
}

function get_chatuser($id1,$id2){
    $temp='';
    if($id1>$id2){
        $temp=$id2.','.$id1;
    }else{
        $temp=$id1.','.$id2;
    }
    return $temp;
}

function get_uid($token){
      $token=explaintoken($token);
      $user = Db::name('admin_user')->where('uuid',$token->uuid)->find();
      $uid = $user['id'];
      return $uid;
}

function data_handle($data){
    if($data){
        foreach ($data as $key => &$value) {
            //isset($value["createtime"])?$value['createtime'] = setdate($value['createtime'],true):"";
            if ($value['createtime']-time()>3600*24) {
            $value['createtime'] = date('Y-n-d H:i',$value['createtime']);
          }else{
            $value['createtime'] = date('H:i',$value['createtime']);
          }
        }
    }
    return $data;
}

// 为加密做准备，截取字段倒数几位
function cutcode($str,$num){
    $ltrl = strlen($str);
     $start = $ltrl - $num; 
     $encoding = 'utf-8'; 
    $lstr = mb_substr($str,$start,$num,$encoding);
    return $lstr;
}


function  getphcode($message,$tel,$sendcode){
  return getcode($tel,$sendcode);
}


function getcode($mobile,$sendcode)
{
$time=get_total_millisecond();
$appId='udparty';
// $mobile='18676114516';
$templateId=100343;
$sign_key = 'yWBX5VvqAgw2NisCMIttnyMG92TTzTSE4eWHmIIT';
$sign_data = array('mobile' => $mobile, 'templateId' =>$templateId, 'timestamp' => $time,
    "params"=>'["'.$sendcode.'"]');
// 以字母升序(A-Z)排列
ksort($sign_data);
// var_dump($sign_data);
$sign_str = http_build_query($sign_data) . '&'. $sign_key;
//DEBUG
//生成数字签名的方法 https://docs.wilddog.com/guide/sms/signature.html#生成数字签名的方法
$signature= hash("sha256", urldecode($sign_str));
$url = "https://api.wilddog.com/sms/v1/${appId}/code/send";
// 不同接口参数不同， 详细参数请参见 https://docs.wilddog.com
$post_data = array ('signature' => $signature,"mobile" => $mobile,"timestamp" => $time,"templateId" => $templateId,
    "params"=>'["'.$sendcode.'"]');
$form_string= http_build_query($post_data);
// // DEBUG
// echo "打印sign_str\n";
// var_dump($sign_str);
// echo "打印signature\n";
// var_dump($signature);
// echo "打印发送的数据\n";
// var_dump($form_string);
$header = array(
    'Content-Type: application/x-www-form-urlencoded',
);
$ch = curl_init();
// DEBUG 打印curl请求和响应调试日志
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// post数据
curl_setopt($ch, CURLOPT_POST, 1);
// post的变量
curl_setopt($ch, CURLOPT_POSTFIELDS, buildQuery($post_data));
$output = curl_exec($ch);
curl_close($ch);
// DEBUG
// echo "打印获得的数据\n";
$re = json_decode($output, true);
$rearr = [];
 $rearr['code']='0';
 $rearr['msg']='获取验证码失败！';
if(isset($re['status'])&&$re['status']=='ok'){
    $rearr['code']='1';
 $rearr['msg']='获取验证码成功！';
} 
return $rearr;
// var_dump($output);
}


function get_total_millisecond()
{
    $time = microtime_float();
    return round($time * 1000);
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function buildQuery($params)
{
    $parts = array();
    $params = $params ?: array();
    foreach ($params as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $item) {
                $parts[] = urlencode((string)$key) . '=' . urlencode((string)$item);
            }
        } else {
            $parts[] = urlencode((string)$key) . '=' . urlencode((string)$value);
        }
    }
    return implode('&', $parts);
}





/**----------搜索过滤-----------**/
function FilterSearch($keyword)  
{  
    global $cfg_soft_lang;  
    if($cfg_soft_lang=='utf-8')  
    {  
        $keyword = preg_replace("/[\"\r\n\t\$\\><']/", '', $keyword);  
        if($keyword != stripslashes($keyword))  
        {  
            return '';  
        }  
        else  
        {  
            return $keyword;  
        }  
    }  
    else  
    {  
        $restr = '';  
        for($i=0;isset($keyword[$i]);$i++)  
        {  
            if(ord($keyword[$i]) > 0x80)  
            {  
                if(isset($keyword[$i+1]) && ord($keyword[$i+1]) > 0x40)  
                {  
                    $restr .= $keyword[$i].$keyword[$i+1];  
                    $i++;  
                }  
                else  
                {  
                    $restr .= ' ';  
                }  
            }  
            else  
            {  
                if(preg_match("/[^0-9a-z@#\.]/",$keyword[$i]))  
                {  
                    $restr .= ' ';  
                }  
                else  
                {  
                    $restr .= $keyword[$i];  
                }  
            }  
        }  
    }  
    return $restr;  
}  



function editaddtime_format($data){
    if($data){
        isset($data["starttime"])?$data['starttime']=strtotime($data['starttime']):'';
        isset($data["endtime"])?$data['endtime']=strtotime($data['endtime']):'';
    }
    return $data;
}






/*----------评论----------*/
//获取收到的评论
function get_recomment($where,$tbn){
    $result=array();
    $word=$tbn=='comment'?'pid':($tbn=='relationship'?'articleid':'');
try{
    //文章类需要的字段
    $field1 = 'a.id,b.headimg preheadimg,b.nickname prenickname,a.title pretitle,a.createtime precreatetime,a.content precontent,a.approved preapproved,a.thumb precomimg,a.forwarding preforwarding,a.comnum precomnum,a.thumbcount prethumbcount,a.zanUser,a.zanTime,a.cateid';

    //评论需要的字段
    $field2 = 'a.id,b.headimg preheadimg,b.nickname prenickname,a.createtime precreatetime,a.content precontent,a.comimg precomimg,a.approved preapproved,a.comnum precomnum,a.thumbcount prethumbcount,a.pid,a.articleid,a.zanUser,a.zanTime';
    $field=$tbn=='comment'?$field2:($tbn=='relationship'?$field1:'');
    $where['a.isdel']=0;
    
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where($where)->field($field)->select();

    //获取自己收到的所有评论
    foreach ($data as $key => $value) {
        $w[$word]=$value['id'];
        $comment=get_datalist('comment',$w);
        if($comment){//有评论
            foreach ($comment as $k => $v) {
                unset($v['id']);
                $v['messagetype']=$tbn=='comment'?'comment':($tbn=='relationship'?'article':'');
                $r=array_merge($value,$v);
                $result[]=$r;
            }
        }
    }
}catch(\Exception $e){
    p($where);
}

    return $result;
}

//获取收到的赞
function get_rezan($where,$tbn){
    $result=array();

    //文章类需要的字段
    $field1 = 'b.headimg preheadimg,b.nickname prenickname,a.title pretitle,a.createtime precreatetime,a.content precontent,a.approved preapproved,a.thumb precomimg,a.forwarding preforwarding,a.comnum precomnum,a.thumbcount prethumbcount,a.zanUser,a.zanTime,a.id,a.cateid';

    //评论需要的字段
    $field2 = 'b.headimg preheadimg,b.nickname prenickname,a.createtime precreatetime,a.content precontent,a.comimg precomimg,a.approved preapproved,a.comnum precomnum,a.thumbcount prethumbcount,a.pid,a.articleid,a.zanUser,a.zanTime,a.id';
    $where['a.isdel']=0;
    $field=$tbn=='comment'?$field2:($tbn=='relationship'?$field1:'');
     $data = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where($where)->field($field)->select();

    foreach ($data as $key => $value) {

        if($value['zanUser']&&$value['zanTime']){
            $arr=explode(',',$value['zanUser']);
            $zt=explode(',',$value['zanTime']);
            foreach ($arr as $k => $v) {
                $user=get_data('admin_user',['id'=>$v],'nickname,headimg');
                if(!$user)return rejson('0','改用户不存在');
                $value['nickname']=$user['nickname'];
                $value['headimg']=$user['headimg'];
                $value['messagetype']=$tbn=='comment'?'zancomment':($tbn=='relationship'?'zanarticle':'');
                $value['zanTime']=$zt[$k];
                $value['createtime']=intval($zt[$k]);
                unset($value['zanUser']);
                $result[]=$value;
                break;

            }
        }
    }

    return $result;
}



//获取发出的评论
function get_sendcomment($where,$tbn){
    $result=array();
    $art=array();
    $comment=array();
    // //文章类需要的字段
    // $field1 = 'a.id,b.headimg,b.nickname,a.title,a.createtime,a.content,a.approved,a.thumb,a.forwarding ,a.comnum,a.thumbcount,a.zanUser,a.zanTime';

    // //评论需要的字段
    // $field2 = 'a.id,b.headimg,b.nickname,a.createtime,a.content,a.comimg,a.approved,a.comnum,a.thumbcount ,a.pid,a.articleid,a.zanUser,a.zanTime';
    // $field=$tbn=='comment'?$field2:($tbn=='relationship'?$field1:'');

    //获取自己所发出的评论
     $data = get_datalist('comment',$where);
        
try{
    foreach ($data as $key => $value) {
        $value['precodeid'] = jiami('60*'.$value['id']); 
        $user=get_data('admin_user',['id'=>$value['uid']],'nickname,headimg');
        $value['nickname']=$user['nickname'];
        $value['headimg']=$user['headimg'];
        if($value['articleid']){//对文章类的评论
            $w['a.id']=$value['articleid'];
            $tbn='relationship';
            $value['messagetype']='article';
        $field = 'b.headimg preheadimg,b.nickname prenickname,a.title pretitle,a.createtime precreatetime,a.content precontent,a.approved preapproved,a.thumb precomimg,a.forwarding preforwarding,a.comnum precomnum,a.thumbcount prethumbcount,a.zanUser,a.zanTime,a.id,a.cateid';
        }else{//对评论的评论
            $value['messagetype']='comment';
            $w['a.id']=$value['pid'];
            $tbn='comment';
            $field = 'b.headimg preheadimg,b.nickname prenickname,a.createtime precreatetime,a.content precontent,a.comimg precomimg,a.approved preapproved,a.comnum precomnum,a.thumbcount prethumbcount,a.pid,a.articleid,a.zanUser,a.zanTime,a.id';
        }

        $predata = db($tbn)->alias('a')->join('ys_admin_user b','b.id = a.uid')->where($w)->field($field)->find();
        if($predata){
            if($value['messagetype']=='article'){
                $art[]=array_merge($value,$predata);
            }else{
                $comment[]=array_merge($value,$predata);
            }
            
        }
    }
}catch(\Exception $e){
    p($predata);
    exit();
}
    //设置codeid
    $comment=set_codeid($comment,60);
    $art=set_codeid($art,104);

    $result=array_merge($art,$comment);

    foreach ($result as $key => &$value) {
        $temp=$value['precodeid'];
        $value['precodeid']=$value['codeid'];
        $value['codeid']=$temp;
    }

    return $result;
}














/*----------------建筑圈评论------------------*/
//获取评论以及子评论列表
function get_soncomment($id){
    $where['articleid']=$id;
    $data=get_datalist('comment',$where);
    if(!$data)return [];
    foreach ($data as $key => &$value) {
        $user=get_data('admin_user',['id'=>$value['uid']],'nickname,headimg');
        $value['nickname']=$user['nickname'];
        $value['headimg']=$user['headimg'];

        $w['pid']=$value['id'];
        $sondata=get_datalist('comment',$w,'','','createtime desc');
        if($sondata){//取最新的一条子评论
            $value['precontent']=$sondata[0]['content'];
            $value['precreatetime']=$sondata[0]['createtime'];
            $value['prethumbcount']=$sondata[0]['thumbcount'];
            $sonuser=get_data('admin_user',['id'=>$sondata[0]['uid']],'nickname,headimg');
            $value['prenickname']=$sonuser[0]['nickname'];
            $value['preheadimg']=$sonuser[0]['headimg'];
            $value['soncomnum']=count($sondata);
        }
    }
    $data=set_codeid($data,60);
    return $data;
}