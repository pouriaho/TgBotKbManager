<?php

namespace pouriaho\TgBotKbManager\Keyboard\Paginator;

use pouriaho\TgBotKbManager\Button\InlineKeyboardButton;
use pouriaho\TgBotKbManager\Keyboard\InlineKeyboardMarkup;

/**
 * InlineKeyboardPaginator class
 * 
 * Build an paginator
 */
class InlineKeyboardPaginator
{
    /**
     * @var array
     */
    public array $labels;

    /**
     * @var string
     */
    public string $callbackDataFormat = 'cmd=%s&to_page=%d';

    /**
     * @var string
     */
    public string $callbackDataDefaultCommand = 'paginatior';

    /**
     * @var integer
     */
    public int $selectedPage;

    /**
     * @var integer
     */
    public int $dataCount;

    /**
     * @var integer
     */
    public int $itemsPerPage;

    /**
     * @param integer $dataCount
     * @param integer $itemsPerPage
     * @param integer $selectedPage
     */
    public function __construct(int $dataCount, int $itemsPerPage, int $selectedPage)
    {
        $this->dataCount = $dataCount;
        $this->itemsPerPage = $itemsPerPage;
        $this->selectedPage = $selectedPage;
    }

    /**
     * Change paginator's buttons label
     *
     * @param array $labels
     * @return self
     */
    public function setLabels(array $labels): self
    {
        if (!isset($labels['default'])) {
            $labels['default'] = '%d';
        }
        $this->labels = $labels;
        return $this;
    }

    /**
     * Set callback data format
     * 
     * Default is: 'cmd=%s&to_page=%d'
     *
     * @param string $callbackDataFormat 
     * @return self
     */
    public function setCallbackDataFormat(string $callbackDataFormat): self
    {
        $this->callbackDataFormat = $callbackDataFormat;
        return $this;
    }

    /**
     * Set callback data command
     * 
     * This refers to 'cmd=%s ...' in the callback data format.
     * %s Which is used to identify that which button is clicked
     *
     * @param string $callbackDataCommand
     * @return self
     */
    public function setCallbackDataCommand(string $callbackDataCommand): self
    {
        $this->callbackDataCommand = $callbackDataCommand;
        return $this;
    }

    /**
     * @param integer $selectedPage
     * @return self
     */
    public function setSelectedPage(int $selectedPage): self
    {
        $this->selectedPage = $selectedPage;
        return $this;
    }

    /**
     * The data count you want to paginate
     *
     * @param integer $dataCount
     * @return self
     */
    public function setDataCount(int $dataCount): self
    {
        $this->dataCount = $dataCount;
        return $this;
    }

    /**
     * How many items you want to show to the user in per page? specify that.
     * 
     * @param integer $itemsPerPage
     * @return self
     */
    public function setItemsPerPage(int $itemsPerPage): self
    {
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }

    /**
     *
     * @return integer
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * Simply returns 1, because first page is 1 always.
     *
     * @return integer
     */
    public function getFirstPage(): int
    {
        return 1;
    }

    /**
     * @return integer
     */
    public function getPreviousPage(): int
    {
        return $this->selectedPage - 1;
    }

    /**
     * Get user's selected page
     *
     * @return integer
     */
    public function getSelectedPage(): int
    {
        return $this->selectedPage;
    }

    /**
     * @return integer
     */
    public function getNextPage(): int
    {
        return $this->selectedPage + 1;
    }

    /**
     * Get last page. this needs the data count which you should set when create an object (in the constructor).
     *
     * @return integer
     */
    public function getLastPage(): int
    {
        $number = $this->dataCount / $this->itemsPerPage;
        $pages = intval($number);
        return (is_float($number) ? $pages + 1 : $pages);
    }

    /**
     * Simply parses callback data and put that into [KEY => VALUE] pairs
     *
     * @param string $callbackData
     * @return array
     */
    public function getParamsFromCallbakData(string $callbackData): array
    {
        parse_str($callbackData, $parsedCallbackData);
        return $parsedCallbackData;
    }

    /**
     * Insteadof using setLabels method, set the buttons number which you want...
     * 
     * This will use default labels
     *
     * @param integer $buttons
     * @return self
     */
    public function buttons(int $buttons): self
    {
        if ($buttons === 3) {
            $this->labels = [
                'default' => '%d',
                'prev' => '‹ %d',
                'curr' => '.%d.',
                'next' => '%d ›',
            ];
        }
        // etc... 

        return $this;
    }
    
    /**
     * Get all labels patterns related to the selected page number
     *
     * @return array
     */
    private function getLabelsPattern(): array
    {
        $labels = $this->labels ?? $this->getDefaultLabels();

        $default = $labels['default'] ?? '';
        $first = $labels['first'] ?? '';
        $previous = $labels['prev'] ?? '';
        $current = $labels['curr'] ?? '';
        $next = $labels['next'] ?? '';
        $last = $labels['last'] ?? '';
        
        return [
            3 => [
                [$current, $default, $next],
                [$default, $current, $next],
                [$previous, $current, $next],
                [$previous, $current, $default],
                [$previous, $default, $current],
            ],
            5 => [
                [$current, $default, $default, $next, $last],
                [$default, $current, $default, $next, $last],
                [$default, $default,  $current, $next, $last],
                [$first, $previous, $current, $next, $last],
                [$first, $previous, $current, $default, $default],
                [$first, $previous, $default, $current, $default],
                [$first, $previous, $default, $default, $current],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getDefaultLabels(): array
    {
        return [
            'default' => '%d',
            'first' => '« %d',
            'prev' => '‹ %d',
            'curr' => '.%d.',
            'next' => '%d ›',
            'last' => '%d »',
        ];
    }

    /**
     * @return array
     */
    private function getTheAppropriateLabels(): array
    {
        $lastPage = $this->getLastPage();
        $selectedPage = $this->getSelectedPage();
        $labelsPatterns = $this->getLabelsPattern();
        $labels = $this->labels ?? $this->getDefaultLabels();
        $labelsCount = count($labels) - 1;
        
        if ($labelsCount === 3) {
            if ($selectedPage === 1) {
                $labels = $labelsPatterns[$labelsCount][0];
            } elseif ($selectedPage === 2) {
                $labels = $labelsPatterns[$labelsCount][1];
            } elseif ($selectedPage >= ($number = $lastPage - 1)) {
                $labels = array_slice($labelsPatterns[$labelsCount], -2)[$selectedPage - $number];
            }  else {
                $labels = $labelsPatterns[$labelsCount][2];
            }

        } elseif ($labelsCount === 5) {
            if ($selectedPage <= 3) {
                $labels = $labelsPatterns[$labelsCount][$selectedPage - 1];
            } elseif ($selectedPage >= ($number = $lastPage - 2)) {
                $labels = array_slice($labelsPatterns[$labelsCount], -3)[$selectedPage - $number];
            } else {
                $labels = $labelsPatterns[$labelsCount][3];
            }
        }
        
        return $labels;
    }

    /**
     * @return void
     */
    public function getTheAppropriateNumbers()
    {
        $firstPage = $this->getFirstPage();
        $previousPage = $this->getPreviousPage();
        $lastPage = $this->getLastPage();
        $selectedPage = $this->getSelectedPage();
        $nextPage = $this->getNextPage();
        $labels = $this->labels ?? $this->getDefaultLabels();
        $labelsCount = count($labels) - 1;

        if ($labelsCount === 3) {
            if ($selectedPage <= 2) {
                return [1, 2, 3];
            } elseif ($selectedPage === $lastPage - 1) {
                return [$previousPage, $selectedPage, $nextPage];
            } elseif ($selectedPage === $lastPage) {
                return [$selectedPage - 2, $previousPage, $selectedPage];
            } else {
                return [$previousPage, $selectedPage, $nextPage];
            }
        } elseif ($labelsCount === 5) {
            if ($selectedPage <= 3) {
                return [1, 2, 3, 4, 5];
            } elseif ($selectedPage === $lastPage - 1) {
                return [$firstPage, $selectedPage - 2, $previousPage, $selectedPage, $nextPage];
            } elseif ($selectedPage === $lastPage) {
                return [$firstPage, $selectedPage - 3, $selectedPage - 2, $previousPage, $selectedPage];
            } else {
                return [$firstPage, $previousPage, $selectedPage, $nextPage, $lastPage];
            }
        }
    }

    /**
     * @return InlineKeyboardMarkup
     */
    public function createKeyboard(): InlineKeyboardMarkup
    {
        $labels = $this->getTheAppropriateLabels();
        $numbers = $this->getTheAppropriateNumbers();

        $keyboard = [
            [
                $this->buildInlineButton($labels[0], $numbers[0]),
                $this->buildInlineButton($labels[1], $numbers[1]),
                $this->buildInlineButton($labels[2], $numbers[2]),
            ]
        ];

        if (count($labels) === 5) {
            $keyboard[0] = array_merge($keyboard[0], [
                $this->buildInlineButton($labels[3], $numbers[3]),
                $this->buildInlineButton($labels[4], $numbers[4]),
            ]);
        }

        return new InlineKeyboardMarkup($keyboard);
    }

    /**
     * Build button for pagination only.
     *
     * @param string $label
     * @param integer $page
     * @return void
     */
    private function buildInlineButton(string $label, int $page)
    {
        $button = new InlineKeyboardButton(sprintf($label, $page));
        $button->setCallbackData(sprintf(
            $this->callbackDataFormat, $this->callbackDataDefaultCommand, $page
        ));
        return $button;
    }
}