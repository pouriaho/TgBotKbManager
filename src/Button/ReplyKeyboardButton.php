<?php

namespace pouriaho\TgBotKbManager\Button;

use pouriaho\TgBotKbManager\WebAppInfo;

/**
 * ReplyKeyboardButton class
 * 
 * Create new button for reply keyboard markup
 * 
 * @link https://core.telegram.org/bots/api#keyboardbutton
 */
class ReplyKeyboardButton implements ButtonInterface
{
    /**
     * Text of the button. If none of the optional fields are used,
     *      it will be sent as a message when the button is pressed
     *
     * @var string
     */
    public string $text;

    /**
     * Optional. If True, the user's phone number will be sent as a
     *      contact when the button is pressed. Available in private chats only.
     *
     * @var boolean
     */
    public bool $request_contact;

    /**
     * Optional. If True, the user's current location will be sent when
     *      the button is pressed. Available in private chats only.
     *
     * @var boolean
     */
    public bool $request_location;

    /**
     * Optional. If specified, the user will be asked to create a poll and
     *      send it to the bot when the button is pressed. Available in private chats only.
     *
     * @var ReplyKeyboardButtonPollType
     */
    public ReplyKeyboardButtonPollType $request_poll;

    /**
     * Optional. If specified, the described Web App will be launched when
     *      the button is pressed. The Web App will be able to send a “web_app_data”
     *      service message. Available in private chats only.
     *
     * @var WebAppInfo
     */
    public WebAppInfo $web_app;

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
     * @return boolean
     */
    public function getRequestContact(): bool
    {
        return $this->request_contact;
    }

    /**
     * @param bool $requestContact
     * @return self
     */
    public function setRequestContact(bool $requestContact): self
    {
        $this->request_contact = $requestContact;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestLocation(): bool
    {
        return $this->request_location;
    }

    /**
     * @param bool $requestLocation
     * @return self
     */
    public function setRequestLocation(bool $requestLocation): self
    {
        $this->request_location = $requestLocation;
        return $this;
    }


    /**
     * @return ReplyKeyboardButtonPollType
     */ 
    public function getRequestPoll(): ReplyKeyboardButtonPollType
    {
        return $this->request_poll;
    }

    /**
     * @param ReplyKeyboardButtonPollType  $requestPoll
     * @return self
     */ 
    public function setRequestPoll(ReplyKeyboardButtonPollType $requestPoll)
    {
        $this->request_poll = $requestPoll;
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