<!DOCTYPE HTML>
<html>
<head>
	<title>SIGN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<? require 'head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/view/gfx/css/sign.css">
</head>
<body>

	<header>
		<img class="logo" src="/view/gfx/img/wlogo.png">
		<h1 class="summary">Digital signs on lots of screens, updating in real time</h1>
		<div class="clear"></div>
	</header>
	
	<main>
	
		<div class="stripe">
		
			<? if ($error !== false): ?>
				<h2 class="error">
					<?=$error?>
				</h2>
			<? endif ?>
			
			<div class="box">
				<h2>Create a new sign</h2>
				<form action="create.php" method="POST">
					<input name="text" id="text" placeholder="Sign text">
					<input type="submit" id="createButton" value="Create">
				</form>
			</div>
			
			<div class="box">
				<h2>Resume editing</h2>
				<form action="edit.php" method="GET">	
					<input name="code" id="code" placeholder="Passcode">
					<input type="submit" id="resumeButton" value="Resume">
				</form>
			</div>
			
			<div class="clear"></div>
		</div>
		
		<article>
		
		<h2>How it works</h2>
		
		<p>
			Say you want to make a little sign to put on your desk, displaying... your current energy level. You could use a smartphone, kindle, or even a smart TV as your sign.
		</p>
		
		<p>
			<strong>Create your sign</strong> by popping your text, like <code>Energy: High!</code> in the sign create box and clicking the button.
		</p>
		
		<p>
			You'll be taken to an editor for your new sign. It tells you the address to use to display it, something like <a href="http://sign.me.uk/1">sign.me.uk/1</a>. Simply visit that address on your phone, kindle, TV, or all at once!
		</p>
		
		<p>
			Every sign has it's own passcode, like <code>cromulent-biscuit-trader-5</code>. You can edit your sign by putting the passcode in the Resume box, or just by going to sign.me.uk/{passcode}.
		</p>
		
		<p>
			As soon as you update the text, all the devices showing your sign will change! Magical!
		</p>
		
		<p>
			Now go <a href="#">back to top</a> to try it out!
		</p>
		
		</article>
		
		<div class="stripe">
			<footer>
				<p>
				A rapid prototype by <a href="http://stegriff.co.uk">SteGriff</a>
				(<a href="http://twitter.com/SteGriff">@SteGriff</a>) 2014
				</p>
			</footer>
		</div>
		
	</main>
	
</body>
</html>