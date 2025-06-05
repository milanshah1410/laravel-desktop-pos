# 🧾 Laravel POS Desktop App (NativePHP)

A modern, lightweight desktop Point of Sale (POS) application built using **Laravel** and **NativePHP** — ideal for retail stores like D-Mart or Big Bazaar. This app supports customer billing, inventory management, sales tracking, PDF invoice generation, and more.

---

## 📦 Features

- ✅ Add products to cart
- ✅ Real-time cart updates
- ✅ Checkout with discount & payment
- ✅ Invoice generation (printable & PDF)
- ✅ Inventory stock management
- ✅ Customer database with auto-detection
- ✅ Modern UI with sidebar layout
- ✅ Persistent local storage via SQLite/MySQL
- ✅ Runs as a native desktop app (via NativePHP)

---

## 🚀 Tech Stack

- **Laravel 11**
- **NativePHP** (Desktop wrapper)
- **Blade + Tailwind CSS**
- **Spatie Browsershot / DomPDF** for PDF export
- **Livewire** (optional, for dynamic UIs)
- **MySQL/SQLite** as DB (configurable)

---

## 📥 Installation

> Prerequisites:
> - PHP 8.2+
> - Composer
> - Node.js & NPM (for frontend)
> - [NativePHP installed globally](https://nativephp.com/docs/getting-started/installation)

```bash
git clone https://github.com/your-name/pos-nativephp.git
cd pos-nativephp

composer install
cp .env.example .env
php artisan key:generate

# Install NativePHP app shell
php artisan native:install

# Setup DB (you can use SQLite for desktop apps)
touch database/database.sqlite
php artisan migrate --seed

# Run app
php artisan native:serve
