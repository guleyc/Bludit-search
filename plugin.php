<?php

class pluginSearch extends Plugin {
		
	public function siteBodyEnd() {

		global $Site;

		$html  = '<div class="plugin pluginSearch">';
		$html .= '<div class="pluginSearchBox"><input type="text" name="q" class="pluginSearchInput" placeholder="'.$this->getDbField('searchText').'" /></div>';
		$html .= '</div>';

		if($this->shouldSearchShow() && !$this->getDbField('manual')) return $html;
	}

	public function siteHead() {

		$head  = '<link rel="stylesheet" href="'.$this->htmlPath().'css/search.css">'.PHP_EOL;
		if($this->getDbField('jQuery')) $head .= '<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>'.PHP_EOL;
		$head .= '<script src="'.$this->htmlPath().'js/search.js"></script>'.PHP_EOL;
		
		if($this->shouldSearchShow() || $this->getDbField('manual')) return $head;
	}

	private function shouldSearchShow() {

		global $Url;

		if($Url->whereAmI() === 'blog' && $this->getDbField('showBlog')) return true;
		if($Url->whereAmI() === 'page' && $this->getDbField('showPage')) return true;
		if($Url->whereAmI() === 'post' && $this->getDbField('showPage')) return true;
	}

	public function init() {
		$this->dbFields = array(
			'showPage' => false,
			'showBlog' => true,
			'showPost' => true,
			'searchText' => 'Search...',
			'manual' => false,
			'jQuery' => false
		);
	}

	public function form() {

		global $Language;

		$html  = '<div>';
		$html .= '<label>'.$Language->get('Text in search input').'</label>';
		$html .= '<input type="text" name="searchText" value="'.$this->getDbField('searchText').'" />';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show on pages?').'</label>';
		$html .= '<select name="showPage">';

		if($this->getDbField('showPage')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show on blog?').'</label>';
		$html .= '<select name="showBlog">';

		if($this->getDbField('showBlog')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$Language->get('Show on posts?').'</label>';
		$html .= '<select name="showPost">';

		if($this->getDbField('showPost')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '</div>';
		

		$html .= '<div>';
		$html .= '<label>'.$Language->get('Manual install plugin?').'</label>';
		$html .= '<select name="manual">';

		if($this->getDbField('manual')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '<div>';
		$html .= '<label>Copt this inside your theme</label>';
		$html .= '<pre><code>';
		$html .= htmlentities('<div class="plugin pluginSearch">').PHP_EOL;
		$html .= htmlentities('	<div class="pluginSearchBox">').PHP_EOL;
		$html .= htmlentities('		<input type="text" name="q" class="pluginSearchInput" placeholder="'.$this->getDbField('searchText').'" />').PHP_EOL;
		$html .= htmlentities('	</div>').PHP_EOL;
		$html .= htmlentities('</div>');
		$html .= '</code></pre>';
		$html .= '</div>';
		$html .= '</div>';
		

		$html .= '<div>';
		$html .= '<label>'.$Language->get('Add jQuery?').' <small>Change to yes if your theme dosn\'t have jQuery</small></label>';
		$html .= '<select name="jQuery">';

		if($this->getDbField('jQuery')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '</div>';
		return $html;

	}
	
}

?>
