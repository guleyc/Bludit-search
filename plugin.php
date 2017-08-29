<?php

class pluginSearch extends Plugin {
		
	public function siteBodyEnd() {

		global $Url;

		$html = '<div class="plugin pluginSearch">';
		$html .= '<div class="pluginSearchBox"><input type="text" name="q" class="pluginSearchInput" placeholder="'.$this->getDbField('searchText').'" /></div>';
		$html .= '</div>';

		if($this->shouldSearchShow()) return $html;
	}

	public function siteHead() {

		$head = '<link rel="stylesheet" href="'.$this->htmlPath().'css/search.css">'.PHP_EOL;
		$head .= '<script src="'.$this->htmlPath().'js/search.js"></script>'.PHP_EOL;
		
		if($this->shouldSearchShow()) return $head;
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
			'searchText' => 'Search...'
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

		return $html;

	}
	
}

?>
