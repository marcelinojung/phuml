<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

use PHPUnit\Framework\TestCase;

class plTypeDeclarationTest extends TestCase
{
    /**
     * @test
     * @dataProvider builtInTypes
     */
    function it_knows_if_it_is_a_built_in_type(string $type)
    {
        $builtInType = new plPhpTypeDeclaration($type);

        $isBuiltIn = $builtInType->isBuiltIn();

        $this->assertTrue($isBuiltIn);
    }

    /** @test */
    function it_knows_it_is_not_a_built_in_type()
    {
        $type = new plPhpTypeDeclaration('MyClass');

        $isBuiltIn = $type->isBuiltIn();

        $this->assertFalse($isBuiltIn);
    }

    /** @test */
    function it_knows_if_no_type_declaration_was_provided()
    {
        $noType = new plPhpTypeDeclaration(null);

        $isPresent = $noType->isPresent();

        $this->assertFalse($isPresent);
    }

    function builtInTypes()
    {
        return [
            'int' => ['int'],
            'float' => ['float'],
            'bool' => ['bool'],
            'string' => ['string'],
            'array' => ['array'],
            'callable' => ['callable'],
            'iterable' => ['iterable'],
        ];
    }
}
