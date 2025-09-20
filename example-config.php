<?php
return [
    "databases" => [
        "main" => [
            "type" => "mysql",
            "host" => "localhost",
            "user" => "root",
            "password" => "secret",
            "dbname" => "main_db",
        ],
    ],

    "endpoints" => [
        "/customers/list" => [
            "script" => "scripts/customers_list.php",
            "method" => "GET",
            "db" => "main",
            "roles" => ["shop", "dashboard"],
        ],
        "/admin/stats" => [
            "script" => "scripts/admin_stats.php",
            "method" => "GET",
            "db" => "main",
            "roles" => ["dashboard"],
        ],
    ],

    "clients" => [
        "shop" => [
            "secret" => "supersecret123",
            "roles" => ["shop"],
            "blocked_endpoints" => ["/admin/stats"],
            "blocked_tables" => ["salaries", "admin_logs"]
        ],
        "dashboard" => [
            "secret" => "anotherSecret456",
            "roles" => ["dashboard"],
            "blocked_endpoints" => [],
            "blocked_tables" => []
        ],
    ],
];