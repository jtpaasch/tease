<?php

/**
 *  This file is part of the Tease package.
 *  See the LICENSE distributed with this source code.
 */

namespace Tease;

use Tease\Parser\ParserInterface;
use Tease\Parser\Csv as Parser;
use Tease\Streamer\StreamerInterface;
use Tease\Streamer\File as Streamer;

/**
 *  This class reads log entries, parses them,
 *  and returns them as PHP arrays.
 *
 *  @author JT Paasch <jt.paasch@gmail.com>
 */
class Teaser {

    /**
     *  A reference to an object that can parse a log file.
     *
     *  @var ParserInterface
     */
    private $parser;

    /**
     *  A reference to an object that can open/read streams.
     *
     *  @var StreamerInterface
     */
    private $streamer;

    /**
     *  The constructor.
     *  
     *  If the path to a log file is specified, 
     *  a default file streamer and CSV parser will be set.
     *
     *  @access public
     *  @param String $path The path to a log file.
     */
    public function __construct($path = null) {

        // Was a path to a log file specified?
        if (!is_null($path)) {

            // Choose the default streamer.
            $streamer = new Streamer($path);
            $this->set_streamer($streamer);

            // Choose the default parser.
            $parser = new Parser();
            $this->set_parser($parser);

        }

    }

    /**
     *  Set a parser that can parse log files.
     *
     *  @access public
     *  @param ParserInterface $parser Implements the ParserInterface.
     */
    public function set_parser(ParserInterface $parser) {
        $this->parser = $parser;
    }

    /**
     *  Get the assigned parser.
     *
     *  @access public
     *  @return ParserInterface The parser or null.
     */
    public function get_parser() {
        return $this->parser;
    }

    /**
     *  Set a handler that can open/read streams.
     *
     *  @access public
     *  @param StreamerInterface $streamer Implements StreamerInterface.
     */
    public function set_streamer(StreamerInterface $streamer) {
        $this->streamer = $streamer;
    }

    /**
     *	Get the	assigned stream handler.
     *
     *	@access	public
     *	@return	StreamerInterface The streamer or null.
     */
    public function get_streamer() {
        return $this->streamer;
    }

    /**
     *  Reads entries from a log and parses the data.
     *
     *  @access public
     *  @param Integer $entries The number of entries to read/parse.
     *  @return Array of Arrays The parsed log data.
     */
    public function fetch($entries = 1) {

        // Use the streamer to read the specified 
        // number of entries.
        $streamer = $this->get_streamer();
        $logs = $streamer->read($entries);

        // Use the parser to parse those entries.
        $parser = $this->get_parser();
        $log_data = $parser->parse($logs);

        // Return the parsed data.
        return $log_data;

    }

}