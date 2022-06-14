<?php

namespace pouriaho\TgBotKbManager\Keyboard;

/**
 * ReplyKeyboardMarkup class
 * 
 * Create new reply keyboard markup
 * 
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 */
class ReplyKeyboardMarkup extends AbstractKeyboard
{
    /**
     * Array of button rows, each represented by an Array of ButtonInterface objects
     *
     * @var array (Array of Array of ButtonInterface)
     */
    public array $keyboard;

    /**
     * Requests clients to resize the keyboard vertically for optimal fit
     *      (e.g., make the keyboard smaller if there are just two rows of buttons).
     * 
     * - Defaults to true
     *
     * @var bool
     */
    public bool $resizeKeyboard;

    /**
     * Requests clients to hide the keyboard as soon as it's been used.
     *      The keyboard will still be available, but clients will automatically
     *      display the usual letter-keyboard in the chat – the user can press
     *      a special button in the input field to see the custom keyboard again.
     * 
     * - Defaults to false.
     *
     * @var bool
     */
    public bool $oneTimeKeyboard;

    /**
     * The placeholder to be shown in the input field when the keyboard is active.
     * 
     * - Defaults to empty string.
     * - Must be 1-64 characters
     *
     * @var string
     */
    public string $inputFieldPlaceholder;

    /**
     * Use this parameter if you want to show the keyboard to specific users only :
     * 
     * Targets 1 => users that are @mentioned in the text of the Message object;
     * 
     * Targets 2 => if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * 
     * Example: A user requests to change the bot's language,
     *      bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
     * 
     * - Default is true
     *
     * @var bool
     */
    public bool $selective;

    /**
     * The default settings for reply keyboard
     * 
     * Set it if you use a specific setting for most keyboards
     *
     * @var array
     */
    public static $defaultSettings = [
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true,
        'input_field_placeholder' => ''
    ];

    /**
     * Create a new keyboard
     *
     * @param array $keyboard Array of ButtonInterface objects
     * @param array $settings Current keyboard settings
     */
    public function __construct(array $keyboard, array $settings = [])
    {
        $this->keyboard = $keyboard;
        $this->resizeKeyboard = $settings['resize_keyboard'] ?? self::$defaultSettings['resize_keyboard'];
        $this->oneTimeKeyboard = $settings['one_time_keyboard'] ?? self::$defaultSettings['one_time_keyboard'];
        $this->inputFieldPlaceholder = $settings['input_field_placeholder'] ?? self::$defaultSettings['input_field_placeholder'];
        $this->selective = $settings['selective'] ?? self::$defaultSettings['selective'];
    }

}