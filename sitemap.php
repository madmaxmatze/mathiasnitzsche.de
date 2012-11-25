<ul>
	<li><a href="/">About me</a>
		<ul>
			<li><a href="/galery">Foto Galery</a></li>
		</ul>	
	</li>	
	<li><a href="/projects">Projects</a>
		<ul>
			<?php
				foreach ($pages as $p) {
					if (isset($p["parent"]["id"]) && $p["parent"]["id"] == "projects") {
						echo '<li><a href="' . $p["uri"] . '">' . $p["title"] . '</a></li>';
					}
				}
			?>
		</ul>
	</li>	
	<li><a href="http://blog.mathiasnitzsche.de">Blog</a></li>
</ul>
