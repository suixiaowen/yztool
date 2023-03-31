<?php

if(isset($_GET['type']))
{
	$type = $_GET['type'];
}
else
{
	$type = "";
}
require("Tianzi.php");
if($type == "fuwuqimingzhi")
{
	exit($fuwuqimingzhi);
}
if($type == "dlq")
{
	exit($fuwuqimingzhi."|".$fangguangonggao1."|".$fangguangonggao2."|".$fangguangonggao3."|".$fangguangonggao4."|".$fangguangonggao5."|".$fugugonggao1."|".$fugugonggao2."|".$fugugonggao3."|".$fugugonggao4."|".$fugugonggao5."|".$yanzhengmd5."|".$yingzhi."|".$MD5."|".$yuankongdizhi."|".$yuankong."|".$gengxinleixin."|".$gengxindizhi."|".$chongzhi."|".$guanwang."|".$xuniji."&".$cdkjihuo."&".$dengji."&".$fugugonggao6."&".$fugugonggao7."&".$fugugonggao7."&".$xingyunchoujiang."&".$kefu."&".$kaiguan);
}
if($type == "wghq")
{
	exit($youxigonggao1."|".$youxigonggao2."|".$youxigonggao3."|".$xujiarenshu."|".$zhanlibeisu."|".$kaiguan."|".$feijizuobiao."|".$neifurejian."|".$paodianshijian."|".$paodianleixing."|".$paodianshuliang."|".$GJC."|".$jiaoseyanse."|".$npcyanse."|".$chongzhi."|".$pinji."|".$cdkleixin."|".$cdkduihuanyanse."|".$cailiaoyanse."|".$baohuwenjian."|".$bawangqiyue."|".$paodianyanse."|".$zlpmys);
}
if($type == "dlq2")
{
	exit($fugujiaoliuqun."|".$bhwj."|".$cdkplsl."|".$bhkg."|".$CDKws."|".$jianti."|".$jinzhidenglu);
}
//tiren
if($type == "tiren"){
	$sql = mysql_query("select tiren from Tianzi.Tianzi");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['tiren']."";
	}
		exit;
}
date_default_timezone_set('PRC');
mysql_query("set names GBK");
if(isset($_GET['UID']) && $type=="gonggaotishi")
{
$uid = $_GET['UID'];
$sql = mysql_query("SELECT * FROM Tianzi.Tianzi WHERE locate(".$uid.",gonggaotishiuid)=0 AND TIMESTAMPDIFF(SECOND,gonggaotishishijian,now())<5");
while($str = mysql_fetch_array($sql))
{
	$gonggaotishi = $str['gonggaotishi'];
	mysql_query("UPDATE Tianzi.Tianzi SET gonggaotishiuid=CONCAT(gonggaotishiuid,'".$uid.",')");
	echo "$gonggaotishi\r\n";
}
}
if($type=="checkcode"){
session_start();
$code = "";
$checkcode = "a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|p|q|r|s|t|u|v|w|x|y|z";
$checkcode = explode("|",$checkcode);
for($i=0;$i<6;$i++){
$code .= $checkcode[rand(0,count($checkcode)-1)];
}
$_SESSION['code'] = $code;
exit($_SESSION['code']);
}
mysql_query("set names gbk");
if($type == "zaixian"){
Echo mysql_num_rows(mysql_query("select login_status from taiwan_login.login_account_3 where login_status=1"));
exit;
}
//cdk
if(isset($_GET['uid']) && isset($_GET['cid']) && isset($_GET['cdk']) && isset($_GET['duihuanjiaose']) && $type=="cdk"){
	$uid = $_GET['uid'];
	$cid = $_GET['cid'];
	$cdk = $_GET['cdk'];
	$duihuanjiaose = $_GET['duihuanjiaose'];
	$duihuanshijian = date("Y-m-d H:i:s");
	If(!Preg_match('/^[0-9]+$/',$cid)){
		exit(iconv("utf-8","gbk","角色格式错误"));
	}
//	If(!Preg_match('/^[0-9A-Za-z]+$/',$cdk)){
//		exit(iconv("utf-8","gbk","CDK格式错误"));
//	}
	$sql = mysql_query("select cdkshifouduihuan from Tianzi.cdk where cdkshifouduihuan='1' and cdkdaima='$cdk'");
	if(mysql_num_rows($sql) != 0){
		exit(iconv("utf-8","gbk","CDK序列号已被使用"));
	}
	$sql = mysql_query("select * from Tianzi.cdk where cdkdaima='$cdk'");
	if(mysql_num_rows($sql) == 0){
		exit(iconv("utf-8","gbk","无效的CDK序列号"));
	}

	$str = mysql_fetch_array($sql);
	$wupindaima = explode(",",$str['wupindaima']);//物品代码
	$cdkmingcheng = $str['cdkmingcheng'];//cdk名称
	$wupinshuliang = explode(",",$str['wupinshuliang']);//物品数量
	$jinbishuliang = $str['jinbishuliang'];//金币数量
	$dianjuanshuliang = $str['dianjuanshuliang'];//点卷数量
	$daibijuanshuliang = $str['daibijuanshuliang'];//代币券数量
	$hongzileixing = $str['hongzileixing'];//红字
	$hongzishuzhi = $str['hongzishuzhi'];//红字数值
	$cdkduihuangonggao = $str['cdkduihuangongao'];//CDK兑换公告
	//执行CDK兑换
	if(mysql_query("update Tianzi.cdk set cdkshifouduihuan=cdkshifouduihuan+1,cdkduihuanshijian='$duihuanshijian',cdkduihuanuid='$uid',cdkduihuancid='$cid',cdkduihuanjiaose='$duihuanjiaose' where cdkdaima='$cdk'")){
		
	$sql = mysql_query("select cdkshifouduihuan,cdkdaima from Tianzi.cdk where cdkdaima='$cdk'");
	$str2 = mysql_fetch_array($sql);
	$cdkshifouduihuan = $str2['cdkshifouduihuan'];
	if($cdkshifouduihuan > 1){
		exit(iconv("utf-8","gbk","请勿恶意同时兑换CDK,该CDK已作废"));
	}
		
		mysql_query("set names latin1");
		$name = iconv("gbk","utf-8",$fuwuqimingcheng)." cdk兑换";
		$content = "兑换物品:".iconv("gbk","utf-8",$cdkmingcheng)."\r\n兑换时间:".$duihuanshijian;
		mysql_query("insert into taiwan_cain_2nd.letter (charac_no,send_charac_no,send_charac_name,letter_text,reg_date,stat)  values ('$cid','0','$name','$content','$duihuanshijian','1')");
		$sql = mysql_query("select letter_id from taiwan_cain_2nd.letter order by letter_id desc limit 1");
		$str = mysql_fetch_array($sql);
		$lid = $str['letter_id'];
		if(count($wupindaima) >= 10){
			$goods_i = 10;
		}else{
			$goods_i = count($wupindaima);
		}
		//mysql_query("insert into taiwan_cain_2nd.postal (occ_time,send_charac_name,receive_charac_no,item_id,add_info,amplify_option,amplify_value,gold,letter_id) values ('$duihuanshijian','$name','$cid','".$wupindaima[0]."','".$wupinshuliang[0]."','$hongzileixing','$hongzishuzhi','$jinbishuliang','$lid')");
		//mysql_query("insert into taiwan_cain_2nd.postal value ('',now(), '', '$name', '$cid', '".$wupindaima[0]."', '".$wupinshuliang[0]."', '0', '0', '$hongzileixing', '$hongzishuzhi', '$jinbishuliang', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '$lid', '0', '0', '0', '', '0', 0x0000000000000000000000000000, '', '0', 0x00000000000000000000)");
	for($i=0;$i<$goods_i;$i++){
		mysql_query("insert into taiwan_cain_2nd.postal (occ_time,send_charac_name,receive_charac_no,item_id,add_info,amplify_option,amplify_value,gold,letter_id) values ('$duihuanshijian','$name','$cid','$wupindaima[$i]','$wupinshuliang[$i]','$hongzileixing','$hongzishuzhi','$jinbishuliang','$lid')");
		//mysql_query("insert into taiwan_cain_2nd.postal value ('',now(), '', '$name', '$cid', '".$wupindaima[$i]."', '".$wupinshuliang[$i]."', '0', '0', '$hongzileixing', '$hongzishuzhi', '$jinbishuliang', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '$lid', '0', '0', '0', '', '0', 0x0000000000000000000000000000, '', '0', 0x00000000000000000000)");
	}
	//兑换点卷
	$sql = mysql_query("select account,cera from taiwan_billing.cash_cera where account=(select m_id from taiwan_cain.charac_info where charac_no=$cid)");
	if(mysql_num_rows($sql) != 0){
		mysql_query("update taiwan_billing.cash_cera set cera=cera+$dianjuanshuliang where account=(select m_id from taiwan_cain.charac_info where charac_no=$cid)");
	}
	//兑换代币券
	$sql = mysql_query("select account,cera_point from taiwan_billing.cash_cera_point where account=(select m_id from taiwan_cain.charac_info where charac_no=$cid)");
	if(mysql_num_rows($sql) != 0){
		mysql_query("update taiwan_billing.cash_cera_point set cera_point=cera_point+$daibijuanshuliang where account=(select m_id from taiwan_cain.charac_info where charac_no=$cid)");
	}
		//exit(iconv("utf-8","gbk","兑换成功"));
		mysql_query("set names gbk");
		mysql_query("insert into Tianzi.cdk_log (SJ,CDK,UID,CID,NAME,TS) VALUES ('$duihuanshijian','$cdk','$uid','$cid','$duihuanjiaose','".iconv("utf-8","gbk",'成功兑换！')."')");
		exit(iconv("utf-8","gbk","兑换成功 获得【").$cdkmingcheng.iconv("utf-8","gbk","】"));
	}else{
		exit(iconv("utf-8","gbk","兑换失败"));
	}
}

//cdk提示
if(isset($_GET['UID']) && $type=="cdktishi"){
	$uid = $_GET['UID'];
	mysql_query("set names utf8");
	$sql = mysql_query("SELECT * FROM Tianzi.cdk WHERE cdktishi=1 AND cdkshifouduihuan=1 AND locate(".$uid.",cdktishiuid)=0 AND TIMESTAMPDIFF(SECOND,cdkduihuanshijian,now())<5");

	while($str = mysql_fetch_array($sql)){
		$cdkduihuanjiaose = $str['cdkduihuanjiaose'];
		$cdkmingcheng = $str['cdkmingcheng'];
		$cdkid = $str['cdkid'];
		$cdktishiuid = $str['cdktishiuid'];
		mysql_query("UPDATE Tianzi.cdk SET cdktishiuid=CONCAT(cdktishiuid,'".$uid.",') WHERE cdkid=".$cdkid);
		echo iconv("utf-8","gbk","玩家[".$cdkduihuanjiaose."] 兑换Cdkey获得[".$cdkmingcheng."] ").$cdkgonggao."\r\n";
	}

}
//mysql_query("update Tianzi.frist set FPrice = FPrice + 1000 where FUID = (select UID from d_taiwan.accounts where accountname = 'a2415571')");//首充
//登录相关
If(Isset($_GET['username']) && Isset($_GET['password']) && isset($_GET['mac_md5']) && $type=="login"){
	$username = $_GET['username'];//获取账号
	$password = $_GET['password'];//获取密码
	$mac_md5 = $_GET['mac_md5'];
	$ip = $_SERVER["REMOTE_ADDR"];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$username)){//验证账号是否符合标准
		Echo "user erro";
		Exit;
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$password)){
		Echo "pass erro";
		Exit;
	}
	$sql = mysql_query("select UID,accountname,password from d_taiwan.accounts where accountname='$username' and password='$password'");//验证账号密码
	If(mysql_num_rows($sql)==0){
		Echo "fail";//提示账号或密码错误
		Exit;//停止代码继续执行
	}Else{
		$str = mysql_fetch_array($sql);
		$uid = $str['UID'];//获取UID
		$m_id = $uid + 10000;//ID偏移
//封杀帐号
		$sql = mysql_query("select BID,BUID from Tianzi.blacklist where BUID='$uid'");
		if(mysql_num_rows($sql) != 0){
			exit("GG");
		}
//封杀机器码
		$sql = mysql_query("select BMac_md5 from Tianzi.blacklist where BMac_md5='$mac_md5'");
		if(mysql_num_rows($sql) != 0){
			exit("GG");
		}
//封杀游戏		
		$sql = mysql_query("select m_id from d_taiwan.member_punish_info where m_id='$uid'");
		if(mysql_num_rows($sql) != 0){
			exit("GG");
		}	
		$sql = mysql_query("select m_id from taiwan_login.allow_proxy_user where m_id='$uid'");
		if(mysql_num_rows($sql) == 0){
				mysql_query("insert into taiwan_login.allow_proxy_user(m_id)values($uid)");//6848修复
			}
        require("dnf.php");			
	    $data = $uid;
		$data = sprintf("%08x010101010101010101010101010101010101010101010101010101010101010155914510010403030101",$uid);
		$data = hex2tobin($data);
		$encrypted = "";
		$pi_key =  openssl_pkey_get_private($private_key);
		openssl_private_encrypt($data,$encrypted,$pi_key);
		$encrypted = base64_encode($encrypted);
		echo $encrypted,"\n";//返回UID
		$sql = mysql_query("select m_id,charac_no,lev from taiwan_cain.charac_info where m_id=$uid and lev>=70");
		if(mysql_num_rows($sql) != 0){
			while($str = mysql_fetch_array($sql)){
				$cid = $str['charac_no'];
				mysql_query("update taiwan_cain.charac_stat set add_slot_flag=3 where charac_no=$cid");
			}
		}
	$sql = mysql_query("select JueSe from Tianzi.Tianzi");
	$str = mysql_fetch_array($sql);
	$JSXZ = $str['JueSe'];
	if($JSXZ == "1"){
	mysql_query("update d_taiwan.limit_create_character set count=0 where m_id='$uid'");
	}
	mysql_query("update taiwan_cain.charac_stat set village=11 where village=13");
	mysql_query("update taiwan_login.member_login set m_id=$uid where m_id=$m_id");
	mysql_query("update taiwan_login.member_play_info set mac_addr='$mac_md5',play_count=play_count+1 where m_id='$uid'");
		exit;
	}
}

//登录游戏获取一次公告目前ID，游戏内用线程时刻获取最新ID，若最新ID＞登录游戏时ID即触发获取公告
if ($type == "qucdkCID") {
	$sql = mysql_query("select CID from Tianzi.CdkRanking CID order by CID desc limit 0,1");
	echo "";
	while ($str = mysql_fetch_array($sql)) {
		echo "" . $str['CID'] . "";
	}
	exit;
}
//最新ID获取公告
if (isset($_GET['cdkdh1']) && $type == "qucdkdh1") {
	$cdkdh1 = $_GET['cdkdh1'];
	$sql = mysql_query("select CID,CName,DName from Tianzi.CdkRanking where CID='{$cdkdh1}'");
	echo "";
	while ($str = mysql_fetch_array($sql)) {
		echo iconv("utf-8", "gbk", "玩家 : [") . $str['DName'] . iconv("utf-8", "gbk", "] 成功兑换 : [") . $str['CName'] . iconv("utf-8", "gbk", "]");
	}
	exit;
}


//取公告
if($type == "string"){
	$sql = mysql_query("select CID,gonggaotishi from Tianzi.Tianzi where CID='1'");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['gonggaotishi'];
		}
	exit;
	}

	//取CDK兑换内容2
if(isset($_GET['cdkdh2']) && $type == "qucdkdh2"){
	$cdkdh2 = $_GET['cdkdh2'];
	$sql = mysql_query("select CID,CName,DName from Tianzi.CdkRanking where CID='$cdkdh2'");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['DName'];
	}
		exit;
}
		
//注册帐号
if(Isset($_GET['username']) && Isset($_GET['password']) && isset($_GET['check_code']) && isset($_GET['mac_md5']) &&Isset($_GET['codec']) && $type=="reg"){
	session_start();
	$check_code = $_GET['check_code'];
	$username = $_GET['username'];//獲取賬號
	$password = $_GET['password'];//獲取密碼
	$mac_md5 = $_GET['mac_md5'];
	$codec = $_GET['codec'];
	if(isset($_SESSION['code'])){
		if($_SESSION['code'] != $check_code){
			exit("code_error");
		}
	}else{
		exit("fail");
	}
	//$code = $_GET['code'];//獲取邀請碼
	if(!preg_match('/^[0-9A-Za-z]+$/',$username)){
		exit("error");//提示賬號非法
	}
	if(!Preg_match('/^[0-9A-Za-z]+$/',$password)){//驗證賬號是否符合標準
		exit("error");
	}
	if(!Preg_match('/^[0-9A-Za-z]+$/',$mac_md5)){//驗證賬號是否符合標準
		exit("error");
	}/*
	$sql = mysql_query("select RID,RCode,RState,m_id from Tianzi.request where RCode='$code' and RState=0");//驗證邀請碼是否激活
	If(mysql_num_rows($sql)==0){
		Echo "act";//提示邀請碼不存在或者已激活
		Exit;//停止代碼繼續執行
	}*/
	$ip = $_SERVER["REMOTE_ADDR"];
	
	if($genxin == "1"){
		$sql = mysql_query("select zhucexianzhi from Tianzi.Tianzi");
		$str = mysql_fetch_array($sql);
		$ZCKG = $str['zhucexianzhi'];
		$sql = mysql_query("select UID,qq from d_taiwan.accounts where qq='$ip'");
		if(mysql_num_rows($sql) >= $ZCKG){
			exit("ip_repeat");
		}
	}
	$sql = mysql_query("select UID,accountname from d_taiwan.accounts where accountname='$username'");
	if(mysql_num_rows($sql)==0){
	$sql = mysql_query("select UID from d_taiwan.accounts order by UID desc limit 1");
	if(mysql_num_rows($sql)==0){
	$uid = 18000000;
	}else{
	$str = mysql_fetch_array($sql);
	$uid = $str['UID'] +1;
	}
		$date = date("Y-m-d");
		$sql = mysql_query("select zhucesongdaibi,zhucesongdianquan,cdkjihuo from Tianzi.Tianzi");
		$str = mysql_fetch_array($sql);
		$gold = $str['zhucesongdaibi'];
		$goldD = $str['zhucesongdianquan'];
		$CDKjh = $str['cdkjihuo'];
		if ($CDKjh == "1") {
		$sql = mysql_query("select CID,cdkm,cdkzt,m_id from Tianzi.Cdkjihuoma where cdkm='$codec' and cdkzt=0");
		If(mysql_num_rows($sql)==0){
		Echo "jihuomacuowu";
		Exit;
}
}
		//執行註冊
		
		if(mysql_query("insert into d_taiwan.accounts (UID,accountname,password,qq) VALUES ('$uid','$username','$password','$ip')")){
			mysql_query("insert into d_taiwan.limit_create_character (m_id) VALUES ('$uid')");
			mysql_query("insert into d_taiwan.member_info (m_id,user_id) VALUES ('$uid','$uid')");
			mysql_query("insert into d_taiwan.member_join_info (m_id) VALUES ('$uid')");
			mysql_query("insert into d_taiwan.member_miles (m_id) VALUES ('$uid')");
			mysql_query("insert into d_taiwan.member_white_account (m_id) VALUES ('$uid')");
			mysql_query("insert into taiwan_login.member_login (m_id) VALUES ('$uid')");
			mysql_query("insert into taiwan_billing.cash_cera (account,cera,mod_date,reg_date) VALUES ('$uid','$goldD',now(),now())");
			mysql_query("insert into taiwan_billing.cash_cera_point (account,cera_point,reg_date,mod_date) VALUES ('$uid','$gold',now(),now())");
			mysql_query("insert into taiwan_login.member_play_info (occ_date,m_id,mac_addr,server_id) VALUES ('$date','$uid','$mac_md5','1')");
			mysql_query("insert into Tianzi.Cdkjhmzh (Code,m_id) values ('$codec','$uid')");
			mysql_query("update Tianzi.Cdkjihuoma set cdkzt='1' where cdkm='$codec'");
			mysql_query("INSERT INTO taiwan_login.member_game_option VALUES ('$uid', 0x48000000789C63646064F85FCFCC90028408F0BF9E9181112C0382CC50B117CC20F114A038023042210009AC0C9B, '', '', 0x10020000789C636018058319686115D5C62AAA83555417ABA81E56517D06003C02010C);");
			session_unset($_SESSION['code']);
			exit("success");
		}else{
			exit("fail");
		}
	}else{
		exit("repeat");
	}
}

//封号下线
if(Isset($_GET['uid']) && Isset($_GET['mac_md5']) && $type =='fhxx'){
	$uid = $_GET['uid'];
	$mac_md5 = $_GET['mac_md5'];
	$ip = $_SERVER["REMOTE_ADDR"];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
	exit(iconv("utf-8","gbk","UID错误"));
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$mac_md5)){//驗證賬號是否符合標準
	exit(iconv("utf-8","gbk","MAC"));
	}
	if(mysql_num_rows(mysql_query("select BUID from Tianzi.blacklist where BUID='$uid'")) == 0){
	if(mysql_query("insert into Tianzi.blacklist (BUID,BMac_md5,BIP) values ('$uid','$mac_md5','$ip')")){
			echo "Closed account";
			exit;
		}else{
			echo "Shutdown failure";
			exit;
		}
	}else{
			echo "Account has been closed";
			exit;
	}
}


//修改密码
If(Isset($_GET['username']) && Isset($_GET['ypassword']) && Isset($_GET['xpassword']) && Isset($_GET['check_code']) && $type=="upd_pas"){
	session_start();
	$username = $_GET['username'];
	$ypassword = $_GET['ypassword'];
	$xpassword = $_GET['xpassword'];
	$check_code = $_GET['check_code'];
	if($check_code != $_SESSION["code"]){
		exit("code_error");
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$username)){//驗證賬號是否符合標準
		Echo "error";//提示賬號非法
		Exit;//停止代碼繼續執行
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$ypassword)){//驗證賬號是否符合標準
		Echo "error";//提示賬號非法
		Exit;//停止代碼繼續執行
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$xpassword)){//驗證賬號是否符合標準
		Echo "error";//提示賬號非法
		Exit;//停止代碼繼續執行
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$check_code)){//驗證賬號是否符合標準
		Echo "error";//提示賬號非法
		Exit;//停止代碼繼續執行
	}
	$sql = mysql_query("select UID,accountname,password from d_taiwan.accounts where accountname='$username' and password='$ypassword'");//驗證賬號密碼
	If(mysql_num_rows($sql)==0){
		Echo "fail";//提示賬號或密碼錯誤
		Exit;//停止代碼繼續執行
	}Else{
		$str = mysql_fetch_array($sql);//參數切割
		$uid = $str['UID'];//獲取UID
		/*$sql = mysql_query("select RID,RCode,RState,m_id from Tianzi.request where m_id=$uid and RCode='$code' and RState=1");//驗證賬號是否為邀請碼註冊
		If(mysql_num_rows($sql)==0){
			Echo "ill";//提示邀請碼錯誤
			Exit;//停止代碼繼續執行
		}Else{
			$str = mysql_fetch_array($sql);
			If($str['RState']==2){
				Echo "fro";//提示賬號已被凍結
				Exit;//停止代碼繼續執行
			}
		}*/
	}
	If(mysql_query("update d_taiwan.accounts set password='$xpassword' where UID='$uid'")){//執行修改
		Echo "success";//提示成功
		Exit;//停止代碼繼續執行
	}Else{
		Echo "fail";//提示失敗
		Exit;//停止代碼繼續執行
	}
}


if(isset($_GET['uid']) && $type == "charac"){
	mysql_query("set names latin1");
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit("null");
	}
	$sql = mysql_query("select m_id,charac_no,charac_name,lev from taiwan_cain.charac_info where m_id='$uid' and delete_flag <> 1");
	if(mysql_num_rows($sql) == 0){
		exit("null");
	}else{
		while($str = mysql_fetch_array($sql)){
			echo $str['charac_no']."|".$str['charac_name']."".$str[''].""."\r\n";
		}
	}
}


$rows = 13;

if(isset($_GET['cid']) && isset($_GET['page']) && $type == "page"){
	$cid = $_GET['cid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$cid)){//驗證賬號是否符合標準
		exit("null\r\n");
	}
	If(!Preg_match('/^[0-9A-Za-z]+$/',$_GET['page'])){//驗證賬號是否符合標準
		exit("null\r\n");
	}
	if($_GET['page'] <= 0){
		$n_page = 1;
	}else{
		$n_page = $_GET['page'];
	}
	$sql = mysql_query("select GID,GCID,GCode,GName,GPrice,GUnit from Tianzi.goods where GCID=$cid");
	if(mysql_num_rows($sql) == 0){
		exit("1/1");
	}else{
		$max_page = ceil(mysql_num_rows($sql) / $rows);
		if($n_page > $max_page){
			$n_page = $max_page;
		}
		echo $n_page."/".$max_page;
	}
}
mysql_query("set names gbk");
if($type == "zaixian"){
Echo mysql_num_rows(mysql_query("select login_status from taiwan_login.login_account_3 where login_status=1"));
exit;
}

//上传战斗力
if(isset($_GET['jiaoseming']) && isset($_GET['zhandouli']) && $type=="shangchuanzhandouli"){
	$jiaoseming = $_GET['jiaoseming'];
	$zhandouli = $_GET['zhandouli'];
	If(!Preg_match('/^[0-9]+$/',$zhandouli)){
		exit("GG");
	}
	mysql_query("set names latin1");
	mysql_query("UPDATE taiwan_cain.charac_info SET zhandouli=$zhandouli WHERE charac_name='$jiaoseming'");
}

//取战斗力前20
//if($type == "quzhanli"){
//	$sql = mysql_query("select ZName,ZLZ,ZDJ from Tianzi.zhanli ZLZ order by ZLZ desc limit 0,20");
//	echo "";
//	while($str = mysql_fetch_array($sql)){
//		echo "".$str['ZName']."|".$str['ZLZ']."|".$str['ZDJ']."|";
//	}
//		exit;
//}

//获取战斗力排行
if($type == "huoquzhandoulipaihang"){

	mysql_query("set names latin1");
	$mysql = "SELECT lev,charac_name,zhandouli, @rownum := @rownum + 1 AS tmp, @incrnum := CASE WHEN @rowtotal = zhandouli THEN @incrnum WHEN @rowtotal := zhandouli THEN @rownum END AS rownum FROM ( SELECT lev,charac_name,zhandouli FROM taiwan_cain.charac_info ORDER BY zhandouli DESC limit 0,20) AS a,(SELECT @rownum := 0, @rowtotal := NULL, @incrnum := 0) b WHERE zhandouli != '0'";
	
	$sql = mysql_query($mysql);

	if(mysql_num_rows($sql) == 0){
		exit(iconv("utf-8","gbk","没有"));
	}
	while($str = mysql_fetch_array($sql)){
		$jiaosedengji = $str['lev'];
		$jiaoseming = $str['charac_name'];
		$zhandouli = $str['zhandouli'];
		echo iconv("utf-8","gbk","$jiaosedengji|$jiaoseming|$zhandouli//");
	}
}


//上传qqget
if(isset($_GET['uid']) && isset($_GET['qq']) && $type == "qqget"){
	session_start();
	$now1 = time(); //当前时间
	$uid = $_GET['uid'];
	$qq = $_GET['qq'];
	if (isset($_SESSION['last_times']) && $now1 - $_SESSION['last_times'] < 50) {
    //上次提交时间距现在＜1s
	exit("time fail");
	} else 
	//ql = mysql_query("select ZName,ZUID from Tianzi.zhanli where ZUID='$UID'");
	//if(mysql_num_rows($sql)==0)
	//{

	//	echo "zfail";
	//}else
	$_SESSION['last_times'] = $now1; //记录提交时间
		{
		mysql_query("set names utf8");
		$time = time();
		mysql_query("delete from Tianzi.qqget where QQ='$qq'");
		if(mysql_query("insert into Tianzi.qqget (QUID,QQ) values ('$uid','$qq')"))
		{
			echo "success";
		}else
		{
			echo "fail";
		}
	}
	mysql_query("set names gbk");
	exit;
}
//查询余额
if(isset($_GET['uid']) && $type == "golds"){
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit("0");
	}
	$sql = mysql_query("select GID,GUID,GGold from Tianzi.gold where GUID=$uid");
	if(mysql_num_rows($sql) == 0){
		mysql_query("insert into Tianzi.gold set GUID=$uid");
		echo "0";
	}else{
		$str = mysql_fetch_array($sql);
		echo $str['GGold'];
	}
		exit;
}
if(isset($_GET['uid']) && $type=="check_sign"){
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit("repeat");
	}
	$year = Date("Y");
	$month = Date("m");
	$day = Date("d");
	$sql = mysql_query("select SID,SUID,SYear,SMon,SDay from Tianzi.sign where SUID='$uid' and SYear='$year' and SMon='$month' and SDay='$day'");
	if(mysql_num_rows($sql) != 0){
		exit("repeat");
	}
}

if(isset($_GET['uid']) && $type=="sign_day"){
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit("repeat");
	}
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	$sql = mysql_query("select SID,SUID,SYear,SMon,SDay from Tianzi.sign where SUID='$uid' and SYear='$year' and SMon='$month'");
	$tianshu = mysql_num_rows($sql);
	if($tianshu > 7){
	mysql_query("delete from Tianzi.reward where RUID='$uid'");//取消保护 解封帐号
	mysql_query("delete from Tianzi.sign where SUID='$uid'");//取消保护 解封帐号
	$sql = mysql_query("select SID,SUID,SYear,SMon,SDay from Tianzi.sign where SUID='$uid' and SYear='$year' and SMon='$month' and SDay='$day'");
	if(mysql_query("insert into Tianzi.sign (SUID,SYear,SMon,SDay) values ('$uid','$year','$month','$day')")){
		echo 1;
		}else{
			//exit(iconv("utf-8","gbk","签到失败，请重试"));
		}
	}else{
		echo $tianshu;
	}
}
if($type=="sign_goods_list"){
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	for($i=0;$i<count($sign_mon);$i++){
		echo $sign_mon[$i][1]."\r\n";
	}
	exit;
}

if(isset($_GET['uid']) && $type=="receive_list"){
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit("GG");
	}
	$sql = mysql_query("select RID,RDay,RUID from Tianzi.reward where RUID='$uid' limit 7");
	if(mysql_num_rows($sql)!=0){
		$i = 1;
		while($str = mysql_fetch_array($sql)){
			echo $i;
			$i++;
		}
	}
	exit;
}
if(isset($_GET['uid']) && $type=="total_day"){
	$year = date("Y");
	$month = date("m");
	$uid = $_GET['uid'];
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//驗證賬號是否符合標準
		exit(iconv("utf-8","gbk","未知错误"));
	}
	$sql = mysql_query("select SID,SUID,SYear,SMon from Tianzi.sign where SUID='$uid' and SYear='$year' and SMon='$month'");
	echo mysql_num_rows($sql);
	exit;
}
//泡点工具
if($type == "bubble"){
	echo $now_time."|";
	echo $reward_gold."|";
	echo $gold_type;
}

if(isset($_GET['uid']) && isset($_GET['time']) && $type == "reward_bubble"){
	session_start();
	$now = time(); //当前时间
	$uid = $_GET['uid'];
	$time = $_GET['time'];
	$sql = mysql_query("select paodianleixing,paodianshuliang,paodianleixing from Tianzi.Tianzi");
	$str = mysql_fetch_array($sql);
	$pdsj = $str['paodianleixing'];
	$dianquan = $str['paodianshuliang'];
	$daibi = $str['paodianshuliang'];
	$kaiguan = $str['paodianleixing'];
	if (isset($_SESSION['last_times']) && $now - $_SESSION['last_times'] < $pdsj) {
    //上次提交时间距现在＜1s
	exit("time fail");
	} else 
	If(!Preg_match('/^[0-9A-Za-z]+$/',$uid)){//验证账号是否符合标准
		exit(iconv("utf-8","gbk","未知错误"));
	}

	if($time > time()){
		exit("fail");
	}else{
		$_SESSION['last_times'] = $now; //记录提交时间
		if($kaiguan == "1"){
			mysql_query("update taiwan_billing.cash_cera set cera=cera+$dianquan where account=$uid");
			exit("dianjuan");
		}
		if($kaiguan == "2"){
			mysql_query("update taiwan_billing.cash_cera_point set cera_point=cera_point+$dianquan where account=$uid");
			exit("daibi");
		}
	}
}
//getuid
if(Isset($_GET['username']) && Isset($_GET['userpasswd']) && $type=="GetUid")
{
	$username = $_GET['username'];
	$userpasswd = $_GET['userpasswd'];
	if(!Preg_match('/^[0-9A-Za-z]*$/',$username))
	{
	echo "error";
	exit;
	}
	$sql = mysql_query("select UID,accountname,password from d_taiwan.accounts where accountname='$username' and password='$userpasswd'");
	if(mysql_num_rows($sql)==0)
	{
		echo "fail";
		exit;
	}else{
		$str = mysql_fetch_array($sql);
		$uid = $str['UID'];
		echo $uid;
		exit;
	}
}
//记录外挂
if(isset($_GET['uid']) && isset($_GET['username']) &&isset($_GET['userpasswd']) && isset($_GET['file_md5']) && isset($_GET['mac_md5']) && isset($_GET['key_word'])&& $type == "illegal"){
	session_start();
	$now9 = date("Y-m-d H:i:s"); //当前时间
	$uid = $_GET['uid'];
	$username = $_GET['username'];
	$file_md5 = $_GET['file_md5'];
	$mac_md5 = $_GET['mac_md5'];
	$Key_Word = $_GET['key_word'];
	$userpasswd = $_GET['userpasswd'];
	$ip = $_SERVER["REMOTE_ADDR"];
	if (isset($_SESSION['last_times']) && $now9 - $_SESSION['last_times'] < 25) {
    //上次提交时间距现在＜25s
	exit("time fail");
	} else 

	$_SESSION['last_times'] = $now9; //记录提交时间
	{
		mysql_query("set names utf8");	
		if(mysql_query("insert into Tianzi.illegal (IUID,IUsername,IFile_md5,IMac_md5,IKey_word,ITime) values ('$uid','$username','$ip','$mac_md5','$Key_Word','$now9')"))
		{
			echo "success";
		}else
		{
			echo "fail";
		}
	}
	mysql_query("set names gbk");
	exit;
}

//记录全服喊话
if(isset($_GET['uid']) && isset($_GET['username']) && isset($_GET['MING']) &&isset($_GET['userpasswd']) && isset($_GET['file_md5']) && isset($_GET['mac_md5']) && isset($_GET['key_word'])&& $type == "qfillegal"){
	session_start();
	$now9 = date("Y-m-d H:i:s"); //当前时间
	$uid = $_GET['uid'];
	$username = $_GET['username'];
	$MING = $_GET['MING'];
	$file_md5 = $_GET['file_md5'];
	$mac_md5 = $_GET['mac_md5'];
	$Key_Word = $_GET['key_word'];
	$userpasswd = $_GET['userpasswd'];
	$ip = $_SERVER["REMOTE_ADDR"];
	if (isset($_SESSION['last_times']) && $now9 - $_SESSION['last_times'] < 25) {
    //上次提交时间距现在＜25s
	exit("time fail");
	} else 

	$_SESSION['last_times'] = $now9; //记录提交时间
	{
		mysql_query("set names utf8");	
		if(mysql_query("insert into Tianzi.qfillegal (IUID,IUsername,IFile_md5,IMac_md5,MING,IKey_word,ITime) values ('$uid','$username','$ip','$mac_md5','$MING','$Key_Word','$now9')"))
		{
			echo "success";
		}else
		{
			echo "fail";
		}
	}
	mysql_query("set names gbk");
	exit;
}
//记录全服刷图记录
if(isset($_GET['uid']) && isset($_GET['username']) && isset($_GET['MING']) && isset($_GET['FUBEN']) && isset($_GET['TG']) &&isset($_GET['userpasswd']) && isset($_GET['file_md5']) && isset($_GET['mac_md5']) && isset($_GET['key_word'])&& $type == "fbillegal"){
	session_start();
	$now9 = date("Y-m-d H:i:s"); //当前时间
	$uid = $_GET['uid'];
	$username = $_GET['username'];
	$MING = $_GET['MING'];
	$TG = $_GET['TG'];
	$FUBEN = $_GET['FUBEN'];
	$file_md5 = $_GET['file_md5'];
	$mac_md5 = $_GET['mac_md5'];
	$Key_Word = $_GET['key_word'];
	$userpasswd = $_GET['userpasswd'];
	$ip = $_SERVER["REMOTE_ADDR"];
	if (isset($_SESSION['last_times']) && $now9 - $_SESSION['last_times'] < 25) {
    //上次提交时间距现在＜25s
	exit("time fail");
	} else 

	$_SESSION['last_times'] = $now9; //记录提交时间
	{
		mysql_query("set names utf8");	
		if(mysql_query("insert into Tianzi.fbillegal (IUID,IUsername,IFile_md5,IMac_md5,MING,FUBEN,TG,IKey_word,ITime) values ('$uid','$username','$ip','$mac_md5','$MING','$FUBEN','$TG','$Key_Word','$now9')"))
		{
			echo "success";
		}else
		{
			echo "fail";
		}
	}
	mysql_query("set names gbk");
	exit;
}
//外挂
if($type == "key_word"){
	$sql = mysql_query("select KID,KKey_word from Tianzi.key_word");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['KKey_word']."|";
	}
		exit;
}
if($type == "qucdkdh"){
	$sql = mysql_query("select CID from Tianzi.CdkRanking CID order by CID desc limit 0,1");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['CID']."";
		}
		exit;
}
//封挂开关
if($type == "cfkg"){
	$sql = mysql_query("select cfkg from Tianzi.Tianzi");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['cfkg']."";
	}
		exit;
}
//关键词
if($type == "GKC1"){
	mysql_query("set names latin1");
	$sql = mysql_query("select GJC from Tianzi.Tianzi");
	echo "";
	while($str = mysql_fetch_array($sql)){
		echo "".$str['GJC']."";
	}
		exit;
}
function hex2tobin( $str ) {
	$sbin = "";
	$len = strlen( $str );
	for ( $i = 0; $i < $len; $i += 2 ) {
		$sbin .= pack( "H*", substr( $str, $i, 2 ) );
	}
	return $sbin;
}
?>