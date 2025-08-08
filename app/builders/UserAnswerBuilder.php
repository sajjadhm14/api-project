<?php

namespace App\builders;

use App\Models\UserAnswer;
use App\Models\SelectOption;
use App\Models\TextAnswer;

class UserAnswerBuilder
{
    protected $data; 
    protected $user; 
    protected $isCorrect = false; 

    public function setUser($user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

    protected function determineCorrectness(): void
    {
        if (!empty($this->data['select_option_id'])) {
            $questionId = $this->data['question_id'] ?? null;
            $selectOptionId = $this->data['select_option_id'];

            if ($questionId) {
                $option = SelectOption::where('question_id', $questionId)
                    ->where('id', $selectOptionId)
                    ->first();

                $this->isCorrect = $option && $option->is_correct;
            }
        }

        if (!empty($this->data['answer_text'])) {
            $questionId = $this->data['question_id'] ?? null;
            $answerText = $this->data['answer_text'];

            if ($questionId) {
                $expectedAnswer = TextAnswer::where('question_id', $questionId)->value('expected_answer');

                if (!is_null($expectedAnswer)) {
                    $this->isCorrect = strtolower(trim($expectedAnswer)) === strtolower(trim($answerText));
                }
            }
        }
    }

    // ذخیره‌سازی جواب (ایجاد یا آپدیت)
    public function save(UserAnswer $userAnswer ): UserAnswer
    {
        $this->determineCorrectness();

        if ($userAnswer) {
            // آپدیت جواب موجود
            $userAnswer->update([
                'answer_text' => $this->data['answer_text'] ?? $userAnswer->answer_text,
                'select_option_id' => $this->data['select_option_id'] ?? $userAnswer->select_option_id,
                'points' => $this->isCorrect ? 1 : 0,
            ]);
            return $userAnswer; 
        } else {
            // ایجاد جواب جدید
            return UserAnswer::create([
                'user_id' => $this->user->id,
                'question_id' => $this->data['question_id'],
                'answer_text' => $this->data['answer_text'] ?? null,
                'select_option_id' => $this->data['select_option_id'] ?? null,
                'points' => $this->isCorrect ? 1 : 0,
            ]);
        }
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
