<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease\Parser;

/**
 *  The `Json` class parses logs where each line 
 *  is a json entry.
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
class Json implements ParserInterface {

    /**
     *  Parses a log file where each line 
     *  is a json entry.
     *
     *  @access public
     *  @return Array of Arrays All key/value pairs for each line.
     */
    public function parse($string) {

        // We'll store the parsed results here:
        $results = array();

        // First, break the string into lines. 
        $lines = preg_split('@\n|\r\n|\r@', $source);

        // Now go thtrough each line.
        foreach ($lines as $line) {

            // Parse the json line.
            $parsed_values = json_decode($line);

            // Add it to the $results list.
            $results[] = $parsed_values;

        }

        // Send the results back.
        return $results;

    }

}