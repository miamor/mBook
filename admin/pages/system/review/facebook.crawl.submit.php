<?php
$pid = $config->get('pid');
//print_r($review->fb_post);
$data = $review->fb_post[$_id][$pid];
print_r($data);

$review->title = $data['book'];
$review->created = $data['created'];
$review->content = $data['content'];
$review->rate = $data['rate'];
$review->from_fb_id = $data['id'];
$review->highlight = 0;
$review->status = 1;

$this->uID = 0;

//$this->uID = $config->getUserInfoByFbName($data['uname']);

$create = $review->create();
//if ($review->content && $review->from_fb_id && $review->rate) {
	if ($create) {
		echo '[type]success[/type][dataID]'.$review->link.'[/dataID][content]Review created successfully. Redirecting...[/content]';
	} else echo '[type]error[/type][content]Oops! Something went wrong with our system. Please contact the administrators for furthur help.[/content]';
//} else echo '[type]error[/type][content]Missing parameters![/content]';
