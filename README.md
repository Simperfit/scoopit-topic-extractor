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
```
php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === 'fd26ce67e3b237fffd5e5544b45b0d92c41a4afe3e3f778e942e43ce6be197b9cdc7c251dcde6e2a52297ea269370680') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

- Install dependencies through Composer
```
composer install
```

- Enjoy !

##Potential know issues

This tool uses a DOM parser to fetch and parses HTML pages.   
If scoop.it change the structure of their pages, it will break.
