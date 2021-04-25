<?php

// Include Web routes
require_once __DIR__ . "/components/web.php";

// Include Api routes
require_once __DIR__ . "/components/api.php";

// Include Web Dashboard routers for project CRUD
require_once __DIR__ . "/components/dashboard/projects.php";

// Include Web Dashboard routers for newses CRUD
require_once __DIR__ . "/components/dashboard/newses.php";

// Include Web Dashboard routers for users management
require_once __DIR__ . "/components/dashboard/users.php";