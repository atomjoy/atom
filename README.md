# Atom Blog - Szablon Wordpress

Minimalistyczny responsywny szablon Wordpress :) bez bloków do dalszej rozbudowy z formularzem kontaktowym, formularzem newslettera, stroną autora, wyszukiwaniem.

## Konfiguracja wp-config.php

```php
<?php

// SMTP Dodaj email i hasło Gmail (do formularz kontaktowy i subscribe)
define('SMTP_username', 'twoj-email@gmail.com');    // wpisz swój adres e-mail dla WordPress
define('SMTP_password', 'twoje-haslo');             // tu podaje swoje hasło
define('SMTP_server', 'smtp.gmail.com');            // tu podaj swój host serwera poczty
define('SMTP_FROM', 'twoj-email@gmail.com');        // wpisz swój adres e-mail dla WordPress
define('SMTP_NAME', 'Biuro');                 // tu podaj np. swoje imie
define('SMTP_PORT', '587');                   // tu podaj numer portu np. 465 dla SSL lun 587 dla tls
define('SMTP_SECURE', 'tls');                 // Szyfrowanie SSL lub TLS
define('SMTP_AUTH', true);                    // Uwierzytelnienie (true|false)
define('SMTP_DEBUG',0);                       // dla debugowania błędów 0/1/2

// Social media url
define('SOCIAL_X', 'https://x.com/username');
define('SOCIAL_FACEBOOK', 'https://facebook.com/username');
define('SOCIAL_INSTAGRAM', 'https://instagram.com/username');
define('SOCIAL_YOUTUBE', 'https://youtube.com/username');

// Baza danych
define('DB_NAME', 'wp_dev');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Wyświetlaj błędy
define('WP_DEBUG', true);
```

## Koszt szablonu

Cena: 50 EUR do zastosowań komercyjnych pod strony www (za każdą stronę internetową).

## Opis plików szablonu Wordpress

```sh
index.php – główny szablon i plik strony wymagany do poprawnego działania witryny.
front-page.php – szablon statycznej strony głównej w WordPress (nadpisuje index.php, home.php).
home.php – domyślny szablon WordPress prezentujący ostatnie wpisy na stronie głównej (nadpisuje index.php).
single.php – szablon pojedynczego wpisu w WordPress.
single-{post_type}.php – szablon pojedynczego wpisu w WordPress w niestandardowej taksonomii.
page.php – szablon pojedynczej podstrony w WordPress (nadpisuje index.php).
category.php – szablon kategorii WordPress (nadpisuje index.php).
category-{category_slug}.php – szablon konkretnej kategorii WordPress.
archive.php – szablon archiwalnych podstron, autorów, kategorii lub dat (nadpisuje index.php, fallback category.php).
archive-cars.php – szablon archiwalnych podstron, autorów, kategorii lub dat (nadpisuje index.php, fallback category.php).
comments.php – szablon sekcji z komentarzami WordPress.
search.php – szablon strony wyszukiwarki WordPress.
tag.php – szablonu tagu WordPress.
author.php – szablon strony autora WordPress.
date.php – szablon strony z datami WordPress.
attachment.php – szablon strony załącznika WordPress.
image.php – szablon strony załącznika obrazka w WordPress.
taxonomy.php – szablon elementów należących do niestandardowej taksonomii (kategorii np. cars).
taxonomy-cars.php – szablon elementów należących do niestandardowej taksonomii (kategorii np. cars).
taxonomy-brands.php – szablon elementów należących do niestandardowej taksonomii (kategorii np. cars).
404.php  – szablon strony błęd 404 w WordPress.
```

## Obrazki

<img src="https://raw.githubusercontent.com/atomjoy/atom/refs/heads/main/blog-front.png" width="100%">
<img src="https://raw.githubusercontent.com/atomjoy/atom/refs/heads/main/blog-single-post.png" width="100%">
