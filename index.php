<?php
define('ROOT_PATH', dirname(__file__).'/');
$data = array();
if (file_exists("data.php")) {
	$data = include ROOT_PATH.'data.php';
}else{
	file_put_contents("data.php","<?php\r\nreturn ".var_export($data,true)."?>");
	$data = include ROOT_PATH.'data.php';
}

if (isset($_GET['val'])) {

	$val = $_GET['val'];

	if (isset($data)) {
		if (in_array($val,$data)) {

			header("refresh:1;url=index.php");
			die('已经下载过了,1秒后自动跳转');
		}else{
			
			if (file_exists(ROOT_PATH.'/upload/01/tol24.com'.$val.'.swf')) {
				array_push($data,$val);
				file_put_contents("data.php","<?php\r\nreturn ".var_export($data,true)."?>");
			
				header("Location:".'./upload/01/tol24.com'.$val.'.swf');
			}else{
				header("refresh:1;url=index.php");
			die('抱歉，这个文件还没有放进来');
			}
		}
	}else{
		echo 'empty';
	}
}

?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>新概念英语第一册</title>
	<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
	<style type="text/css">
	a{
		color:#ccc;
		text-decoration: none;
		font-size:2em;
	}
	a.downloaded{
		color: red;
	}
	</style>
	<script>
	function setval(dom){
		//alert(document.forms[0].val.value);
		document.forms[0].val.value = dom.title;
		document.forms[0].submit();
	}
	</script>
</head>
<body>
	<form action=".">
		<input type="hidden" name="val" id="val" value="">
	</form>
	<?php
	$i_count = count(scandir(ROOT_PATH.'upload/01'))-2;

	for($i=1;$i<=$i_count;$i++) {
		for($j=1;$j<5;$j++) {
			
			$val = sprintf("%02d-%d",$i,$j);
			if (in_array($val, $data)) {
				
				echo '<a href="javascript:;" class="downloaded" onclick="setval(this);" title="'.$val.'">tol24.com'.$val.'.swf</a><br>';
			}else{

				echo '<a href="javascript:;" onclick="setval(this);" title="'.$val.'">tol24.com'.$val.'.swf</a><br>';
			}

		}
		echo '<hr />';
	}
	?>
	
</body>
</html>