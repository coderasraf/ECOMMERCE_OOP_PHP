# E-commerce Store (OOP PHP)

A small online store with a customer-facing shop and an admin panel, written in object-oriented PHP with MySQL (mysqli).

![PHP](https://img.shields.io/badge/PHP-OOP-777BB4?logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-mysqli-4479A1?logo=mysql&logoColor=white) ![jQuery](https://img.shields.io/badge/jQuery-1.7-0769AD?logo=jquery&logoColor=white)

## Overview

Built in mid-2021 as a learning project while following the Bangla "Training with Live Project" OOP PHP e-commerce course, on top of the course's HTML store and admin templates. It covers the typical shop flow from browsing to placing an order.

## Features

**Storefront**

- Homepage with slider, featured products and new products
- Product details page and products-by-category listing
- Top brands page
- Session-based shopping cart: add, update quantity, remove
- Customer registration, login, profile view and profile editing
- Checkout: payment option page, offline payment order placement, order history and success page
- Pretty URLs via `.htaccess` rewrites (e.g. `/cart`, `/products`, `/login`)

**Admin panel (`/admin`)**

- Admin login with session handling and change-password page
- Category and brand CRUD
- Product CRUD with image upload (type and size validation, unique file names)
- Featured / general product type flag
- Order list
- Template pages for slider, social links, site title/slogan and copyright

## Tech Stack

- PHP (OOP classes, sessions)
- MySQL via mysqli
- HTML/CSS, jQuery 1.7, FlexSlider
- Apache with mod_rewrite (XAMPP/WAMP/LAMP)

## Getting Started

1. Copy the project to your web root, e.g. `htdocs/ECOMMERCE_OOP_PHP`.
2. Create a MySQL database named `db_shop`. No SQL dump is included, so create the tables the code uses: `tbl_admin`, `tbl_category`, `tbl_brand`, `tbl_shop` (products), `tbl_cart`, `tbl_customer` and `tbl_order`.
3. Update the credentials in `config/config.php` (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
4. Make sure `admin/upload/` is writable for product images.
5. Visit `http://localhost/ECOMMERCE_OOP_PHP/` for the shop and `http://localhost/ECOMMERCE_OOP_PHP/admin/login.php` for the admin panel.

## Project Structure

```text
index.php, details.php, cart.php, ...   # Storefront pages
classes/          # Product, Category, Cart, Customer
lib/              # Database (mysqli), Session
helpers/          # Format (validation, formatting)
config/config.php # Database constants
inc/              # header, footer, slider
admin/
├── classes/      # AdminLogin, Category, Brand, Classes (products), Cart (orders)
├── lib/, helpers/
├── upload/       # Uploaded product images
└── *.php         # Dashboard, CRUD pages, login
```

## Credits

Store and admin templates and course structure from the "Training with Live Project" PHP course.

## Author

Built by **Ashraf Siddik**, Shopify developer & CRO specialist.
- Website: [ashraf-siddik.com](https://ashraf-siddik.com)
- GitHub: [@coderasraf](https://github.com/coderasraf)
