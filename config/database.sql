-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `wcsliderType` varchar(32) NOT NULL default '',
  `wcsliderID` varchar(255) NOT NULL default '',
  `wcsliderTimer` varchar(255) NOT NULL default '',
  `wcsliderOrientation` varchar(255) NOT NULL default '',
  `wcsliderDisabled` char(1) NOT NULL default '',
  `wcsliderPause` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;