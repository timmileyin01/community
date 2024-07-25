
# Event Planning System

Welcome to the Event Planning System! This project is a comprehensive web application designed to simplify the process of organizing, managing, and attending events. It features a variety of user roles, each with unique functionalities tailored to their needs.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [User Roles and Permissions](#user-roles-and-permissions)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Features

- **Guest:** Browse events, RSVP to events (payment required if the event is not free)
- **Registered User:** All guest functionalities
- **Vendor:** Create, view, update, and delete their services, including event centers
- **Event Planner:** Create, view, update, and delete events, view available venues and vendors
- **Admin:** Manage events and services, excluding user management and site settings
- **Super Admin:** Full access to all functionalities, including user management and site settings

## Technologies Used

- HTML
- CSS
- JavaScript
- PHP
- AJAX
- jQuery

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/timmileyin01/community.git
   ```

2. Navigate to the project directory:

   ```bash
   cd community
   ```

3. Set up your server environment (e.g., using XAMPP, WAMP, or MAMP). Ensure PHP and MySQL are running.

4. Import the database:
   - Locate the SQL file within the `database` directory.
   - Use your preferred database management tool (e.g., phpMyAdmin) to import the SQL file into your database.

5. Update the database configuration in the project file (In a configuration file `connect.php`) to match your local setup.

6. Open the project in your browser:

   ```bash
   http://localhost/community
   ```

## Usage

Once installed, you can log in or register to access the features based on your role. The system provides interfaces for:

- Browsing and RSVPing to events
- Creating and managing events and services
- Viewing and updating user profiles
- Admin and super admin functionalities for comprehensive management

## User Roles and Permissions

### Guest

- View and browse events
- RSVP to events (payment if the event is not free)

### Registered User

- All guest functionalities

### Vendor

- Create, view, update, and delete their services, including event centers

### Event Planner

- Create, view, update, and delete events
- View available venues and vendors

### Admin

- Manage events and services (excluding user management and site settings)

### Super Admin

- Full access to all functionalities, including user management and site settings

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes and push to your branch.
4. Submit a pull request with a detailed description of your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

If you have any questions or suggestions, feel free to open an issue or contact me directly at [oluwaseyitimm03@gmail.com](mailto:oluwaseyitimm03@gmail.com).

---

Feel free to adjust the content as per your project's specific details and requirements.
