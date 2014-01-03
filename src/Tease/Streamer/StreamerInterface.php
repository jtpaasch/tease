<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease\Streamer;

/**
 *  A Streamer is a class that can open and read streams,
 *  be they files, sockets, or whatever. 
 *
 *  The `StreamerInterface` defines the interface
 *  that any streamer must implement. 
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
interface StreamerInterface {
    public function __construct($path);
    public function read($num_entries);
}