<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease\Streamer;

/**
 *  The `File` class parses logs where each line 
 *  is a json entry.
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
class File implements StreamerInterface {

    /**
     *  A reference to the streaming resource,
     *  e.g., a file pointer.
     *
     *  @var Integer
     */
    private $stream;

    /**
     *  The path to the resource.
     *
     *  @var String
     */
    private $path;

    /**
     *  The constructor.
     *
     *  @param String $path The path to the resource to stream.
     */
    public function __construct($path) {
        $this->path = $path;
    }

    /**
     *  Read entries from the end of a file.
     *
     *  @access public
     *  @param Integer $entries Number of entries from the end of the file.
     *  @return String The entries read from the file.
     */
    public function read($entries = 1) {

        // Tail the file. We'll use the shell to do that.
        $lines = shell_exec('tail -n ' . $entries . ' ' . $this->path);

        // Return the results.
        return $lines; 

    }

}