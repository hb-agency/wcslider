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
 * @copyright  2010 Winans Creative 
 * @author     Blair Winans <blair@winanscreative.com>
 * @package    WC Slider
 * @license    LGPL 
 * @filesource
 */


/**
 * Table tl_content 
 */
 
$GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['mandatory'] = false;
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'wcsliderType';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wcslider'] = 'type,wcsliderType';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wcsliderwcslidersingle'] = '{type_legend},type,wcsliderType;{text_legend},text;{image_legend},addImage;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wcsliderwcsliderstart'] = '{type_legend},type,wcsliderType,wcsliderID;{config_legend},wcsliderTimer,wcsliderOrientation,wcsliderDisabled,wcsliderPause;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['wcsliderwcsliderstop'] = '{type_legend},type,wcsliderType;{config_legend};{protected_legend:hide},protected;{expert_legend:hide},guests,';


// Fields		
$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderType'],
	'default'                 => 'wcslidersingle',
	'exclude'                 => true,
	'inputType'               => 'radio',
	'options'                 => array('wcslidersingle', 'wcsliderstart', 'wcsliderstop'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_content'],
	'eval'                    => array('submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderID'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderID'],
	'default'                 => 'slider',
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50')
);


$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderTimer'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderTimer'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => '6000',
	'eval'                    => array('maxlength'=>255, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderOrientation'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderOrientation'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'				  => 'horizontal',
	'options'                 => array('horizontal', 'vertical', 'none'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_content'],
	'eval'                    => array('tl_class'=>'w50')
);
		
$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderDisabled'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderDisabled'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['wcsliderPause'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['wcsliderPause'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'clr')
);		
		
?>