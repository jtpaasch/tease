<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease\Parser;

/**
 *  The `Csv` class parses logs where each line 
 *  is a list of comma separated values.
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
class Csv implements ParserInterface {

    /**
     *  Parses a log file where each line 
     *  has a list of comma separated values.
     *
     *  @access public
     *  @param String $source The string contents to parse.
     *  @return Array of Arrays All key/value pairs for each line.
     */
    public function parse($source) {

        // We'll store the parsed results here:
        $results = array();

        // First, break the string into lines. 
        $lines = preg_split('@\n|\r\n|\r@', $source);

        // Now go thtrough each line.
        foreach ($lines as $line) {

            // No need to worry about empty entries.
            if (empty($line)) {
                continue;
            }

            // We'll store all parsed key/value pairs here:
            $parsed_pairs = array();

            // Split at the commas to get all key/value pairs.
            $pairs = explode(',', $line);

            // Go through each pair.
            foreach ($pairs as $pair) {

                // No need to worry about empty entries.
                if (empty($pair)) {
                    continue;
                }

                // Split each pair at the equals sign (=).
                $pieces = explode('=', $pair);

                // The first is the key, the second is the value.
                $value = '';
                if (isset($pieces[0])) {
                    $key = trim($pieces[0]);
                }
                if (isset($pieces[1])) {
                    $value = trim($pieces[1]);
                }

                // Add this pair to the list.
                if (isset($key)) {
                    $parsed_pairs[$key] = $value;
                } else {
                    $parsed_pairs[] = $value;
                }

            }

            // Now add all pairs to the $results list.
            $results[] = $parsed_pairs;

        }

        // Send the results back.
        return $results;

    }

}