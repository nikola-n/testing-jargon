<?php

namespace Tests;

use App\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{

    protected TagParser $parser;

    protected function setUp(): void
    {
        $this->parser = new TagParser();
    }

    /**
     * @dataProvider tagsProvider
     */
    public function test_it_parses_tags($input, $expected)
    {
        $result = $this->parser->parse($input);

        $this->assertSame($expected, $result);
    }

    public function tagsProvider()
    {
        return [
                                    //input      //expected
            //Note from comments: Use keys for better error messages and description
            'signle'            => ["personal", ['personal']],
            'commas'            => ["personal, money, family", ['personal', 'money', 'family']],
            'pipes'             =>  ["personal,money,family", ['personal', 'money', 'family']],
            'no_spaces'         =>  ["personal|money|family", ['personal', 'money', 'family']],
            'no_spaces_pipes'   =>  ["personal | money | family", ['personal', 'money', 'family']],
            'exclamation'       =>  ["personal ! money ! family", ['personal', 'money', 'family']],
        ];
    }
    
    //great use case to use data providers

    // public function test_it_parses_a_single_tag()
    // {

    //     $result = $this->parser->parse('personal');

    //     $expected = ['personal'];

    //     $this->assertSame($expected, $result);
    // }

    // public function test_it_parses_a_comma_separated_list_of_tags()
    // {
    //     $result = $this->parser->parse('personal, money, family');

    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);
    // }

    // public function test_it_parses_a_pipe_separated_list_of_tags()
    // {
    //     $result = $this->parser->parse('personal | money | family');

    //     $expected = ['personal', 'money', 'family'];

    //     $this->assertSame($expected, $result);
    // }


    // public function test_spaces_are_optional()
    // {
    //     $parser = new TagParser();

    //     $result = $this->parser->parse("personal,money,family");
    //     $expected = ["personal", "money", "family"];
    //     $this->assertSame($expected, $result);

    //     $result = $this->parser->parse("personal|money|family");
    //     $expected = ["personal", "money", "family"];
    //     $this->assertSame($expected, $result);
    // }
}
