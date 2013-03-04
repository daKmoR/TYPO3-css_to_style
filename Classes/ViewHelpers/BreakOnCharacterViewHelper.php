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

/**
 * Adds a Line Ending after a Character
 *
 * = Basic usage =
 * <code title="Example">
 *   <css:breakOnCharacter>
 *     http://bla.com?param1=one&param2=two&param3=three
 *   </css:breakOnCharacter>
 * </code>
 *
 * <output>
 *   http://bla.com?param1=one
 *   &param2=two
 *   &param3=three
 * </output>
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class BreakOnCharacterViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Adds $break after $character (or replaces it if $fullReplace is TRUE (defaults to FALSE)) 
	 *
	 * @param string $character
	 * @param string $break
	 * @param bool $fullReplace
	 * @return string rendered form
	 */
	public function render($character = '&', $break = 'PHP_EOL', $fullReplace = FALSE) {
		$content = $this->renderChildren();
		if ($break == 'PHP_EOL') {
			$break = PHP_EOL;
		}
		$break = $fullReplace === FALSE ? $break . $character : $break;
		$content = str_ireplace($character, $break, $content);

		return $content;
	}

}

?>