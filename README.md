# Daycare Management System

# Installation

- Change environment in `index.php`
- Open `application/config/<environment>` and edit `config.php` and `database.php`
- Run `php index.php migration run`. See migration options
- Run `php index.php migration seed`

## Migration options

>`php index.php migration <option>`:
- `run` Execute all migrations
- `run <version>` Run single migration by version number
- `undo` undo last migration
- `create` Generate migration files from database tables !!THIS MAY OVERWRITE CURRENT MIGRATIONS!!
- `create <ClassName>` Generate migration using specific class
- `seed` Seed data from all available seeders
- `seed <ClassName>` Seed data from specified class
- `refresh` Truncate all tables and run migrations again
- `help` show help options