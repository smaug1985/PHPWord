<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2016 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */
namespace PhpOffice\PhpWord\Writer\RTF;

use PhpOffice\PhpWord\Writer\RTF;
use PHPUnit\Framework\Assert;

/**
 * Test class for PhpOffice\PhpWord\Writer\RTF\Style subnamespace
 */
class StyleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test empty styles
     */
    public function testEmptyStyles()
    {
        $styles = array('Font', 'Paragraph', 'Section', 'Tab', 'Indentation');
        foreach ($styles as $style) {
            $objectClass = 'PhpOffice\\PhpWord\\Writer\\RTF\\Style\\' . $style;
            $object = new $objectClass();

            $this->assertEquals('', $object->write());
        }
    }

    public function testIndentation()
    {
        $indentation = new \PhpOffice\PhpWord\Style\Indentation();
        $indentation->setLeft(1);
        $indentation->setRight(2);
        $indentation->setFirstLine(3);

        $indentWriter = new \PhpOffice\PhpWord\Writer\RTF\Style\Indentation($indentation);
        $indentWriter->setParentWriter(new RTF());
        $result = $indentWriter->write();

        Assert::assertEquals('\fi3\li1\ri2 ', $result);
    }

    public function testRightTab()
    {
        $tabRight = new \PhpOffice\PhpWord\Style\Tab();
        $tabRight->setType(\PhpOffice\PhpWord\Style\Tab::TAB_STOP_RIGHT);
        $tabRight->setPosition(5);

        $tabWriter = new \PhpOffice\PhpWord\Writer\RTF\Style\Tab($tabRight);
        $tabWriter->setParentWriter(new RTF());
        $result = $tabWriter->write();

        Assert::assertEquals('\tqr\tx5', $result);
    }

    public function testCenterTab()
    {
        $tabRight = new \PhpOffice\PhpWord\Style\Tab();
        $tabRight->setType(\PhpOffice\PhpWord\Style\Tab::TAB_STOP_CENTER);

        $tabWriter = new \PhpOffice\PhpWord\Writer\RTF\Style\Tab($tabRight);
        $tabWriter->setParentWriter(new RTF());
        $result = $tabWriter->write();

        Assert::assertEquals('\tqc\tx0', $result);
    }

    public function testDecimalTab()
    {
        $tabRight = new \PhpOffice\PhpWord\Style\Tab();
        $tabRight->setType(\PhpOffice\PhpWord\Style\Tab::TAB_STOP_DECIMAL);

        $tabWriter = new \PhpOffice\PhpWord\Writer\RTF\Style\Tab($tabRight);
        $tabWriter->setParentWriter(new RTF());
        $result = $tabWriter->write();

        Assert::assertEquals('\tqdec\tx0', $result);
    }
}
