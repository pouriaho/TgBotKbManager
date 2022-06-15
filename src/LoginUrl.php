<?php

namespace pouriaho\TgBotKbManager;

/**
 * This object represents a parameter of the inline keyboard button used to
 * automatically authorize a user. Serves as a great replacement for
 * the Telegram Login Widget when the user is coming from Telegram. All
 * the user needs to do is tap/click a button and confirm that they want to log in.
 */
class LoginUrl
{
    /**
     * @var string
     */
    public string $url;

    /**
     * @var string
     */
    public string $forward_text;

    /**
     * @var string
     */
    public string $bot_username;

    /**
     * @var boolean
     */
    public bool $request_write_access = true;

    /**
     * @param string $url
     *              An HTTP URL to be opened with user authorization data added
     *              to the query string when the button is pressed.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
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
     *              An HTTP URL to be opened with user authorization data added
     *              to the query string when the button is pressed.
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
    public function getForwardText(): string
    {
        return $this->forward_text;
    }

    /**
     * @param string $forwardText
     *              [Optional] - New text of the button in forwarded messages.
     * @return self
     */ 
    public function setForwardText(string $forwardText): self
    {
        $this->forward_text = $forwardText;
        return $this;
    }

    /**
     * @return string
     */
    public function getBotUsername(): string
    {
        return $this->bot_username;
    }

    /**
     * @param string $botUsername Username of a bot, which will be used for user authorization. Pass without @
     * @return self
     */
    public function setBotUsername(string $botUsername): self
    {
        $this->bot_username = $botUsername;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestWriteAccess(): bool
    {
        return $this->request_write_access;
    }

    /**
     * @param bool $requestWriteAccess Pass True to request the permission for your bot to send messages to the user.
     * @return self
     */ 
    public function setRequestWriteAccess(bool $requestWriteAccess): self
    {
        $this->request_write_access = $requestWriteAccess;
        return $this;
    }
}
