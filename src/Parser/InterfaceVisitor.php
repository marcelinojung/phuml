<?php
/**
 * PHP version 7.1
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */

namespace PhUml\Parser;

use PhpParser\Node;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\NodeVisitorAbstract;
use PhUml\Parser\Builders\InterfaceBuilder;

class InterfaceVisitor extends NodeVisitorAbstract
{
    /** @var Definitions */
    private $definitions;

    /** @var InterfaceBuilder */
    private $builder;

    public function __construct(Definitions $definitions, InterfaceBuilder $builder)
    {
        $this->definitions = $definitions;
        $this->builder = $builder;
    }

    public function leaveNode(Node $node)
    {
        if ($node instanceof Interface_) {
            $this->definitions->add($this->builder->build($node));
        }
    }
}