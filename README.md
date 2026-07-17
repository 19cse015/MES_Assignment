# Manufacturing Execution System (MES) API

A RESTful Manufacturing Execution System (MES) backend built with Laravel 13 and PostgreSQL.

---

## Tech Stack

- Laravel 13
- PHP 8.4+
- PostgreSQL
- Laravel Sanctum
- L5 Swagger (OpenAPI)
- Repository Pattern
- Service Layer
- REST API

---

## Features

### Authentication

- Login
- Logout
- Profile
- Sanctum Authentication

---

### Role Based Access

- System Admin
- Production Manager
- Warehouse Manager
- Machine Operator
- Quality Inspector

---

### Product Category

- Create
- List
- View
- Update
- Delete

Supports

- Search
- Filter
- Sorting
- Pagination

---

### Product

- Create
- List
- View
- Update
- Delete

Supports

- Search
- Filter
- Sorting
- Pagination

---

### Material Category

- Create
- List
- View
- Update
- Delete

Supports

- Search
- Filter
- Sorting
- Pagination

---

### Material

- Create
- List
- View
- Update
- Delete

Supports

- Search
- Filter
- Sorting
- Pagination

---

### Bill of Materials (BOM)

- Create
- List
- View
- Update
- Delete
- Approve BOM

Supports

- Search
- Filter
- Sorting
- Pagination

---

### Production Order

(Currently in development)

- Create Production Order
- Release Production Order
- Start Production
- Complete Production
- Close Production

---

## API Documentation

Swagger UI

```
/api/documentation
```

Generate Documentation

```bash
php artisan l5-swagger:generate
```

---





## Default Users

| Role | Email | Password |
|-------|-------|----------|
| System Admin | admin@example.com | password |
| Production Manager | manager@example.com | password |
| Warehouse Manager | warehouse@example.com | password |
| Machine Operator | operator@example.com | password |
| Quality Inspector | inspector@example.com | password |

---

## Project Structure

```
Controller
      │
      ▼
Service
      │
      ▼
Repository
      │
      ▼
Model
      │
      ▼
Database
```

---

## Business Workflow

```
Product
     │
     ▼
Create BOM
     │
     ▼
Approve BOM
     │
     ▼
Create Production Order
     │
     ▼
Release
     │
     ▼
Start
     │
     ▼
Complete
     │
     ▼
Close
```

---

## Documentation

- README
- Swagger Documentation
- ER Diagram
- System Architecture

---

## Author

Md. Arif Hossain
