# Mellow Clo (Drupal reproduction)
Original website : [Visit here](https://mellowclo.com/).

## Get started

1. Clone the project on install it via an archive.
```bash
  git clone git@github.com:eliooooooo/Mellow-Clo-Drupal-Reproduction.git
```
2. Install the project dependencies using Composer.
```bash
  composer install
```
3. Import the database.
4. Import the configuration.
```bash
drush cim
```

## Contrib modules dependencies

- **Admin Toolbar** (drupal/admin_toolbar^3.5) :
*Improves the default administration toolbar menu by turning it into a drop-down, for fast access to all administration pages.*
- **Block Classes** (drupal/block_classes^1.0) :
*Block Classes allows users to add classes to block title, content, and wrapper of any block through the block's configuration interface.*
- **Linkit** (drupal/linkit^7.0) :
*Linkit provides an autocomplete interface for internal and external linking in rich-text editors.*
- **Pathauto** (drupal/pathauto^1.13) :
*The Pathauto module automatically generates URL/path aliases for various kinds of content.*
- **Webform** (drupal/webform^6.3@beta) :
*The Webform module is a powerful and flexible Open Source form builder and submission manager for Drupal.* (Webform in product single pages > Ask a question).
- **Gin** (drupal/gin^4.0) :
*A completely redesigned UI layout, enhanced with features like Darkmode, brings a fresh new look to your Drupal Admin interface.*

## Configurations

The configuration has been exported in the `data/config/sync` folder.
You can import them with :
```bash
  drush cim
```

## Credentials

To connect to administration, please use :
- username : admin
- password : admin123
