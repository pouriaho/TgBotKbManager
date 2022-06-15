# Telegram Bot Keyboard Manager
Created by Pouria Bashiri

Version 1.0.0 (Beta)

## What's this?
With this you can manage keyboards in your Telegram bot so easily!

For example, you can build ReplyMarkupKeyboard and InlineMarkupKeyboard keyboards and add or delete,or replace buttons in keyboard, ... etc.

## Usage
With `pouriaho\TgBotKbManager\Button\ReplyKeyboardButton` & `pouriaho\TgBotKbManager\Button\InlineKeyboardButton` you can build button for each keyboard types.

### Build `ReplyKeyboardMarkup`:
```php
<?php

use pouriaho\TgBotKbManager\Button\ReplyKeyboardButton;
use pouriaho\TgBotKbManager\Keyboard\ReplyKeyboardMarkup;
use pouriaho\TgBotKbManager\Button\ReplyKeyboardButtonPollType;

// Define keyboard and it's buttons
$keyboard = [
    [
        (new ReplyKeyboardButton('Account')),
        (new ReplyKeyboardButton('About')),
    ],
    [
        (new ReplyKeyboardButton('Shop')),
        (new ReplyKeyboardButton('Help')),
    ],
    
    // other buttons with diffrent types
    // [
    //      (new ReplyKeyboardButton('Send My Number'))->setRequestContact(true),
    //      (new ReplyKeyboardButton('Send My Location'))->setRequestLocation(true),
    //      (new ReplyKeyboardButton('Create Poll'))->setRequestPoll(new ReplyKeyboardButtonPollType('regular')),
    //      // etc
    // ],
];

// Pass $keyboard to the class
$keyboard = (new ReplyKeyboardMarkup($keyboard));

// Finally you can use it in yout request
$telegram->sendMessage([
      'text' => 'TEST',
      'chat_id' => 968552906,
      'reply_markup' => $keyboard->toJson() // convert $keyboard to json string
]);
```
#### Above code result:

 <img src="https://s25.picofile.com/file/8450927942/photo_2022_06_15_17_07_06.jpg" title="Code Result">

***

### Build `InlineKeyboardMarkup`:
```php
<?php

use pouriaho\TgBotKbManager\Button\InlineKeyboardButton;
use pouriaho\TgBotKbManager\Keyboard\InlineKeyboardMarkup;

$inlineKeyboard = [
    [
        (new InlineKeyboardButton('Account'))->setCallbackData('cmd=account'),
        (new InlineKeyboardButton('About'))->setCallbackData('cmd=about'),
    ],
    [
        (new InlineKeyboardButton('Shop'))->setCallbackData('cmd=shop'),
        (new InlineKeyboardButton('Help'))->setCallbackData('cmd=help'),
    ],
    
    // other buttons with diffrent types
    // [
    //     (new InlineKeyboardButton('Google'))->setUrl('https://google.com'),
    //     (new InlineKeyboardButton('TEXT 1'))->setSwitchInlineQuery('Some String 1'),
    //     (new InlineKeyboardButton('TEXT 2'))->setSwitchInlineQueryCurrentChat('Some String 2'),
    //     (new InlineKeyboardButton('Pay'))->setPay(true),
    //     // etc
    // ]
];

$inlineKeyboard = (new InlineKeyboardMarkup($inlineKeyboard));

$telegram->sendMessage([
      'text' => 'TEST',
      'chat_id' => 968552906,
      'reply_markup' => $inlineKeyboard->toJson() // convert $keyboard to json string
]);
```
#### Above code result:

 <img src="https://s24.picofile.com/file/8450928092/photo_2022_06_15_17_14_30.jpg" title="Code Result">
 
***

## License
Please see the <a href="https://github.com/pouriaho/TgBotKbManager/blob/main/LICENSE">LICENSE</a> included in this repository for a full copy of the MIT license, which this lib is licensed under.
