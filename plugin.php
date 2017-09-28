<?php

class pluginSearch extends Plugin {
		
	public function siteBodyEnd() {

		global $Site;

		$html  = '<div class="plugin pluginSearch" data-postlink="'.$Site->urlPost().'">';
		$html .= '<div class="pluginSearchBox"><input type="text" name="q" class="pluginSearchInput" placeholder="'.$this->getDbField('searchText').'" /></div>';
		$html .= '</div>';

		if($this->shouldSearchShow()) return $html;
	}

	public function siteHead() {

		$head  = '<link rel="stylesheet" href="'.$this->htmlPath().'css/search.css">'.PHP_EOL;
		
		if($this->shouldSearchShow()) return $head;
	}
	
	public function siteJavascript() {
		$script = '<script src="'.$this->htmlPath().'js/search.js"></script>'.PHP_EOL;
		
		if($this->shouldSearchShow()) return $script;
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

		global $L;

		HTML::formInputText(array(
			'name' => 'searchText',
			'label' => $L->g('Text in search input'),
			'value' => $this->getDbField('searchText'),
			'class' => 'uk-width-1-2 uk-form-medium',
			'tip' => ''
		));

		HTML::formSelect(array(
			'name' => 'showPage',
			'label' => $L->g('Show on pages?'),
			'options' => array(1 => $L->g('Yes'), 0 => $L->g('No')),
			'selected' => $this->getDbField('showPage'),
			'class'=>'uk-width-1-4 uk-form-medium',
			'tip'=>$L->g('position-tip')
		));		

		HTML::formSelect(array(
			'name' => 'showBlog',
			'label' => $L->g('Show on blog?'),
			'options' => array(1 => $L->g('Yes'), 0 => $L->g('No')),
			'selected' => $this->getDbField('showBlog'),
			'class'=>'uk-width-1-4 uk-form-medium',
			'tip'=>$L->g('position-tip')
		));		

		HTML::formSelect(array(
			'name' => 'showPost',
			'label' => $L->g('Show on posts?'),
			'options' => array(1 => $L->g('Yes'), 0 => $L->g('No')),
			'selected' => $this->getDbField('showPost'),
			'class'=>'uk-width-1-4 uk-form-medium',
			'tip'=>$L->g('position-tip')
		));

	}
	
}

?>
