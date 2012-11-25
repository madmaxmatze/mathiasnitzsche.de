<?php

include '_cms.php';

// pages definition
$pages = array(
	"error404" => array(
		"headline" => "404 - Page not found",
		"hideInSitemap" => true,
		"description" => "The page you requested could not been found",
	),
	"sitemap" => array(
		"headline" => "Sitemap",
		"description" => "Sitemap",
	),
	"about" => array(
		"uri" => "/",
		"headline" => "",
		"title" => "Homepage",
		"description" => "Homepage of Mathias Nitzsche: Personal and Professional information about me and the things I do",
	),
		"galery" => array(
			"headline" => "Foto Galery",
			"title" => "Foto Galery",
			"parent" => "about",
			"description" => "See me getting older in this foto galery",
		),		
	"projects" => array(
		"title" => "Projects",
		"description" => "A list of private and professional projects I did in the last few years",
	),
		"bubbles2000" => array(
			"headline" => "Bubbles 2000",
			"parent" => "projects",
			"description" => "Bubbles 2000 is a Win95 desktop game I developed back in 2000 at the age of 17",
		),
		"comdirect" => array(
			"headline" => "Comdirect Depot Viewer",
			"parent" => "projects",
			"description" => "View your Comdirect Depot from any device with a lot of added information",
		),
		"diplom" => array(
			"headline" => "Diplomarbeit",
			"parent" => "projects",
			"description" => "In 2006 I wrote my thesis about a migration project in the area of mobile web browsing, which was a very hot topic in these (pre iPhone)-times",
		),		
		"evolution" => array(
			"headline" => "Evolution of this Website",
			"parent" => "projects",
			"description" => "Over the last decade this website has seen all the goods and bads of web development",
		),
		"pathcarousel" => array(
			"headline" => "PathCarousel JQuery Plugin",
			"parent" => "projects",
			"description" => "PathCarousel is a nice little jQuery Plugin I developed for a customer",
		),
		"master" => array(
			"headline" => "Master of Science - Information Systems (HU Berlin)",
			"parent" => "projects",
			"description" => "Project from my Master studies of Information Systems at the Humbold University Berlin",
		),
		"teamsite" => array(
			"headline" => "Teamsite Consulting and Development",
			"parent" => "projects",
			"description" => "Teamsite Consulting experience and projects I have been involved in",
		),	
		"tuning" => array(
			"headline" => "Paint Image Tuning",
			"parent" => "projects",
			"description" => "Early on I had to find out that I probably will never be a graphic designer, even if I had some fun with it",
		),	
		"wordpress" => array(
			"headline" => "Wordpress Pages",
			"parent" => "projects",
			"description" => "List of wordpress pages I made for friends fools and family",
		),	
);

// find current page from the pages
$currentPage = getCurrentPage($pages);

// output template
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mathias Nitzsche<?php echo (isset($currentPage["title"]) ? " - " . $currentPage["title"] : "") ?></title>
	<meta name="description" content="<?php echo (isset($currentPage["description"]) ? $currentPage["description"] : "") ?>" /> 
	<meta name="keywords" content="Mathias, Nitzsche, Berlin, Teamsite, Net, Java, PHP, wifis.org, Bubbles2000" /> 
	<meta name="author" content="Mathias Nitzsche" /> 
	<link type="text/css" rel="stylesheet" href="/style.css" />
</head>
<body>
	<div class="container">
		<header>
			<h1>MathiasNitzsche.de</h1>
			<ul class="mainnavi">
				<li<?php echo ($currentPage["id"] == "about" || isset($currentPage["parent"]["id"]) && $currentPage["parent"]["id"] == "about" ? ' class="active" ' : '') ?>><a href="/" title="About me">About Me</a></li>
				<li<?php echo ($currentPage["id"] == "projects" || isset($currentPage["parent"]["id"]) && $currentPage["parent"]["id"] == "projects" ? ' class="active" ' : '') ?>><a href="/projects" title="My projects">Projects</a></li>
				<li><a href="http://blog.mathiasnitzsche.de" title="My private Blog">Blog</a></li>
			</ul>
			<ul class="topnavi">
				<li><a href="/sitemap" title="Open Sitemap">Sitemap</a></li>
			</ul>
		</header>
		<div class="content">
			<?php 
				if (isset($currentPage["parent"]))  { 
					echo '<div class="breadcrumb">&laquo; <a href="' . $currentPage["parent"]["uri"] . '">' .$currentPage["parent"]["title"] . '</a></div>';
				}
				
				if (isset($currentPage["headline"])) {
					echo "<h2>" . $currentPage["headline"] . "</h2>";
				}
			
				includeCurrentPage($currentPage);
			?>
		</div>
	</div>
	<?php if ($_SERVER['SERVER_NAME'] == "mathiasnitzsche.de") { ?><script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-648146-1']);
		_gaq.push(['_setDomainName', 'mathiasnitzsche.de']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = 'http://www.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
<?php } ?>
</body>
</html><?php finalizeCms() ?>