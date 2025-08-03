<?php

namespace App\builders;

use App\Models\UserAnswer;
Use App\Models\SelectOption;
use App\Models\TextAnswer;




class UserAnswerUpdateBuilder
{
    protected $userAnswer;
    protected $data;
    protected $iscorrect = false;

    public function setUserAnswer(UserAnswer $userAnswer) : self
    {
        $this-> userAnswer = $userAnswer;
        return $this;
    }

    public function setData($data): self 
    {
        $this ->data = $data;
        return $this;
    }

    protected function determineCorrectness() : void
    {
        if (!empty($this->data['select_option_id'])){
            $option = SelectOption::find($this->data['select_option_id']);
            $this->iscorrect = $option && $option->is_correct;
        }

        if (!empty($this->data['answer_text'])){
            $correctAnswer = TextAnswer ::where('question_id',$this->userAnswer->question_id)->value(['expected_answer']);
            $this->iscorrect = strtolower(trim($correctAnswer)) === strtolower(trim($this->data['answer_text']));
        }
    }

    public function update(): UserAnswer
    {
        $this->determineCorrectness();
        $this->userAnswer->update([
            'answer_text' => $this->data['answer_text'] ?? $this->userAnswer->answer_text,
            'select_option_id' => $this->data['select_option_id'] ?? $this->userAnswer->select_option_id,
            'points' => $this->iscorrect ? 1 : 0,
        ]);
        return $this->userAnswer;
    } 

    public function iscorrect() : bool
    {
        return $this->iscorrect;
    }
}