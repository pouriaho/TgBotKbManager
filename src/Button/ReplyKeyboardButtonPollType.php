<?php

namespace pouriaho\TgBotKbManager\Button;

class ReplyKeyboardButtonPollType
{
    /**
     * Optional. If quiz is passed, the user will be allowed to create only polls in
     *       the quiz mode. If regular is passed, only regular polls will be allowed,
     *      otherwise, the user will be allowed to create a poll of any type.
     *
     * @var string
     */
    public string $type;

    /**
     * @param string $type Can be 'quiz', 'regular' or pass empty string to create a poll of any type
     */
    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    /**
     * Get type of poll
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}