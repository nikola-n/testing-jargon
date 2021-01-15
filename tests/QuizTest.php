<?php

namespace Tests;

use App\Quiz;
use Exception;
use App\Question;
use PHPUnit\Framework\TestCase;

class QuizTest extends TestCase
{
    //You can use multiple classes in a single test..

    /** @test */
    public function it_consists_of_questions()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2+2", 4));

        $this->assertCount(1, $quiz->questions());
    }

    /** @test */
    public function it_can_be_graded()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2+2", 4));

        // take the quiz
        $question = $quiz->nextQuestion();
        $question->answer(4);

        //grade the quiz
        $this->assertEquals(100, $quiz->grade());
    }

    /** @test */
    public function it_can_be_grade_a_failed_quiz()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2+2", 4));

        // take the quiz
        $question = $quiz->nextQuestion();
        $question->answer('incorrect answer');

        //grade the quiz
        $this->assertEquals(0, $quiz->grade());
    }

    /** @test */
    public function it_correctly_tracks_the_next_question_in_the_queue()
    {
        $quiz = new Quiz();
        $quiz->addQuestion($question1 = new Question("What is 2+2", 4));
        $quiz->addQuestion($question2 = new Question("What is 3+3", 6));

        $this->assertEquals($question1, $quiz->nextQuestion());
        $this->assertEquals($question2, $quiz->nextQuestion());
    }

    /** @test */
    public function it_cannot_be_graded_until_all_questions_have_been_answered()
    {
        $quiz = new Quiz();

        $quiz->addQuestion(new Question("What is 2+2", 4));

        $this->expectException(Exception::class);

        $quiz->grade();
    }

    /** @test */
    public function it_returns_false_if_there_are_no_remaining_questions()
    {
        $quiz = new Quiz();

        $quiz->addQuestion($question1 = new Question("What is 2+2", 4));

        $quiz->nextQuestion();

        $this->assertFalse($quiz->nextQuestion());
    }
}
