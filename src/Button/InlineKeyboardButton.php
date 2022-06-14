<?php

namespace pouriaho\TgBotKbManager\Button;

use pouriaho\TgBotKbManager\CallbackGame;
use pouriaho\TgBotKbManager\LoginUrl;
use pouriaho\TgBotKbManager\WebAppInfo;

/**
 * InlineKeyboardButton class
 * 
 * Create new button for inline keyboard markup
 * 
 * @link https://core.telegram.org/bots/api#inlinekeyboardbutton
 */
class InlineKeyboardButton implements ButtonInterface
{
    /**
     * Text of the button. If none of the optional fields are used,
     *      it will be sent as a message when the button is pressed
     *
     * @var string
     */
    public string $text;

    /**
     * Optional. Data to be sent in a callback query to the bot whenbutton is pressed,
     *  
     * - 1-64 bytes
     *
     * @var string
     */
    public string $callback_data;

    /**
     * Optional. HTTP or tg:// url to be opened when the button is pressed.
     *      Links tg://user?id=<user_id> can be used to mention a user by their ID
     *      without using a username, if this is allowed by their privacy settings.
     *
     * @var string
     */
    public string $url;

    /**
     * Optional. Description of the Web App that will be launched when the user presses
     *      the button. The Web App will be able to send an arbitrary message on
     *      behalf of the user using the method answerWebAppQuery.
     *      Available only in private chats between a user and the bot.
     *
     * @var WebAppInfo
     */
    public WebAppInfo $web_app;

    /**
     * Optional. An HTTP URL used to automatically authorize the user.
     *      Can be used as a replacement for the Telegram Login Widget.
     *
     * @var LoginUrl
     */ 
    public LoginUrl $login_url;

    /**
     * Optional. If set, pressing the button will prompt the user to select
     *      one of their chats, open that chat and insert the bot's username and
     *      the specified inline query in the input field. Can be empty, in which
     *      case just the bot's username will be inserted.
     *
     * Note: This offers an easy way for users to start using your bot in
     *      inline mode when they are currently in a private chat with it.
     *      Especially useful when combined with switch_pm… actions
     *      - in this case the user will be automatically returned to the chat
     *      they switched from, skipping the chat selection screen.
     * 
     * @var string
     */ 
    public string $switch_inline_query;

    /**
     * Optional. If set, pressing the button will insert the bot's username and
     *      the specified inline query in the current chat's input field.
     *      Can be empty, in which case only the bot's username will be inserted.
     * 
     * This offers a quick way for the user to open your bot in inline mode in the same chat.
     *      good for selecting something from multiple options.
     *
     * @var string
     */
    public string $switch_inline_query_current_chat;

    /**
     * Optional. Description of the game that will be launched when the user presses the button.
     *
     * NOTE: This type of button must always be the first button in the first row.
     * 
     * @var CallbackGame
     */
    public CallbackGame $callback_game;

    /**
     * Optional. Specify True, to send a Pay button.
     *
     * NOTE: This type of button must always be the first button in the first row
     *      and can only be used in invoice messages.
     * 
     * @var boolean
     */
    public bool $pay;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }


    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackData(): string
    {
        return $this->callback_data;
    }

    /**
     * @param string $callbackData
     * @return self
     */
    public function setCallbackData(string $callbackData): self
    {
        $this->callback_data = $callbackData;
        return $this;
    }

    /**
     * @return LoginUrl
     */
    public function getLoginUrl(): LoginUrl
    {
        return $this->login_url;
    }

    /**
     * @param LoginUrl $loginUrl
     * @return self
     */
    public function setLoginUrl(LoginUrl $loginUrl): self
    {
        $this->login_url = $loginUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getSwitchInlineQuery(): string
    {
        return $this->switch_inline_query;
    }

    /**
     * @param string $switchInlineQuery
     * @return self
     */
    public function setSwitchInlineQuery(string $switchInlineQuery): self
    {
        $this->switch_inline_query = $switchInlineQuery;
        return $this;
    }

    /**
     * @return string
     */
    public function getSwitchInlineQueryCurrentChat(): string
    {
        return $this->switch_inline_query_current_chat;
    }

    /**
     * @param string $switchInlineQueryCurrentChat
     * @return self
     */
    public function setSwitchInlineQueryCurrentChat(string $switchInlineQueryCurrentChat): self
    {
        $this->switch_inline_query_current_chat = $switchInlineQueryCurrentChat;
        return $this;
    }

    /**
     * @return CallbackGame
     */
    public function getCallbackGame(): CallbackGame
    {
        return $this->callback_game;
    }

    /**
     * @param CallbackGame $callbackGame
     * @return self
     */
    public function setCallbackGame(CallbackGame $callbackGame): self
    {
        $this->callback_game = $callbackGame;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPay(): bool
    {
        return $this->pay;
    }

    /**
     * @param boolean $pay
     * @return self
     */
    public function setPay(bool $pay): self
    {
        $this->pay = $pay;
        return $this;
    }

    /**
     * @return WebAppInfo
     */
    public function getWebAppInfo(): WebAppInfo
    {
        return $this->web_app;
    }

    /**
     * Contains information about a Web App.
     *
     * @param WebAppInfo $webApp
     * @return self
     * @link https://core.telegram.org/bots/api#webappinfo
     */
    public function setWebApp(WebAppInfo $webApp): self
    {
        $this->web_app = $webApp;
        return $this;
    }
}