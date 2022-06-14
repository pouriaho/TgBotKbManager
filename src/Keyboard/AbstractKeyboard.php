<?php

namespace pouriaho\TgBotKbManager\Keyboard;

use pouriaho\TgBotKbManager\Button\ButtonInterface;

/**
 * AbstractKeyboard class
 */
abstract class AbstractKeyboard
{
    public const ROW_FIRST = 'first_row';
    public const ROW_LAST = 'last_row';
    public const BTN_FIRST = 'first_button';
    public const BTN_LAST = 'last_button';

    /**
     * Add a new button to keyboard
     *
     * @param ButtonInterface $newButton
     * @param integer|null $rowOffset
     * @param string|int|null $rowOffset 
     * @return self
     */
    public function addButton(
        ButtonInterface $newButton,
        ?int $rowOffset = null,
        ?int $buttonOffset = null
    ): self
    {
        if ($rowOffset === null) {
            $this->keyboard[] = [$newButton];
            return $this;
        }
        
        if ($rowOffset === self::ROW_FIRST) {
            $rowOffset = 0;

        } elseif ($rowOffset === self::ROW_LAST) {
            $rowOffset = count($this->keyboard) - 1;

        } else {
            $rowOffset = $rowOffset;
        }

        if ($buttonOffset === self::BTN_FIRST) {
            array_unshift($this->keyboard[$rowOffset], $newButton);
        
        } elseif ($buttonOffset === self::BTN_LAST) {
            array_push($this->keyboard[$rowOffset], $newButton);
        
        } else {
            array_splice($this->keyboard[$rowOffset], $buttonOffset, 0, [$newButton]);
        }

        return $this;
    }

    /**
     * Add new row with new buttons to the keyboard
     *
     * @param array $newButtons Array of ButtonInterface objects
     * @return self
     */
    public function addRow(array $newButtons): self
    {
        $this->keyboard[] = $newButtons;
        return $this;
    }
    
    /**
     * Replace two buttons with each other
     *
     * Example: 
     * - $firstButtonPosition  => [0, 0] <=> (Row 0, Offset 0)
     * - $secondButtonPosition => [0, 3] <=> (Row 0, Offset 3)
     * 
     * With the given position, it replaces first button with second button
     * 
     * @param array $firstButtonPosition
     * @param array $secondButtonPosition
     * @return self
     */
    public function replaceButton(array $firstButtonPosition, array $secondButtonPosition): self
    {
        $firstButtonrowOffset = $firstButtonPosition[0];
        $firstButtonOffset = $firstButtonPosition[1];

        $secondButtonrowOffset = $secondButtonPosition[0];
        $secondButtonOffset = $secondButtonPosition[1];

        $firstButton = $this->keyboard[$firstButtonrowOffset][$firstButtonOffset];
        $secondButton = $this->keyboard[$secondButtonrowOffset][$secondButtonOffset];

        $this->keyboard[$firstButtonrowOffset][$firstButtonOffset] = $secondButton;
        $this->keyboard[$secondButtonrowOffset][$secondButtonOffset] = $firstButton;

        return $this;
    }
    
    /**
     * Merge two different keyboards together
     *
     * @param array $keyboard New keyboard
     * @param boolean $addToStart Set given keyboard in start of new keyboard
     * @return self
     */
    public function merge(array $newKeyboard, bool $addToStart = false): self
    {
        $newKeyboard = $newKeyboard['inline_keyboard'] ?? $newKeyboard['keyboard'] ?? $newKeyboard;
        $keyboards = $addToStart ? [$newKeyboard, $this->keyboard] : [$this->keyboard, $newKeyboard];
        $this->keyboard = array_merge(...$keyboards);
        return $this;
    }
    
    /**
     * Delete a row from keyboard
     *
     * @param integer $rowOffset
     * @return self
     */
    public function deleteRow(int $rowOffset): self
    {
        array_splice($this->keyboard, $rowOffset, 1);
        return $this;
    }
    
    /**
     * Delete a button from keyboard
     *
     * @param integer $rowOffset
     * @param integer $buttonOffset
     * @return self
     */
    public function deleteButton(int $rowOffset, int $buttonOffset): self
    {
        array_splice($this->keyboard[$rowOffset], $buttonOffset, 1);
        return $this;
    }

    /**
     * Covert created keyboard to json string
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->getFields());
    }

    /**
     * Covert created keyboard to php array
     *
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->toJson(), true);
    }

    protected function getFields(): array
    {
        if ($this instanceof InlineKeyboardMarkup) {
            $fields['inline_keyboard'] = $this->keyboard;
        
        } elseif ($this instanceof ReplyKeyboardMarkup) {
            $fields['keyboard'] = $this->keyboard;
            $fields['resize_keyboard'] = $this->resizeKeyboard;
            $fields['one_time_keyboard'] = $this->oneTimeKeyboard;
            $fields['input_field_placeholder'] = $this->inputFieldPlaceholder;
            $fields['selective'] = $this->selective;
        }
        return $fields;
    }
}