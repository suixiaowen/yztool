<?php
	require("conn.php");

	@$conn = mysql_connect($host,$user,$pass);
	if(@!$conn){
	exit("");
	}
	
	$sql = mysql_query("select * from Tianzi.Tianzi");
	$str = mysql_fetch_array($sql);
	$fuwuqimingzhi = $str['fuwuqimingzhi'];
	$youxigonggao1 = $str['youxigonggao1'];
	$youxigonggao2 = $str['youxigonggao2'];
	$youxigonggao3 = $str['youxigonggao3'];
	$MD5 = $str['MD5'];
	$chongzhi = $str['chongzhi'];
	$guanwang = $str['guanwang'];
	$xujiarenshu = $str['xujiarenshu'];
	$gengxinleixin = $str['gengxinleixin'];
	$gengxindizhi = $str['gengxindizhi'];
	$paodianshijian = $str['paodianshijian'];
	$paodianleixing = $str['paodianleixing'];
	$paodianshuliang = $str['paodianshuliang'];
	$kaiguan = $str['kaiguan'];
	$xuniji = $str['xuniji'];
	$yuankong = $str['yuankong'];
	$pinji = $str['pinji'];
	$feijizuobiao = $str['feijizuobiao'];
	$neifurejian = $str['neifurejian'];
	$dengji = $str['dengji'];
	$fangguangonggao1 = $str['fangguangonggao1'];
	$fangguangonggao2 = $str['fangguangonggao2'];
	$fangguangonggao3 = $str['fangguangonggao3'];
	$fangguangonggao4 = $str['fangguangonggao4'];
	$fangguangonggao5 = $str['fangguangonggao5'];
	$fugugonggao1 = $str['fugugonggao1'];
	$fugugonggao2 = $str['fugugonggao2'];
	$fugugonggao3 = $str['fugugonggao3'];
	$fugugonggao4 = $str['fugugonggao4'];
	$fugugonggao5 = $str['fugugonggao5'];
	$jiaoseyanse = $str['jiaoseyanse'];
	$npcyanse = $str['npcyanse'];
	$cdkduihuanyanse = $str['cdkduihuanyanse'];
	$cdkleixin = $str['cdkleixin'];
	$zhucesongdianquan = $str['zhucesongdianquan'];
	$zhucesongdaibi = $str['zhucesongdaibi'];
	$baohuwenjian = $str['baohuwenjian'];
	$bobaoneirong = $str['bobaoneirong'];
	$yanzhengmd5 = $str['yanzhengmd5'];
	$yingzhi = $str['yingzhi'];
	$yuankongdizhi = $str['yuankongdizhi'];
	$cdkjihuo = $str['cdkjihuo'];
	$zhanlibeisu = $str['zhanlibeisu'];
	$GJC = $str['GJC'];
	$cdkleixin = $str['cdkleixin'];
	$tiren = $str['tiren'];
	$fugugonggao6 = $str['fugugonggao6'];
	$fugugonggao7 = $str['fugugonggao7'];
	$fugujiaoliuqun = $str['fugujiaoliuqun'];
	$xingyunchoujiang = $str['xingyunchoujiang'];
	$kefu = $str['kefu'];
	$cailiaoyanse = $str['cailiaoyanse'];
	$bawangqiyue = $str['bawangqiyue'];
	$bhwj = $str['bhwj'];
	$cdkplsl = $str['cdkplsl'];
	$bhkg = $str['bhkg'];
	$paodianyanse = $str['paodianyanse'];
	$CDKws = $str['CDKws'];
	$zlpmys = $str['zlpmys'];
	$jianti = $str['jianti'];
	$cdkgonggao = $str['cdkgonggao'];
	$jinzhidenglu = $str['jinzhidenglu'];
?>