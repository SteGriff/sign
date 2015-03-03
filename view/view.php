<!DOCTYPE HTML>
<html>
<head>
	<title>SIGN <?=$sign->ID?></title>
	<meta name="viewport" content="width=640, initial-scale=1">
	
	<? require 'head.php'; ?>
	
	<style type="text/css">
	*{margin:0;padding:0;}
	html,body,#signParent{height:100%;}
	#sign{
		position: absolute;
		font-size: 100px;
		font-family: sans-serif;
		margin: 20px 0 0 20px;
		line-height: 0.9em;
		text-align: center;
	}
	</style>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
	var $sign;
	var $window;
	var updateTimer;
	var signId = <?=$sign->ID?>;
	var resizeTimer = null;
	var updateTimer = null;
	var FONT = 'font-size';
	
	$(function(){
		$sign = $('#sign');
		$window = $(window);
		
		resizeSign();
		$(window).resize(QResize);
		
		QUpdate();
		
		$.ajaxSetup ({
			cache: false
		});
	});

	function QUpdate()
	{
		window.clearTimeout(updateTimer);
		updateTimer = setTimeout(update, 1000);
	}
	
	function update()
	{
		window.clearTimeout(updateTimer);
		$.get('/view.php', {'id' : signId}, response);
	}

	function response(data)
	{
		$sign.text(data);
		resizeSign();
		QUpdate();
	}
	
	function QResize()
	{
		window.clearTimeout(resizeTimer);
		resizeTimer = setTimeout(resizeSign, 500);
	}
	
	function resizeSign()
	{
		window.clearTimeout(resizeTimer);
		var inc = 10;
		var margins = 20;
		
		//First stage - if too big - decrease by halving until fit
		while ($sign.height() > $window.height() - margins || $sign.width() > $window.width() - margins)
		{
			oldSize = getFontSize();
			newSize = round(oldSize * 0.75);
			$sign.css(FONT, newSize);
			//console.log("HALVE", oldSize, newSize);
		}
		
		//Second stage - increment by [inc] until it doesn't fit, then use last
		while ($sign.height() < $window.height() - margins && $sign.width() < $window.width() - margins)
		{
			oldSize = getFontSize();
			newSize = round(oldSize) + inc;
			$sign.css(FONT, newSize);
			//console.log("INC", oldSize, newSize);
		}
		$sign.css(FONT, oldSize);
		//console.log("SETTLE", oldSize);
	}
	
	function round(n)
	{
		return Math.round(n * 100) / 100
	}
	
	function getFontSize()
	{
		return (1 * $sign.css(FONT).toString().replace("px", ""))
	}
	
</script>
</head>
<body>
	
	<? if ($error !== false): ?>
			<p class="error">
				<?=$error?>
			</p>
	<? endif ?>
	
	<p id="sign">
		<?=$sign->Text?>
	</p>
	
</body>
</html>