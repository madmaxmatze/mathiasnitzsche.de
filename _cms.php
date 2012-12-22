<?php /* DONT CHANGE ANYTHING IN THIS FILE !!! */

function getCurrentPage(&$pages) {
	global $docRoot;
	$docRoot = str_replace($_SERVER["DOCUMENT_ROOT"], "", str_replace("/_index.php", "", $_SERVER['SCRIPT_FILENAME']));
	
	// fix a few cms-array values and find current page
	$currentPage = null;
	foreach ($pages as $pageKey => &$page) {
		$page["id"] = $pageKey;
		if (!isset($page["title"])) $page["title"] = $page["headline"];
		if (isset($page["parent"])) $page["parent"] = &$pages[$page["parent"]];	
		if (!isset($page["uri"])) $page["uri"] = "/" . $pageKey;
		if ($docRoot . $page["uri"] == $_SERVER['REQUEST_URI']) $currentPage = $page;	
	}

	if (!$currentPage) {
		if (preg_match("/\/sitemap\.(xml|txt)/",  $_SERVER['REQUEST_URI'], $treffer)) {
			$output = "";
			$isXml = ($treffer[1] == "xml");
			header("Content-Type: text/" . ($isXml ? "xml" : "plain"));
			$domainWithProtocol = "http" . (isset($_SERVER["HTTPS"]) ? "s" : "") . "://" . $_SERVER["HTTP_HOST"];
			foreach ($pages as $p) {
				if (!isset($p["hideInSitemap"]) || !$p["hideInSitemap"]) {
					$u = $domainWithProtocol . $p["uri"];
					$output .= ($isXml ? "\t<url><loc>" . $u . "</loc></url>" : $u) . "\n";
				}
			}
			if ($isXml) {
				$output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
					"<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" . $output . "</urlset>";
			}
			die($output);
		} else if ($_SERVER['REQUEST_URI'] == "/robots.txt") {
			die("User-agent: *\nAllow: /");
		} else {
			$currentPage = $pages["error404"];
			header("HTTP/1.0 404 Not Found");
		}
	}
	ob_start();
	return $currentPage;
};

function includeCurrentPage(&$currentPage) {
	try {
		$contentFilePath = "content/" . $currentPage["id"] . '.htm';
		if (file_exists($contentFilePath)) {
			echo file_get_contents($contentFilePath);
		} else {
			include str_replace("htm", "php", $contentFilePath);
		}
	} catch (Exception $e) {
		echo "Could not load " . $currentPage["id"];
	}
}

function finalizeCms ($compress = false) {
	global $docRoot;
	$content = ob_get_contents();
	ob_end_clean();
	
	$content = preg_replace('/href\=\"\//', 'href="' . $docRoot . '/', $content);
	if ($compress) {
		$content = preg_replace('/[\r\n\t]+/', ' ', $content);
		$content = preg_replace('/[\s]+/', ' ', $content);
	}
	echo $content;
}