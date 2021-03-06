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
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['wcsliderType']      		= array('Operation mode', 'Please select the operation mode of the element.');
$GLOBALS['TL_LANG']['tl_content']['wcsliderID']  			= array('Slider ID', 'Please select a slider ID. Useful for styling different sliders.');
$GLOBALS['TL_LANG']['tl_content']['wcsliderOrientation']  	= array('Slider Transition', 'Select whether the transition is right->left, top->bottom, or fade.');
$GLOBALS['TL_LANG']['tl_content']['wcsliderTimer']  		= array('Time Interval', 'Time interval between transitions.');
$GLOBALS['TL_LANG']['tl_content']['wcsliderDisabled']  		= array('Disable Controls?', 'Click to disable the controls.');
$GLOBALS['TL_LANG']['tl_content']['wcsliderPause']  		= array('Pause Slideshow at Start?', 'Click to pause the slideshow at start.');

/**
 * Reference
 */

$GLOBALS['TL_LANG']['tl_content']['wcsingle']    	= array('Single element', 'In this operation mode, the element will be converted into a sliding or fading pane. You can set up content using the rich text editor.');
$GLOBALS['TL_LANG']['tl_content']['wcstart']     	= array('Wrapper start', 'This operation mode allows to display multiple content elements in one sliding pane by inserting them between element <em>wrapper start</em> and <em>wrapper stop</em>.');
$GLOBALS['TL_LANG']['tl_content']['wcstop']      	= array('Wrapper stop', 'Indicates the end of a wrapper element.');
$GLOBALS['TL_LANG']['tl_content']['horizontal']    		= 'Horizontal';
$GLOBALS['TL_LANG']['tl_content']['vertical']     		= 'Vertical';
$GLOBALS['TL_LANG']['tl_content']['none']      			= 'Fade';

/**
 * Legends
 */
 
$GLOBALS['TL_LANG']['tl_content']['config_legend']      = 'Configuration Settings';

?>