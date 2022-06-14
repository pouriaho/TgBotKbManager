<?php

namespace pouriaho\TgBotKbManager\Button;

use pouriaho\TgBotKbManager\WebAppInfo;

abstract class AbstractButton
{
    /**
     * Text of the button. If none of the optional fields are used,
     *      it will be sent as a message when the button is pressed
     *
     * @var string
     */
    public string $text;

    abstract public function __construct(string $text);

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
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