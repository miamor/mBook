<?php
class Crawler_DDLQD extends Crawler {

	public function __construct() {
		parent::__construct();
	}
	
	function crawl_books () {
		$url = 'http://diendanlequydon.com/viewtopic.php?f=165&t=308950';
		$html = new simple_html_dom();
		$html->load_file($url);
		foreach ($html->find('.postbody') as $div) {
			foreach ($div->find('a') as $a) {
				$txt = $a->plaintext;
				$href = $a->href;
				if (strpos($href, 'diendanlequydon')) {
					$uAr[] = $href;
					$tAr[] = $txt;
					$txtAr[] = '[<a href="?link='.urlencode($href).'">Crawl</a>] <a href="'.$href.'">'.$txt.'</a> ';
				}
			}
		}
		$html->clear();
		unset($html);
		$data = array(
					'uAr' => $uAr, 
					'tAr' => $tAr, 
					'txtAr' => $txtAr
				);
		return $data;
	}
	function crawl ($url) {
		$url = str_replace('&amp;', '&', $url);
		$html = new simple_html_dom();
		$html->load_file($url);
		
		$tAr = $pageAr = array();
		
		foreach ($html->find('.postbody') as $div) {
			foreach ($div->find('span[style="font-size: 150%; line-height: normal"]') as $span) {
				$txt = $span->plaintext;
				$tAr[] = $txt;
			}
		}
		// get pagination 
		foreach ($html->find('.pagination') as $page) {
			foreach ($page->find('span') as $span) {
				foreach ($span->find('a') as $a) {
					$href = 'http://diendanlequydon.com'.substr($a->href, 1);
					echo $href.'~~~~~~~~';
					// crawl this page
					$pageTxt = $this->crawl($href);
					$tAr = array_merge($tAr, $pageTxt);
				}
			}
		}
		
		$html->clear();
		unset($html);
		
		return $tAr;
	}
	
}

