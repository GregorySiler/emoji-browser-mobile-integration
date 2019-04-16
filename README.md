# emoji-browser-mobile-integration

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

## Running the tests

There are 4 basic tests to this project.  convertMobile.php & convertBrowser.php prepares the text with standardized emoji placeholders and saves it to the database.  pushMobile.php & pushBrowser.php prepares the stored database text to be displayed on a mobile app or web browser.

### convertMobile.php

This is an example where Emoji codes from a mobile app output string are replaced with a placeholder that reflects the emoji.  

```
Give an example
```

### convertBrowser.php

This is an example where Emoji image tags from a browser output string are replaced with a placeholder that reflects the emoji.  

```
Give an example
```

### pushMobile.php

In this example, the saved output string (containing emoji placeholders) is processed and all placeholders are replaced with their cooresponding mobile emoji codes - rendering it correctly on mobile devices.

```
Give an example
```

### pushBrowser.php

In this example, the saved output string is processed and all placeholders are replaced with their cooresponding image tags - rendering it correctly on browsers.

```
Give an example
```


## Deployment

Nothing additional

## Authors

* **Greg Siler** - *Initial work*

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
