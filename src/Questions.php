<?php

namespace App;

use Countable;

/**
 * Class that represents the collection of questions
 * Quiz will be responsible for delegating the higher level stuff
 */
class Questions implements Countable
{
    protected array $questions;

    //If we use a property only in one method its not a best practice, try to find
    //another way.
    // protected $current = 0;

    public function __construct(array $questions = [])
    {
        $this->questions = $questions;
    }

    public function add(Question $question)
    {
        $this->questions[] = $question;
    }

    public function next()
    {
        $question = current($this->questions);

        next($this->questions);

        return $question;
    }

    public function answered()
    {
       return array_filter($this->questions, fn($question) => $question->answered());
    }

    public function remaining()
    {
       return array_filter($this->questions, fn($question) => ! $question->answered());
    }
 
    public function solved()
    {
        return array_filter($this->questions, fn($question) => $question->solved());
    }

    public function count()
    {
        return count($this->questions);
    }
}
