# Event Reservation Management System

A web-based event reservation and management platform built with PHP, designed to streamline the process of creating, managing, and booking events. This system provides a comprehensive solution for event organizers and attendees to interact seamlessly.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Architecture](#architecture)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)


## Overview

The Event Reservation System is a full-featured web application that enables organizations and individuals to manage events efficiently. Whether you're organizing conferences, workshops, seminars, or social gatherings, this platform provides all the tools needed to handle registrations, manage attendees, and track event details.

## Features

### Core Functionality

- **Event Management**
  - Create and publish events with detailed information
  - Update event details in real-time
  - Delete or archive past events
  - Set capacity limits and track availability

- **Reservation System**
  - Easy booking process for attendees
  - Real-time availability checking
  - Reservation confirmation and tracking
  - Cancellation management

- **User Management**
  - Secure user authentication and authorization
  - Role-based access control (Admin, Organizer, Attendee)
  - User profile management
  - Registration and login functionality

- **Dashboard & Analytics**
  - Event organizer dashboard
  - Reservation statistics and reports
  - Attendee management interface
  - Visual data representation

### Additional Features

- Responsive design for mobile and desktop
- Search and filter capabilities
- Event categorization
- Calendar integration

## Technology Stack

**Backend:**
- PHP 7.4+ 
- MySQL for database management

**Frontend:**
- HTML5 & CSS3 
- JavaScript 
- Responsive CSS framework

**Server:**
- Apache web server
- XAMPP for local development

## Architecture

The application follows a traditional MVC-inspired architecture pattern:

```
├── app/                    # Application core files
│   ├── controllers/        # Request handlers and business logic
│   ├── models/            # Database models and data layer
│   └── views/             # UI templates and presentation layer
│
├── config/                # Configuration files
│   ├── database.php       # Database connection settings
│   └── config.php         # General application config
│
├── public/                # Publicly accessible files
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── images/           # Image assets
│
├── database.sql          # Database schema and initial data
└── ReadMe.md            # Project documentation
```

### Design Patterns

- **MVC Pattern**: Separation of concerns between data, presentation, and logic
- **Database Abstraction**: Centralized database connection handling
- **Session Management**: Secure user authentication and state management

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server


### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/rayen03/Gest-reservation-event.git
   cd Gest-reservation-event
   ```

2. **Configure your web server**
   - Point your document root to the project directory
   - Ensure mod_rewrite is enabled for Apache

3. **Set up the database**
   - Create a new MySQL database
   - Import the database schema (Database Setup below...)

4. **Configure database connection**
   - Navigate to `config/database.php`
   - Update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'database_name');
     define('DB_USER', 'username');
     define('DB_PASS', 'password');
     ```

5. **Set permissions**
   ```bash
   chmod -R 755 public/
   ```

6. **Access the application**
   - Open your browser and navigate to `http://localhost/Gest-reservation-event`

## Database Setup

1. **Create the database**
   ```sql
   CREATE DATABASE event_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. **Import the schema**
   ```bash
   mysql -u your_username -p event_reservation < database.sql
   ```

   Or use phpMyAdmin:
   - Open phpMyAdmin
   - Select your database
   - Click on the "Import" tab
   - Choose the `database.sql` file
   - Click "Go"

### Database Schema

The database includes tables for:
- **users**: User accounts and authentication
- **events**: Event details and metadata
- **reservations**: Booking information and status
- **categories**: Event categorization 

## Usage

### For Event Organizers

1. **Register/Login**: Create an account or log in with existing credentials
2. **Create Event**: Navigate to the dashboard and click "Create Event"
3. **Fill Details**: Add event name, description, date, time, location, and capacity
4. **Publish**: Make the event visible to attendees
5. **Manage**: Track reservations and update event details as needed

### For Attendees

1. **Browse Events**: View available events on the homepage
2. **Event Details**: Click on an event to see full information
3. **Make Reservation**: Click "Reserve" and confirm your booking
4. **View Reservations**: Check your booking history in your profile

### For Administrators

1. **User Management**: Add, edit, or remove user accounts
2. **Event Oversight**: Monitor all events and reservations
3. **System Configuration**: Manage settings and permissions


### Contributors

- [Rayen Hassen](https://github.com/rayen03) 
- [Aymen Chaouachi](https://github.com/AymenChaouachi) 

