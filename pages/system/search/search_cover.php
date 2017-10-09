<?php
$search->book_cover = (isset($_FILES['cover'])) ? $_FILES['cover'] : null;

if ($search->book_cover) {
	$search->book_coverIMG = $search->upload($search->book_cover);
	if ($search->book_coverIMG) {
//		$search->searchByCover();
/*		$cmd = 'python /opt/lampp/htdocs/mBook/include/py/books.py';
		putenv("PYTHONPATH=/opt/lampp/htdocs/mBook/['/opt/lampp/htdocs/mBook/include/py', '/usr/lib/python2.7', '/usr/lib/python2.7/plat-x86_64-linux-gnu', '/usr/lib/python2.7/lib-tk', '/usr/lib/python2.7/lib-old', '/usr/lib/python2.7/lib-dynload', '/home/tunguyen/.local/lib/python2.7/site-packages', '/usr/local/lib/python2.7/dist-packages', '/usr/local/lib/python2.7/dist-packages/image_match-1.1.2-py2.7.egg', '/usr/local/lib/python2.7/dist-packages/scikit_image-0.12.3-py2.7-linux-x86_64.egg', '/usr/local/lib/python2.7/dist-packages/elasticsearch-2.3.0-py2.7.egg', '/usr/lib/python2.7/dist-packages', '/usr/lib/python2.7/dist-packages/PILcompat', '/usr/lib/python2.7/dist-packages/gtk-2.0', '/usr/lib/python2.7/dist-packages/wx-3.0-gtk2']");
		$command = exec('python /opt/lampp/htdocs/mBook/include/py/books.py', $outAr, $val);
		print_r($outAr);
		$output = shell_exec($command);
//		echo $output;
/*		echo $cmd.'~';
		echo exec($cmd);
*/	} else echo '[type]error[/type][content]Có lỗi xảy ra trong quá trình upload hình ảnh. Vui lòng liên hệ administrators để biết thêm thông tin chi tiết.[/content]';
} else echo '[type]error[/type][content]Missing paramemters.[/content]';
