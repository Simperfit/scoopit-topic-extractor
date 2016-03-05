# scoopit-topic-extractor
Extract publications from a scoop.it topic and aggregate them into a CSV file.

![Preview](../master/preview.png?raw=true)

##What the purpose of this tool ?
This tool helps you to extract scoop.it posts of a particular topic. Perfect for backing up or data migration from scoop.it to another tool/CMS.

You can download a .csv file containing the following data related from posts associated to topic :
- **type:** POST or LINK
- **url:** if publication is a LINK
- **title:** publication title
- **description:** publication description
- **image_url:** scoop.it URL of image attached to publication
- **date:** publication date

##Install


- Install Composer dependencies management tool (if not already installed)

https://getcomposer.org/download/

- Install dependencies through Composer
```
composer install
```

- Enjoy !

##Potential know issues

This tool uses a DOM parser to fetch and parses HTML pages.   
If scoop.it change the structure of their pages, it will break.
