<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace PhUml\Code;

use PhUml\Code\Methods\Method;
use PhUml\Code\Modifiers\Visibility;
use PhUml\Graphviz\HasNodeIdentifier;
use PhUml\Graphviz\ObjectHashIdentifier;

/**
 * Base class for interfaces and classes
 *
 * It does not support traits yet
 */
abstract class Definition implements Named, HasNodeIdentifier
{
    use WithName, ObjectHashIdentifier;

    /** @var \PhUml\Code\Attributes\Constant[] */
    protected $constants;

    /** @var Method[] */
    protected $methods;

    /**
     * @param \PhUml\Code\Attributes\Constant[] $constants
     * @param Method[] $methods
     */
    public function __construct(string $name, array $constants = [], array $methods = [])
    {
        $this->name = Name::from($name);
        $this->constants = $constants;
        $this->methods = $methods;
    }

    /**
     * This method is used by the Summary class to count how many methods by visibility in a
     * Structure are
     *
     * @see Summary::methodsSummary() for more details
     */
    public function countMethodsByVisibility(Visibility $modifier): int
    {
        return \count(array_filter($this->methods, function (Method $method) use ($modifier) {
            return $method->hasVisibility($modifier);
        }));
    }

    /**
     * This method is used when the commands are called with the option `hide-empty-blocks`
     *
     * For interfaces it counts the number of constants.
     * For classes it counts both constants and attributes.
     *
     * @see ClassDefinition::hasAttributes() for more details
     * @see InterfaceDefinition::hasAttributes() for more details
     */
    abstract public function hasAttributes(): bool;

    /** @return \PhUml\Code\Attributes\Constant[] */
    public function constants(): array
    {
        return $this->constants;
    }

    /** @return Method[] */
    public function methods(): array
    {
        return $this->methods;
    }
}
