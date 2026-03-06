# Inspiro

An online art marketplace where artists showcase, sell, and manage their creative work. Built with Laravel 11 and a modern, responsive UI.

## Features

- **Art Gallery** - Browse artworks by type, view details, and discover artists
- **Artist Portfolios** - Artists manage their artwork collections with status tracking (Pending, Active, Declined)
- **Marketplace** - List artworks for sale with pricing and quantity management
- **Shopping Cart & Orders** - Full e-commerce flow with cart, checkout, and order tracking (Active > Sent > Received)
- **Messaging System** - Direct messaging between users and artists
- **Event Management** - Browse upcoming art events, join as visitor or exhibitor
- **Admin Panel** - Full CRUD for users, artists, artworks, shop listings, and orders
- **Role-Based Access Control** - Admin, Editor, Artist, and User roles via Spatie Permissions
- **Contact Form** - Email-based contact with validation
- **Search** - Live search for artists with autocomplete

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.2+, Laravel 11 |
| Frontend | Blade Templates, Tailwind CSS 3, Alpine.js |
| Database | MariaDB / MySQL |
| Authentication | Laravel Breeze |
| Authorization | Spatie Laravel Permission |
| Build Tool | Vite 5 |

## Architecture

```
app/
  Http/
    Controllers/      # Request handling (thin controllers)
    Requests/          # Form Request validation classes
    Middleware/         # Role-based access control
  Models/              # Eloquent models with relationships & scopes
  Helpers/             # Utility classes
  Mail/                # Mailable classes
  View/Components/     # Blade components

resources/
  views/
    layouts/           # App, guest, navigation layouts
    components/        # Reusable Blade components (toast, buttons, etc.)
    home/              # Public pages (gallery, shop, blog, events, contact)
    dashboard/         # Authenticated area (portfolio, orders, basket, admin)
    user/              # Public user profiles
    artwork/           # Artwork CRUD forms
    auth/              # Login, register, password reset
    errors/            # Custom 404, 403, 500 pages

database/
  migrations/          # Schema definitions with indexes & cascades
  seeders/             # Seed data for all tables
```

## Installation

```bash
# Clone the repository
git clone https://github.com/kadima1012/Inspiro.git
cd Inspiro

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env
# DB_DATABASE=inspiro
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations and seed data
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

## Demo Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | john@example.com | password |
| Editor | jane@example.com | password |
| Artist | sarah@example.com | password |
| User | emily@example.com | password |

## User Roles

- **Visitor** - Browse gallery, shop, events, and artist profiles
- **User** - All visitor features + shopping cart, orders, messaging, event participation
- **Artist** - All user features + portfolio management, artwork uploads, marketplace listings, sales tracking
- **Admin** - Full platform management via admin panel

## License

MIT
