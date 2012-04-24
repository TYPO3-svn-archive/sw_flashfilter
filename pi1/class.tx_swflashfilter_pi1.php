<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Michael Ryvlin <michael.ryvlin@sitewards.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Flash-with-Fallback' for the 'sw_flashfilter' extension.
 *
 * @author	Michael Ryvlin <michael.ryvlin@sitewards.com>
 * @package	TYPO3
 * @subpackage	tx_swflashfilter
 */
class tx_swflashfilter_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_swflashfilter_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_swflashfilter_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'sw_flashfilter';	// The extension key.
	
	private $bNoFlash = false;
	
	public function __construct(){
		if (isset($_SESSION['noflash']) && $_SESSION['noflash'] == 1){
			$this->bNoFlash = true;
		}
	}
	
	
	public function clearFlash(&$aParams, $oObject){
		
		if ($this->bNoFlash){
			$oHtml = new DOMDocument();
			$oHtml->loadHTML($aParams['pObj']->content);
			
			$oXpath = new DOMXPath($oHtml);
			foreach ($oXpath->query('//embed | //object') as $oElementEmbed){
				$oElementEmbed->parentNode->removeChild($oElementEmbed);
			}
			
			$aParams['pObj']->content = $oHtml->saveHTML();
		}
	}
	
	
	/**
	 * Main method of your PlugIn
	 *
	 * @param	string		$content: The content of the PlugIn
	 * @param	array		$conf: The PlugIn Configuration
	 * @return	The content that should be displayed on the website
	 */
	function main($content, $conf)	{
		
		$this->conf = $conf;
		
		$this->pi_initPIflexForm(); // Init and get the flexform data of the plugin
		$piFlexForm = $this->cObj->data['pi_flexform'];
		
		$sWidth = $piFlexForm['data']['sDEF']['lDEF']['source']['el']['flash_width']['vDEF'];
		$sHeight = $piFlexForm['data']['sDEF']['lDEF']['source']['el']['flash_height']['vDEF'];
		$sSource = $piFlexForm['data']['sDEF']['lDEF']['source']['el']['flash_source']['vDEF'];
		$sFallback = $piFlexForm['data']['sDEF']['lDEF']['source']['el']['flash_fallback']['vDEF'];
		
		$sReturnString = '
			<div class="flash-container">
		';
		
		if (!$this->bNoFlash){
			$sReturnString .= '
				<div class="flash-content" style="width:' . htmlspecialchars($sWidth) . 'px; height:' . htmlspecialchars($sHeight) . 'px; background-image:url(\'' . htmlspecialchars($sFallback) . '\')">
					<object classid="CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' . htmlspecialchars($sWidth) . '" height="' . htmlspecialchars($sHeight) . '" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0">
						<param name="movie" value="' . htmlspecialchars($sSource) . '" />
						<param name="quality" value="high" />
						<param name="scale" value="exactfit" />
						<param name="menu" value="true" />
						<param name="bgcolor" value="#FFFFFF" />
						<embed src="' . htmlspecialchars($sSource) . '" quality="high" scale="exactfit" menu="false" bgcolor="#FFFFFF" width="' . htmlspecialchars($sWidth) . '" 
							height="' . htmlspecialchars($sHeight) . '" swLiveConnect="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">
						</embed>
					</object>
				</div>';
		} else {
			$sReturnString .= '
				<div class="flash-fallback">
					<img width="' . htmlspecialchars($sWidth) . '" height="' . htmlspecialchars($sHeight) . '" src="' . htmlspecialchars($sFallback) . '" alt="" /> 
				</div>
			';
		}
		
		$sReturnString .= '
			</div>
		';
		
		return $sReturnString;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sw_flashfilter/pi1/class.tx_swflashfilter_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sw_flashfilter/pi1/class.tx_swflashfilter_pi1.php']);
}

?>