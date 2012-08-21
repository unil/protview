<?php
$representations = $d['representations'];

foreach ($representations as $representation) {
	echo '<ul>';
	echo "<li>{$representation['title']} (creator: {$representation['creator']})</li>";
	echo '</ul>';
}
?>