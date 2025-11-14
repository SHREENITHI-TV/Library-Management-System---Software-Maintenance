# 📚 Library Management System

### Enhanced PHP–MySQL Web Application with Soft Delete, Version History & Full Activity Logging

---

## 🌟 Overview

This project is a modernized Library Management System built using **PHP**, **MySQL**, **HTML/CSS**, **Bootstrap**, and **jQuery**.
The original CRUD-only system was significantly upgraded to include professional-grade features such as:

* Soft delete with restore
* Hard delete with full auditing
* Version control for book updates
* Activity logging for all admin actions
* UI improvements and icons
* Search, filters, and user tracking
* Student table refinements
* Borrow/Return enhancements
* Exportable activity logs

This makes the application secure, reliable, and ready for real institutional use.

---

# 🚀 Features Added

## ✔ 1. Soft Delete for Books

* Deleted books are not removed — they move to a **Deleted** tab.
* Admin can restore with one click.
* Prevents accidental data loss.

## ✔ 2. Hard Delete (Permanent Removal)

* Completely removes the record from the database.
* Logged as a **HARD_DELETE** action.
* Uses a trash icon for UI clarity.

## ✔ 3. Book Version History

A complete tracking system using a new table: **book_versions**

Each time a book is updated:

* The old state is saved as a version.
* Differences (before → after) are stored.
* Who changed it and when is recorded.
* UI highlights changed fields visually.

## ✔ 4. Activity Log (Audit Trail)

A new table **activity_logs** records every important action:

* Login / Logout
* Adding books
* Updating books
* Soft deleting
* Hard deleting
* Restoring

Displays:

* Admin ID
* Username
* Action
* Target entity
* Timestamp
* Cleaned-up details (e.g., changed fields)

## ✔ 5. Export & Clear Activity Logs

* Exports all logs to CSV.
* Clears database logs afterward.
* Useful for audits and backups.

---

# 🗃 Database Changes Summary

### New Tables

| Table             | Purpose                                                        |
| ----------------- | -------------------------------------------------------------- |
| **book_versions** | Stores version history for each book (snapshot before update). |
| **activity_logs** | Stores admin actions (create, update, delete, login, logout).  |

### Updated Tables

| Table       | Change                                                    |
| ----------- | --------------------------------------------------------- |
| **books**   | Added `deleted_at` for soft delete.                       |
| **student** | Renamed columns `course → department`, `section → batch`. |

---

# 📁 Project Structure (Important Files)

```
LibraryManagementSystem/
 ├── dbconnect.php
 ├── index.php
 ├── logout.php
 ├── app/
 │    ├── book/
 │    │     ├── book.php
 │    │     ├── manage-book.php
 │    │     ├── add-book.php
 │    │     ├── update-book.php
 │    │     ├── restore-book.php
 │    │     ├── delete-book.php (soft delete)
 │    │     ├── hard-delete-book.php
 │    │     ├── view-history.php
 │    │     ├── export-history.php
 │    │     └── ...
 │    ├── util/
 │    │     └── log_helper.php
 │    ├── admin/
 │    │     ├── view-activity.php
 │    │     └── export-activity.php
 │    ├── student/
 │    ├── transaction/
 │    └── ...
 ├── format/
 │    ├── header.php
 │    ├── sidebar.php
 │    └── footer.php
```

---

# 🔧 Technology Stack

| Component | Technology                   |
| --------- | ---------------------------- |
| Frontend  | HTML, CSS, Bootstrap, jQuery |
| Backend   | PHP                          |
| Database  | MySQL                        |
| UI Icons  | Unicons                      |

---

# 🧪 How to Run

### 1. Install XAMPP

Start **Apache** and **MySQL**.

### 2. Place project folder

Copy it into:

```
C:\xampp\htdocs\LibraryManagementSystem
```

### 3. Create database

Import the provided `.sql` file (includes new tables & fields).

### 4. Configure DB connection

Edit `dbconnect.php` to match your MySQL settings.

### 5. Visit in browser

```
http://localhost/LibraryManagementSystem/
```

### 6. Login as admin

(Default credentials depend on your initial database data.)

---

# 🔒 Security Features

* All actions logged for future auditing
* Soft delete prevents accidental data loss
* Hard-delete fully tracked
* Session-based login/out tracking
* User-specific logs
* Input validation for student ID duplicates

---

# 🏁 Final Statement

This upgraded Library Management System transforms a basic CRUD application into a fully-featured, audit-ready, version-controlled platform.

It demonstrates skills in:

* Backend engineering
* Database design
* Data integrity
* UI/UX refinement
* System auditing
* PHP + MySQL development
* Enterprise-style logging and tracking

