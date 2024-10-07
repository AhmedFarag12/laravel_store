# Laravel Store Application

This is a simple Store application built using Laravel, MySQL, AJAX, and JavaScript. The application allows users to browse through products, add items to the cart, and proceed to checkout.

## Features
- Product listing and details view.
- Add products to the cart via AJAX (without page reload).
- Update product quantity and remove items from the cart dynamically.
- Checkout and order management.
- Backend CRUD operations for products, categories, and orders.
- Responsive UI.

## Requirements
Before you begin, ensure you have the following installed:
- PHP 7.4 or higher
- Composer
- MySQL
- Node.js & NPM (for compiling assets)

## Installation

Follow these steps to set up and run the project:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/store-app.git
   cd store-app
   ```

2. **Install dependencies:**
   Run the following command to install PHP and JavaScript dependencies:
   ```bash
   composer install
   npm install
   ```

3. **Set up environment:**
   Copy the `.env.example` file to `.env` and modify the necessary settings (like database credentials).
   ```bash
   cp .env.example .env
   ```

   In the `.env` file, set your database information:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=store_db
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Migrate the database and seed data:**
   Run the following commands to create tables and insert sample data:
   ```bash
   php artisan migrate --seed
   ```

6. **Compile front-end assets:**
   Use Laravel Mix to compile assets (CSS and JS):
   ```bash
   npm run dev
   ```

7. **Run the application:**
   Start the local development server:
   ```bash
   php artisan serve
   ```

   The application will now be running at `http://localhost:8000`.

## Usage

### Browsing Products
- Access the homepage and view a list of available products.
- Click on a product to view more details.

### Adding Items to Cart
- Add items to the cart by clicking the "Add to Cart" button.
- The cart will be updated dynamically using AJAX without a page refresh.

### Updating Cart
- Increase or decrease the quantity of items in the cart, or remove items directly from the cart page.
- The cart updates dynamically via AJAX.

### Checkout
- Once you're ready, proceed to the checkout page to finalize your order.
- The checkout form collects shipping details and processes the order.

### Admin Panel
- Admins can log in to manage products, categories, and orders via the backend dashboard.

## Project Structure

```bash
├── app
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── public
│   └── css
│   └── js
├── resources
│   └── views
│       └── layouts
│       └── products
├── routes
│   └── web.php
├── tests
└── .env
```

- **Routes:** All web routes are defined in `routes/web.php`.
- **Views:** The front-end templates are stored in `resources/views/`.
- **Migrations:** Database migrations are stored in `database/migrations/`.
- **Assets:** JavaScript and CSS files are located in the `public/js/` and `public/css/` directories.

## Technologies Used
- **Laravel:** PHP framework for backend logic.
- **MySQL:** Relational database to store products, categories, orders, etc.
- **AJAX:** Used for asynchronous requests, especially for cart updates.
- **JavaScript:** Provides dynamic interactions on the front end.

## Contributing

If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

1. Fork the repository
2. Create a new branch (`git checkout -b feature-branch`)
3. Make your changes
4. Commit your changes (`git commit -am 'Add some feature'`)
5. Push to the branch (`git push origin feature-branch`)
6. Create a new Pull Request


