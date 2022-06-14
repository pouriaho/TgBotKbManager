<?php

namespace pouriaho\TgBotKbManager\Keyboard;

use pouriaho\TgBotKbManager\Button\ButtonInterface;

/**
 * InlineKeyboardMarkup class
 * 
 * Create new inline keyboard markup
 * 
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 */
class InlineKeyboardMarkup extends AbstractKeyboard
{
    /**
     * @var array
     */
    public array $keyboard;

    public static $fields = [
        'inline_keyboard' => null,
    ];

    /**
     * Create a new InlineKeyboard
     *
     * @param array $inlineKeyboard Array of InlineKeyboardButton objects
     */
    public function __construct(array $keyboard)
    {
        $this->keyboard = $keyboard;
    }

}