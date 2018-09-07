<!--
/**
 * @author 粕谷
 * レイアウトにhtmlでスタイルを書き込むと、外からレイアウトを呼び出すことができる
 * コントローラ上で$this->layout="レイアウト名";と指定して
 * 呼び出してね
 */
 -->
 

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF8">
<title>non title documents</title>
</head>
<body style="background-color:#454545;">
<p style="color:white;">Now showing Sample Layouts(header)</p>
<!--ここまでの記述だとレイアウトのみの表示になってしまうので、
	本文を表示させるには下記を入力する-->
	
<div style="background-color:white;">
<?php echo $content_for_layout;?>
</div>

<p style="color:white;">Now showing Sample Layouts(footer)</p>
</body>
</html>