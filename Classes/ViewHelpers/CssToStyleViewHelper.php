<?php
namespace TYPO3\CssToStyle\ViewHelpers;

/*                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        *
 * You should have received a copy of the GNU General Public License      *
 * along with the script.                                                 *
 * If not, see http://www.gnu.org/licenses/gpl.html                       *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

require_once(dirname(__FILE__) . '/../../Resources/Private/Php/emogrifier/emogrifier.php');

/**
 * Uses Emogrifier to parse a given css file and set inline style attributes.
 *
 * http://www.pelagodesign.com/sidecar/emogrifier/
 *
 *
 * = Basic usage =
 *
 * Wrap the HTML Code you want to have the inline style with the Viewhelper
 * <code title="Example">
 *   <css:cssToStyle cssFile="EXT:your_extension/Resources/Private/Templates/Email/Global.css">
 *     OR
 *   <css:cssToStyle cssFile="{templateRootPath}Email/Global.css">
 *   <body>
 *     ...
 *   </body>
 *   </css:cssToStyle>
 * </code>
 *
 * <output>
 *   <body style="background: #fff;">
 *     ...
 *   </body>
 *   // depending on your Css it may set something for body or not
 * </output>
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class CssToStyleViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Parses the given Css-file into inline style attributes
	 *
	 * @param string $cssFile css File to use
	 * @param boolean $debug if set the emogrify output will be echoed and the application exited
	 * @return string rendered form
	 */
	public function render($cssFile, $debug = FALSE) {
		$cssFile = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($cssFile);
		$content = $this->renderChildren();

		$emogrifier = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Emogrifier');
		$emogrifier->setCSS(file_get_contents($cssFile));
		$emogrifier->setHTML($content);

		if ($debug === TRUE) {
			echo $emogrifier->emogrify();
			die();
		}

		return $emogrifier->emogrify();
	}

}

?>