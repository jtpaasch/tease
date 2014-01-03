<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease\Parser;

/**
 *  In this context, a "parser" is a class that
 *  can parse the string contents of a log file. 
 *
 *  The `ParserInterface` defines the interface
 *  that any parser must implement. 
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
interface ParserInterface {
    public function parse($string);
}