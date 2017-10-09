<?php
header('Content-Type: text/html; charset=utf-8');

$post->fb_post_id = $config->get('post_id');
if ($post->shareFB()) {
	echo 1;
	echo '<script>
if (opener) {
	var oDom = opener.document;
	var elem = oDom.getElementById("share_num_status_'.$post->id.'");
	if (elem) {
		elem.innerHTML = Number(elem.innerHTML)+1;
	}
}
</script>';
} else echo 0;
echo '<script>
// close window
var daddy = window.self;
daddy.opener = window.self;
daddy.close();
var opener = window.opener;
</script>';
