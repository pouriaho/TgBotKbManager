<?php

namespace pouriaho\TgBotKbManager;

/**
 * Contains information about a Web App.
 * @link https://core.telegram.org/bots/api#webappinfo
 */
class WebAppInfo
{
    /**
     * @var string
     */
    public string $url;

    /**
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
     * @link https://core.telegram.org/bots/api#webappinfo
     * @link https://core.telegram.org/bots/webapps#initializing-web-apps
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
     * An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
     *
     * @param string $url
     * @return self
     * @link https://core.telegram.org/bots/api#webappinfo
     * @link https://core.telegram.org/bots/webapps#initializing-web-apps
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
}