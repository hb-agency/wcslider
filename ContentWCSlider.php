<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005
 * @author     Leo Feyer <leo@typolight.org>
 * @package    Frontend
 * @license    LGPL
 * @filesource
 */


/**
 * Class ContentWCSlider
 *
 * Front end content element "WC Slider".
 * @copyright  2010 Winans Creative 
 * @author     Blair Winans <blair@winanscreative.com>
 * @package    WC Slider
 * @license    LGPL 
 */
class ContentWCSlider extends ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_wcslider';
	
	/**
	 * Generate content element
	 */
	protected function compile()
	{
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/wcslider/html/sl_slider.js';
				
		// Accordion start
		switch ($this->wcsliderType)
		{
			// Slider start
			case 'wcstart':
				if (TL_MODE == 'FE')
				{
					$this->strTemplate = 'ce_wcslider_start';
					$this->Template = new FrontendTemplate($this->strTemplate);
					$this->Template->wcsliderID = $this->wcsliderID;
					
					list($startScript, $endScript) = $this->getScriptTags();
					
					//DO NOT ADD SCRIPT IF THE NUMBER OF ELEMENTS IS LESS THAN 2 (static)
					if($this->countElements('wcstart')>1)
					{
$strMootools = $startScript . "\n" .
"window.addEvent('domready', function() {
  var itemsHolder = $('". $this->wcsliderID . "');
  var myItems = $$('#". $this->wcsliderID . " .item');
  var firstItem = myItems[0];";
  if(!$this->wcsliderDisabled) {
$strMootools .=  
  "
  var numNavHolder = $('num_nav_". $this->wcsliderID . "').getElement('ul');
  var thePlayBtn = $('play_btn_". $this->wcsliderID . "');
  var theNextBtn = $('next_btn_". $this->wcsliderID . "');
  var thePrevBtn = $('prev_btn_". $this->wcsliderID . "');
  ";
	}	
$strMootools .=  "
 mySlider_". $this->wcsliderID . " = new SL_Slider({
    slideTimer: " . $this->wcsliderTimer . ", 
    container: itemsHolder,
    orientation: '" . $this->wcsliderOrientation . "',
    isPaused: " . ($this->wcsliderPause ? "true" : "false") . ",
    items: myItems";
    if(!$this->wcsliderDisabled) {
$strMootools .=    ",
    hasControls: true,
    numNavActive: true,
    numNavHolder: numNavHolder,
    playBtn: thePlayBtn,
    nextBtn: theNextBtn,
    prevBtn: thePrevBtn";
}
$strMootools .=  "
  });
  mySlider_". $this->wcsliderID . ".start();
});
" . $endScript;
	
						$GLOBALS['TL_MOOTOOLS'][] = $strMootools;
					}
					
				}
				else
				{
					$this->strTemplate = 'be_wildcard';
					$this->Template = new BackendTemplate($this->strTemplate);
					$this->Template->wildcard = '### SLIDER WRAPPER START ###';
					$this->Template->title = $this->headline;
				}
				break;

			// Slider end
			case 'wcstop':
				if (TL_MODE == 'FE')
				{
					$objStart = $this->getCompanion('wcstop');

					$this->strTemplate = 'ce_wcslider_stop';
					$this->Template = new FrontendTemplate($this->strTemplate);
					$this->Template->disabled = $objStart->wcsliderDisabled ? true : false;
					if(!$this->Template->disabled)
					{
						$this->Template->disabled = $this->countElements('wcstop')> 1 ? false : true;
					}
					$this->Template->startid = $objStart->wcsliderID;
				}
				else
				{
					$this->strTemplate = 'be_wildcard';
					$this->Template = new BackendTemplate($this->strTemplate);
					$this->Template->wildcard = '### SLIDER WRAPPER END ###';
				}
				break;

			// Slider default
			default:			
				$this->import('String');
	
				// Clean RTE output
				$this->Template->text = str_ireplace
				(
					array('<u>', '</u>', '</p>', '<br /><br />', ' target="_self"'),
					array('<span style="text-decoration:underline;">', '</span>', "</p>\n", "<br /><br />\n", ''),
					$this->String->encodeEmail($this->text)
				);
		
				$this->Template->addImage = false;
		
				// Add image
				if ($this->addImage && strlen($this->singleSRC) && is_file(TL_ROOT . '/' . $this->singleSRC))
				{
					$this->addImageToTemplate($this->Template, $this->arrData);
				}

		}
		
		$objStart = $this->getSliderElement('wcstart', $this->sorting);
		
		$this->Template->groupname = standardize('wcslider_' . $objStart->id);
	}

	
	/**
	 * Return the total number of elements for a particular wcSlider combo
	 * @param string
	 * @param int
	 * @return mixed
	 */
	protected function countElements($strSliderType)
	{
		$objCompanion = $this->getCompanion($strSliderType);
		
		$intStartSorting = ($strSliderType=='wcstart' ? $this->sorting : $objCompanion->sorting);
		$intEndSorting = ($strSliderType=='wcstop' ? $this->sorting : $objCompanion->sorting);
		
		if($intStartSorting && $intEndSorting)
		{
			$objData = $this->Database->prepare("SELECT COUNT(id) as count FROM tl_content WHERE sorting>? AND sorting<? AND pid=? AND invisible<>?")
									  ->execute($intStartSorting, $intEndSorting, $this->pid, 1);
			
			$intTotalElements = ($objData->numRows < 1) ? 0 : $objData->count;		
			
		}
		else
		{
			$intTotalElements = 0;
		}			
			
		return $intTotalElements;
	
	}
	
	/**
	 * Return a database result for the first published instance of an element type
	 * @param string
	 * @param int
	 * @return mixed
	 */
	protected function getSliderElement($strSliderType, $intSorting)
	{
		$strOperator = ($strSliderType=='wcstart' ? '<' : '>');
		
		$objData = $this->Database->prepare("SELECT * FROM tl_content WHERE wcsliderType=? AND pid=? AND sorting $strOperator ? AND invisible<>1")
								  ->limit(1)
								  ->execute($strSliderType, $this->pid, $intSorting);
	
		return (!$objData->numRows) ? false : $objData;

	}
	
	/**
	 * Return the ID of a start/end elements companion
	 * @param string
	 * @param int
	 * @return mixed
	 */
	protected function getCompanion($strSliderType)
	{
		$strType = ($strSliderType=='wcstart' ? 'wcstop' : 'wcstart');
	
		return $this->getSliderElement($strType, $this->sorting);
	}
	
	/**
	 * Get html & javascript tags depending on output format (Contao 2.10)
	 * @param boolean
	 * @return array
	 */
	protected function getScriptTags()
	{
		global $objPage;

		switch ($objPage->outputFormat)
		{
			case 'html5':
				return array('<script>', '</script>');

			case 'xhtml':
			default:
				return array('<script type="text/javascript">'."\n".'/* <![CDATA[ */', '/* ]]> */'."\n".'</script>');
		}
	}
}

?>