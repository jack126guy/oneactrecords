# Technical Information

## Database Schema

The `schema.sql` file contains a SQL script for creating the database, geared toward MySQL. There are two "variables" that should be replaced in the script:

* `%prefix%`: The table prefix, which is used to support multiple installations in a single database. If this is not needed, the variable can be replaced with an empty string.
* `%collation%`: The default collation for text fields. For MySQL, this should be one that starts with `utf8mb4_`, such as `utf8mb4_unicode_ci` or the newer `utf8mb4_unicode_520_ci`.