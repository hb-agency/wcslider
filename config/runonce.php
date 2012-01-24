<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Winans Creative 2010
 * @author     Blair Winans <blair@winanscreative.com>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


class WcsliderRunonce extends Controller
{

  /**
   * Initialize the object
   */
  public function __construct()
  {
    parent::__construct();

    $this->import((TL_MODE=='BE' ? 'BackendUser' : 'FrontendUser'), 'User');
    $this->import('Database');
  }


  /**
   * Run the controller
   */
  public function run()
  {    
  	//Update type definitions
    $this->Database->query("UPDATE tl_content SET wcsliderType='wcstart' WHERE wcsliderType='wcsliderstart'");
    $this->Database->query("UPDATE tl_content SET wcsliderType='wcstop' WHERE wcsliderType='wcsliderstop'");
   	$this->Database->query("UPDATE tl_content SET wcsliderType='wcsingle' WHERE wcsliderType='wcslidersingle'");
  }
  
}


/**
 * Instantiate controller
 */
$objWcsliderRunonce = new WcsliderRunonce();
$objWcsliderRunonce->run();