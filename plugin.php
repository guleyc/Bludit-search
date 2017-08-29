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
<<<<<<< HEAD
			'showPost' => true,
			'searchText' => 'Search...'
		);
	}

	public function form() {

		global $Language;

		$html  = '<div class="uk-form-row">';
		$html .= '<label class="uk-form-label">'.$Language->get('Text in search input').'</label>';
		$html .= '<div class="uk-form-controls"><input type="text" name="searchText" value="'.$this->getDbField('searchText').'" /></div>';
		$html .= '</div>';

		$html .= '<div class="uk-form-row">';
=======
			'showPost' => true
		);
	}

	public function form() {

		global $Language;

		$html  = '<div class="uk-form-row">';
>>>>>>> ff80aa71d12accdb401fb927d3b013d2014941dc
		$html .= '<label class="uk-form-label">'.$Language->get('Show on pages?').'</label>';
		$html .= '<div class="uk-form-controls">';
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
		$html .= '</div>';

		$html .= '<div class="uk-form-row">';
		$html .= '<label class="uk-form-label">'.$Language->get('Show on blog?').'</label>';
		$html .= '<div class="uk-form-controls">';
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
		$html .= '</div>';

		$html .= '<div class="uk-form-row">';
		$html .= '<label class="uk-form-label">'.$Language->get('Show on posts?').'</label>';
		$html .= '<div class="uk-form-controls">';
<<<<<<< HEAD
		$html .= '<select name="showPost">';
=======
		$html .= '<select name="showBlog">';
>>>>>>> ff80aa71d12accdb401fb927d3b013d2014941dc

		if($this->getDbField('showPost')) {
			$html .= '<option value="1" selected>Yes</option>';
			$html .= '<option value="0">No</option>';
		} else {
			$html .= '<option value="1">Yes</option>';
			$html .= '<option value="0" selected>No</option>';
		}

		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;

	}
	
}

?>
