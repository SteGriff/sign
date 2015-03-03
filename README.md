# SIGN

**Digital signs on lots of screens, updating in real time**

http://sign.me.uk

## What

I wanted one of those scrolling red-LED displays for the office but built this instead as a ubiquitous tech solution. Say you want to make a little sign to put on your desk, displaying... your current energy level. You could use a smartphone, kindle, or even a smart TV as your sign.

Create your sign by popping your text, like 'Energy: High!' in the sign create box and clicking the button.

You'll be taken to an editor for your new sign. It tells you the address to use to display it, something like sign.me.uk/1. Simply visit that address on your phone, kindle, TV, or all at once! Every sign has it's own passcode, like cromulent-biscuit-trader-5. You can edit your sign by putting the passcode in the Resume box, or just by going to sign.me.uk/{passcode}. You can bookmark the edit page because it will never change.

As soon as you update the text, all the devices showing your sign will change! Magical!

## How

SIGN requires:
 * PHP 5ish,
 * MySQL database (unless you want to rewrite the DAL to accomodate flat files - that would be a welcome pull request!)
 * Putting your connection details in `dal/dal.php`
 
It uses corpus.php to generate passcodes, which is 3840 words (all 5 characters or longer). These are combined in triplets with an extra digit from 0-9, making 566,231,040,000 possible codes.

## Brand and license

So, if you decide to run your own instance, I'd ask that you change the name and the logo of the service. Other than that, all of the code is here released to the public domain, for the public good. See LICENSE.TXT

## Hello

Send a quick note if you end up using it for something cool, just to say hi :) `github@stegriff.co.uk` and check out my other projects if you're feeling it.