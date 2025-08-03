<?php

namespace App\builders;

use App\Models\UserAnswer;
Use App\Models\SelectOption;
use App\Models\TextAnswer;


class UserAnswerBuilder
{
    protected $data ; 
    protected $user ; 
    protected $iscorrect = false ; 


    public function setUser($user) :self
    {
        $this ->user = $user ; 
        return $this ;
    }

    public function setData($data): self
    {
        $this ->data = $data;
        return $this;
    }

    protected function  determineCorrectness()
    {
        if (!empty($this->data['select_option_id'])){
            $option = SelectOption::find($this->data['select_option_id']);
            $this-> iscorrect = $option && $option->is_correct;
        }

        if (!empty($this->data['answer_text'])){
            $correctAnswer = TextAnswer::where('question_id',$this->data['question_id'])->value('expected_answer');
            $this->iscorrect = strtolower(trim($correctAnswer)) === strtolower(trim($this->data['answer_text']));
        }

    }


    public function build(): UserAnswer
    {
        $this->determineCorrectness();

        return UserAnswer::create([
            'user_id' => $this->user->id,
            'question_id' => $this->data['question_id'],
            'answer_text' => $this->data['answer_text'] ?? null,
            'select_option_id' => $this->data['select_option_id'] ?? null,
            'points' => $this->iscorrect ? 1 : 0,
        ]);

    }

    public function iscorrect() : bool
    {
        return $this->iscorrect;
    }


}


