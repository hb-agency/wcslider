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
			case 'wcsliderstart':
				if (TL_MODE == 'FE')
				{
					$this->strTemplate = 'ce_wcslider_start';
					$this->Template = new FrontendTemplate($this->strTemplate);
					$this->Template->wcsliderID = $this->wcsliderID;
					//DO NOT ADD SCRIPT IF THE NUMBER OF ELEMENTS IS LESS THAN 2 (static)
					if(!$this->countElements($this->pid, 'wcsliderstart')<=1)
					{
$strMootools = "<script type=\"text/javascript\">
<!--//--><![CDATA[//><!--
window.addEvent('domready', function() {
  var itemsHolder = $('". $this->wcsliderID . "');
  var myItems = $$('.item');
  var firstItem = myItems[0];";
  if(!$this->wcsliderDisabled) {
$strMootools .=  
  "
  var numNavHolder = $('num_nav').getElement('ul');
  var thePlayBtn = $('play_btn');
  var theNextBtn = $('next_btn');
  var thePrevBtn = $('prev_btn');
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
//--><!]]>
</script> ";
	
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
			case 'wcsliderstop':
				if (TL_MODE == 'FE')
				{
					
					$this->strTemplate = 'ce_wcslider_stop';
					$this->Template = new FrontendTemplate($this->strTemplate);
					$this->Template->disabled = $this->checkDisabled($this->pid) ? true : false;
					if(!$this->Template->disabled)
					{
						$this->Template->disabled = $this->countElements($this->pid, 'wcsliderstop')<=1 ? true : false;
					}
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
		
		
		$this->Template->groupname = standardize($this->headline . '_' . $this->id);
		$this->Template->headline = $this->jdHeadline;
	}
	
	protected function checkDisabled($intPid)
	{
		$intStartSorting = $this->getSliderElementSorting('wcsliderstart',$intPid);
		$intEndSorting = $this->sorting;
		
		$objData = $this->Database->prepare("SELECT wcsliderDisabled FROM tl_content WHERE sorting>=? AND sorting<? AND pid=? AND wcsliderType=? AND invisible<>? ORDER BY sorting DESC")
									->limit(1)
									->execute($intStartSorting,$intEndSorting,$this->pid,'wcsliderstart', 1);
									  									  
		return $objData->wcsliderDisabled;
	}
	
	protected function countElements($intPid, $strSliderType)
	{
		switch($strSliderType)
		{
			case 'wcsliderstart':
			
				$intStartSorting = $this->sorting;
				$intEndSorting = $this->getSliderElementSorting('wcsliderstop',$intPid);
				break;
			case 'wcsliderstop':
				$intStartSorting = $this->getSliderElementSorting('wcsliderstart',$intPid);
				$intEndSorting = $this->sorting;
				break;
			default:
				return 0;
		}
		
		if($intStartSorting && $intEndSorting)
		{
			$objData = $this->Database->prepare("SELECT COUNT(id) as count FROM tl_content WHERE sorting>? AND sorting<? AND pid=? AND invisible<>?")
									  ->execute($intStartSorting,$intEndSorting,$this->pid,1);
			
						
			if($objData->numRows < 1)
			{
				$intTotalElements = 0;
			}else{
				$intTotalElements = $objData->count;
			}
		}else{
			$intTotalElements = 0;
		}			
			
		return $intTotalElements;
	
	}
	
	
	protected function getSliderElementSorting($strSliderType, $intPid)
	{
		$objData = $this->Database->prepare("SELECT sorting FROM tl_content WHERE wcsliderType=? AND pid=?")
								  ->limit(1)
								  ->execute($strSliderType,$intPid);
	
		if($objData->numRows < 1)
		{
			return false;
		}else{
			
			return $objData->sorting;				
		}
	}
}

?>