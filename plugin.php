<?php

class pluginSearch extends Plugin {
		
	public function siteBodyEnd() {

		global $Url;

		$html = '<div class="plugin pluginSearch">';
		$html .= '<div class="pluginSearchBox"><input type="text" name="q" class="pluginSearchInput" placeholder="Search... " /></div>';
		$html .= '</div>';


		if($Url->whereAmI() === 'blog' || $Url->whereAmI() === 'post') return $html;
	}

    public function siteHead() {

    	global $Url;

    	$head = '<link rel="stylesheet" href="'.$this->htmlPath().'css/search.css">'.PHP_EOL;
    	$head .= '<script src="'.$this->htmlPath().'js/search.js"></script>'.PHP_EOL;
    	
    	if($Url->whereAmI() === 'blog' || $Url->whereAmI() === 'post')  return $head;
    }
	
}

?>
