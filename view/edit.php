<!DOCTYPE HTML>
<html>
<head>
	<title>SIGN <?=$sign->ID?> - Edit</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<? require 'head.php'; ?>
	
	<link rel="stylesheet" type="text/css" href="/view/gfx/css/sign.css">
	<style type="text/css">
	.signLink
	{
		color: #fff;
	}
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
	var $sign;
	var $hint;
	var $done;
	var updateTimer;
	var sign = {
		"ID" : <?=$sign->ID?>,
		"Code" : "<?=$sign->Code?>"
		};
	
	var defaultHintText = "Enter new text and press Enter to update";
	var updatingHintText = "Updating sign...";
	var overtimeHintText = "This is taking longer than usual; try refreshing the page";
	
	$(function(){
		$sign = $('#sign');
		$hint = $('#hint');
		$done = $('#done');
		$done.hide();
		$sign.bind('keypress', keypress);
	});

	function keypress(e)
	{
		if(e.keyCode == 13){
			//Enter
			update();
		}
	}
	
	function update()
	{
		loading(true);
		$.post('/edit.php', {'code' : sign.Code, 'text' : $sign.val()}, response);
	}

	function response(data)
	{
		loading(false);
		$done.show();
		$done.delay(2000).fadeOut(2000);
	}
	
	function loading(on)
	{
		if (on)
		{
			$hint.text(updatingHintText);
			//TODO set timeout for overtimeHintText
		}
		else
		{
			$hint.text(defaultHintText);
			//TODO cancel timeout
		}
	
	}
	
</script>
</head>
<body>

	<header>
		<a href="/"><img class="logo" src="/view/gfx/img/wlogo.png"></a>
		<h1 class="summary">
			Now Editing:<br>
			<a class="signLink" href="http://sign.me.uk/<?=$sign->ID?>">
				sign.me.uk/<?=$sign->ID?>
			</a>
		</h1>
		<div class="clear"></div>
	</header>

	<div class="stripe">
		
		<? if ($error !== false): ?>
			<div class="box">
				<p class="error">
					<?=$error?>
				</p>
			</div>
		<? endif ?>
		
		<div class="box">
			<h2 id="hint">Enter new text and press Enter to update</h2>
			<input id="sign" value="<?=$sign->Text;?>">
		</div>
		
		<div class="box" id="done">
			<h2>Updated!</h2>
		</div>
		
		<div class="clear"></div>
		
	</div>
	
</body>
</html>