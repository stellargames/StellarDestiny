<?php
// This is global bootstrap for autoloading

// Copy a cleanly migrated and seeded database in place.
copy('database/setup.sqlite', sys_get_temp_dir() . '/testing.sqlite');

