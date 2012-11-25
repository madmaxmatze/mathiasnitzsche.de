<?php

/* DONT CHANGE ANYTHING IN THIS FILE !!! */

function getCurrentPage(&$pages) {
	global $docRoot;
	$docRoot = str_replace($_SERVER["DOCUMENT_ROOT"], "", str_replace("/_index.php", "", $_SERVER['SCRIPT_FILENAME']));
	
	ob_start();
	
	// calc docRoot and uri
	$uri = ($_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : "/");

	// fix a few cms-array values and find current page
	$currentPage = null;
	foreach ($pages as $pageKey => &$page) {
		$page["id"] = $pageKey;
		if (!isset($page["title"])) $page["title"] = $page["headline"];
		if (isset($page["parent"])) $page["parent"] = &$pages[$page["parent"]];	
		if (!isset($page["uri"])) $page["uri"] = "/" . $pageKey;
		if ($docRoot . $page["uri"] == $uri) $currentPage = $page;	
	}

	// special files
	if (!$currentPage) {
		if (preg_match("/\/sitemap\.(xml|txt)/", $uri, $treffer)) {
			header("Content-Type: text/" . ($treffer[1] == "xml" ? "xml" : "plain"));
			$output = "";
			foreach ($pages as $p) {
				if (!isset($p["hideInSitemap"]) || !$p["hideInSitemap"]) {
					$u = "http://mathiasnitzsche.de" . $p["uri"];
					$output .= ($treffer[1] == "xml" ? "\t<url><loc>" . $u . "</loc></url>" : $u) . "\n";
				}
			}
			if ($treffer[1] == "xml") {
				$output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
					"<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" . $output . "</urlset>";
			}
			echo $output;
			die();
		} else if ($uri == "/robots.txt") {
			echo "User-agent: *\nAllow: /";
			die();
		}
		
		$currentPage = $pages["error404"];
		header("HTTP/1.0 404 Not Found");
	}
	return $currentPage;
};

function includeCurrentPage(&$currentPage) {
	global $pages;
	try {
		include $currentPage["id"] . '.php';
	} catch (Exception $e) {
		echo "Could not load " . $currentPage["id"];
	}
}

function finalizeCms () {
	global $docRoot;
	$content = ob_get_contents();
	ob_end_clean();
	
	#remove new lines, spaces, tabs
	// $content = preg_replace('/[\r\n\t]+/', ' ', $content);
	// $content = preg_replace('/[\s]+/', ' ', $content);
	$content = preg_replace('/href\=\"\//', 'href="' . $docRoot . '/', $content);
	echo $content;
}