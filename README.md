# emoji-browser-mobile-integration

![Screenshot](https://tugnpull.com/github-emoji/emoji_compatibility.png) 

This project is an attempt to create a system that feeds text with emoji data to both web browsers and mobile apps.  In this scenerio, we have a website that allows members to post messages that contain emoji image files.  We've also built a mobile app interface where members can post messages that contain mobile emoji codes.  The problem is that the 2 systems aren't compatible with each others emojis.  Our goal is to save these messages to our database using a placeholder code that cooresponds to an emoji, and when the message is served back to the mobile or browser device, the placeholder is replaced with the mobile emoji code or emoji image (depending on which interface is being served).

To keep things unified, placeholders and image files use the Emoji Code Point values.  😄 has a Code Point of U+!1F604, so the cooresponding image file would be 1f604.png and the emoji placeholder will be :{U+1F604}:.  The database supplied doesn't include image files for each emoji, but it does contain the base64 "data:image/png" data.  You can create your own image files from this data if you want - or just use the data directly from the database as your image tag source.  

## Getting Started

These instructions will get you a copy of the project up and running on a server for development and testing purposes. 

### Prerequisites

What things you need to install the software and how to install them

```
Server with PHP 7, MySQL 5+ Database, FTP Client
```

### Installing

Setup the database

```
Create a MySQL database (or use an existing one)
```

Import the Emoji Data table

```
Use the tbl_emojidata.sql to create the Emoji Data table.
```

Copy files

```
Copy all included files to your server.  Modify the functions.php - adding your login criteria for your database connection.
```

You should be all set to run the examples!

## Files included

There are 4 basic tests to this project.  convertMobile.php & convertBrowser.php prepares the text with standardized emoji placeholders and saves it to the database.  pushMobile.php & pushBrowser.php prepares the stored database text to be displayed on a mobile app or web browser.

### functions.php

This file contains database connection routines.  You should modify the database variables to match your database login.  This also contains a few utility functions needed for these examples.


### convertMobile.php

This is an example where Emoji codes from a mobile app output string are replaced with a placeholder that reflects the emoji.  

```
Returns a JSON result with the converted string, how many emoji records were searched in the database, and how many emojis were replaced in the string (this would be unique emojies, not total emojis).  

{ "error": false, "message": ":{U+1F604}: The energy of an electric eel. :{U+1F604}:", "searched": 3016, "replaced": 1 }
```

### convertBrowser.php

This is an example where Emoji image tags from a browser output string are replaced with a placeholder that reflects the emoji. This example requires emoji image tags to include an id attribute that matches the emoji.  Example: <img id="U+1F604" src="1f604.png"> The energy of an electric eel. <img id="U+1F604 src="1f604.png">.  These can easily be generated from the information provided in the emoji database supplied with this example.

```
Returns a JSON result with the converted string.  (Note: This message result will be identical to the result achieved converting from a mobile app output string above).

{ "error": false, "message": ":{U+1F604}: The energy of an electric eel. :{}:" }
```

### pushMobile.php

In this example, the saved output string (containing emoji placeholders) is processed and all placeholders are replaced with their cooresponding mobile emoji codes - rendering it correctly on mobile devices.

```
Returns a JSON result with the mobile emoji codes - ready to send to a mobile app.

{ "error": false, "message": "\ud83d\udc06 The energy of an electric eel. \ud83d\udc06" }
```

### pushBrowser.php

In this example, the saved output string is processed and all placeholders are replaced with their cooresponding image tags - rendering it correctly on browsers.

```
Returns a JSON result with the browser emoji image tags - ready to send to a browser interface.

{ "error": false, "message": "<img src="1f406.png"> The energy of an electric eel. <img src="1f406.png">" }
```


## Disclaimer

I am not a programmer, I'm a hobbiest. This code has not been 'massaged' or tested for perfection or error processing.  The examples work, and my system implements this logic.  This is just a down and dirty way to get the job done.  Any suggestions and improvements are greatly welcome.  I'm still learning. 

## Authors

* **Greg Siler** - *Initial work*

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
