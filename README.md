# Employee Leave Calendar

A simple leave management system that allows employees to request and track their vacations, with manager approval workflow.

## Features

- **User Registration & Authentication** – Employees can register and log in.
- **Leave Requests** – Employees can create vacation requests that are saved with a **Pending** status.
- **Approval Workflow** – Managers (Admins) review and approve/reject requests.
- **Admin Role** – Admin privileges are assigned manually through the database.
- **Editable Requests** – Pending requests can be updated before approval.
- **Personal Dashboard** – Users can see a list of their submitted requests with statuses.

## Roles

- **Employee (User)**
  - Create and edit leave requests (while pending).
  - View personal leave history and statuses.

- **Manager (Admin)**
  - Approve or reject leave requests.
  - Manage leave workflow for employees.

## Installation

1. Clone the repository using git clone.
2. Open the file db_config.php from the project directory. Copy all SQL statements provided in the file. Go to your preferred MySQL interface.
3. Create a database named Calendar. Paste and execute the SQL code from db_config.php to create all necessary tables.
4. Find the file config.example.php in the config_bd directory. Rename it to config.php.
5. Open the config.php file and replace the placeholder values with your actual database information.



