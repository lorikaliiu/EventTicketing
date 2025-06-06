
# Event Management & Ticket Booking API

A RESTful API for managing events and booking tickets, built with Laravel.

## Setup Instructions

### 1. Clone and Install Dependencies

```bash
composer update
```

### 2. Create `.env` File and Configure Database

Duplicate the `.env.example` and rename it to `.env`:

```bash
cp .env.example .env
```

Edit the `.env` file and update the database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Create the Database

Ensure you have created a MySQL database named:

```
event_db
```

### 4. Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

This command will reset the database and seed it with default data.

---

## API Endpoints

| Endpoint | Method | Description | Auth Required | Admin Required | Request Body Example |
|----------|--------|-------------|----------------|----------------|----------------------|
| /api/register | POST | Register new user | No | No | `{ "name": "User", "email": "user@ex.com", "password": "pass123" }` |
| /api/login | POST | Login user | No | No | `{ "email": "user@ex.com", "password": "pass123" }` |
| /api/logout | POST | Logout user | Yes | No | - |
| /api/user | GET | Get user profile | Yes | No | - |
| /api/user | PUT | Update user profile | Yes | No | `{ "name": "New Name" }` |
| /api/events | GET | List all events | No | No | - |
| /api/events/{id} | GET | Get event details | No | No | - |
| /api/events/upcoming | GET | List upcoming events | No | No | - |
| /api/events/search | GET | Search events | No | No | - |
| /api/events | POST | Create event | Yes | Yes | `{ "name": "Event", "description": "Desc", "category": "Music", "start_time": "2023-12-01 20:00:00", "end_time": "2023-12-01 23:00:00", "price": 50, "venue_id": 1 }` |
| /api/events/{id} | PUT | Update event | Yes | Yes | `{ "name": "Updated Event" }` |
| /api/events/{id} | DELETE | Delete event | Yes | Yes | - |
| /api/venues | GET | List all venues | No | No | - |
| /api/venues/{id} | GET | Get venue details | No | No | - |
| /api/venues | POST | Create venue | Yes | Yes | `{ "name": "Venue", "location": "Address", "capacity": 1000 }` |
| /api/venues/{id} | PUT | Update venue | Yes | Yes | `{ "name": "Updated Venue" }` |
| /api/venues/{id} | DELETE | Delete venue | Yes | Yes | - |
| /api/events/{event}/tickets | POST | Book ticket | Yes | No | `{ "seat_info": "A12" }` |
| /api/tickets | GET | List user tickets | Yes | No | - |

---

## Notes

- Ensure Laravel app key is generated using:
```bash
php artisan key:generate
```
- Use Laravel Sanctum or Passport for API authentication as required.
