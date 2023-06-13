{
	"php function public" : {
		"prefix": "fp",
		"body": "public function index()"
	 },
	
	 "PHP Tag": {
	 	
	 	"prefix": "php",
	 	"body": "<?php $1 ?>"
	 },
	 "Inline Echo":{
		 "prefix": "phpp",
		 "body": "<?= $$1; ?>"
	 },
	 "endif":{
		 "prefix": "ei",
		 "body": "<?php endif; ?>"
	 },
	 "in group kecuali kaur":{
		 "prefix": "ifka",
		 "body": "<?php if (in_groups('laboran') || in_groups('admin')) : ?>"
	 },

	 "html": {
		"prefix": "!",
		"body": "<!DOCTYPE html> <html lang="en">
		 <head>
		    <meta charset="UTF-8">
		    <title>Welcome to CodeIgniter 4!</title>
		    <meta name="description" content="The small framework with powerful features">
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
			</head>
			<body>
			<header>
		
			</header>
			</body>
			</html>"}


	 
}