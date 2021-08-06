<?php

$mysql_username = "mustacheo";
$mysql_password = "yw7k331yrxhrxbb7";
$mysql_host = "brasstaxes-expenses-do-user-9579838-0.b.db.ondigitalocean.com";
$mysql_database = "brasstaxes-expenses";
$mysqli_port = 25060;


$db = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database, $mysqli_port);
echo "<br><br>MYSQLI CONNECT - Using brasstaxes-expenses DO<br>";

print_r($db);

if ($db)
{

    $GLOBALS['db'] = $db;


    $sql = "CREATE TABLE IF NOT EXISTS `expenses_users` (
        `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `dob` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `context_id` int(10) unsigned NOT NULL DEFAULT 1,
        `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `max_accounts` int(10) unsigned NOT NULL DEFAULT 1,
        `ssn_ein` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `bt_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `is_admin` tinyint(1) DEFAULT 0,
        `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `cell` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `password_reset_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `password_reset_timestamp` datetime DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`),
        UNIQUE KEY `email_2` (`email`),
        UNIQUE KEY `ssn_ein` (`ssn_ein`)
    ) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $result = mysqli_query($GLOBALS['db'], $sql);        

        $error = mysqli_error($GLOBALS['db']);

        echo "<br><br>MYSQL USERS CREATE<br>";

        if ($error != "")
        {
            echo "ERROR: $error";
        }


    $sql = "CREATE TABLE IF NOT EXISTS `expenses_items` (
        `item_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
        `access_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `user_id` int(10) unsigned NOT NULL,
        `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `institution_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `inserted_at` datetime DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT current_timestamp(),
        `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'live',
        `plaid_transaction_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        PRIMARY KEY (`access_token`),
        UNIQUE KEY `item_id` (`item_id`),
        KEY `items_index` (`status`,`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL ITEMS CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }


    $sql = "CREATE TABLE IF NOT EXISTS `expenses_accounts` (
        `user_id` int(10) unsigned NOT NULL,
        `account_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `mask` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `official_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `subtype` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `institution_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `item_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'live',
        `inserted_at` datetime DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT current_timestamp(),
        `balances_available` bigint(20) DEFAULT NULL,
        `balances_current` bigint(20) DEFAULT NULL,
        `balances_iso_currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `balances_limit` bigint(20) DEFAULT NULL,
        `balances_unofficial_currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `full_history` tinyint(1) DEFAULT 0,
        PRIMARY KEY (`account_id`),
        KEY `accounts_filter` (`status`,`user_id`,`item_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL ACCOUNTS CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }


    $sql = "CREATE TABLE IF NOT EXISTS `expenses_transactions` (
        `account_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `account_owner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `account_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `authorized_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `category` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `category_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `date` date DEFAULT NULL,
        `iso_currency_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_region` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `location_store_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `memo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `merchant_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_channel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_by_order_of` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_payee` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_payer` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_payment_processor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_ppd_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_reason` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `payment_meta_reference_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `pending` tinyint(1) DEFAULT NULL,
        `pending_transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `transaction_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `transaction_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `unofficial_currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `user_id` int(10) unsigned NOT NULL,
        `source_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `transaction_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        `external_transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
        `amount` decimal(10,2) DEFAULT NULL,
        `tax_category_id` int(10) DEFAULT 10,
        `location_lon` decimal(20,15) DEFAULT NULL,
        `location_lat` decimal(20,15) DEFAULT NULL,
        `updated_at` datetime DEFAULT current_timestamp(),
        `inserted_at` datetime DEFAULT current_timestamp(),
        `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'live',
        `category_set_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'auto',
        `flags` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
        PRIMARY KEY (`transaction_id`),
        UNIQUE KEY `external_transaction_id` (`external_transaction_id`),
        KEY `transactions_filter` (`status`,`user_id`,`date`,`account_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=76354 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL TRANSACTIONS CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }


    $sql = "CREATE TABLE IF NOT EXISTS `session_logs` (
            `user_id` int(10) unsigned DEFAULT NULL,
            `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `ip_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `session_time` int(10) unsigned DEFAULT NULL,
            `user_platform` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `window_inner_height` int(10) unsigned DEFAULT NULL,
            `window_outer_height` int(10) unsigned DEFAULT NULL,
            `window_screen_height` int(10) unsigned DEFAULT NULL,
            `window_inner_width` int(10) unsigned DEFAULT NULL,
            `window_outer_width` int(10) unsigned DEFAULT NULL,
            `window_screen_width` int(10) unsigned DEFAULT NULL,
            `screen_color_depth` int(10) unsigned DEFAULT NULL,
            `screen_pixel_depth` int(10) unsigned DEFAULT NULL,
            `window_device_pixel_ratio` int(10) unsigned DEFAULT NULL,
            `navigator_max_touch_points` int(10) unsigned DEFAULT NULL,
            `document_referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `session_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            PRIMARY KEY (`session_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL SESSION CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `expenses_error_logs` (
            `error_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `error_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `display_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `request_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `user_id` int(10) unsigned DEFAULT NULL,
            `error_time` datetime DEFAULT current_timestamp(),
            `additional_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `additional_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `source` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `error_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `error_url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `error_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            PRIMARY KEY (`error_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=5690 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL ERROR CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `expenses_plaid_webhooks` (
        `webhook_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `webhook_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `webhook_time` datetime DEFAULT current_timestamp(),
        `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `webhook_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (`webhook_id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=2421 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL WEBHOOKS CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `expenses_user_history` (
            `user_id` int(10) unsigned DEFAULT NULL,
            `change_log` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `changed_at` datetime DEFAULT current_timestamp(),
            `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `foreign_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `history_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            PRIMARY KEY (`history_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=3018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL HISTORY CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `expenses_plaid_categories` (
        `plaid_category_id` int(10) unsigned NOT NULL,
        `top_level_plaid_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `plaid_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `irs_category_id` int(10) unsigned DEFAULT NULL,
        `irs_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `flags` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `notes` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        PRIMARY KEY (`plaid_category_id`),
        UNIQUE KEY `plaid_category_id` (`plaid_category_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL PLAID CATEGORIES <br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }

    $sql = "CREATE TABLE IF NOT EXISTS `expenses_bt_category_ids` (
            `irs_category_id` int(11) NOT NULL,
            `irs_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`irs_category_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL BT CATEGORIES CREATE<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }


    $sql = "LOAD DATA LOCAL INFILE 
    '{$GLOBALS['root_dir']}/resources/data_files/expenses_plaid_categories.tsv' 
    INTO TABLE 
        expenses_plaid_categories 
    LINES TERMINATED BY '\r\n' 
    IGNORE 1 LINES";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL LOAD PLAID CATEGORIES<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }


    $sql = "LOAD DATA LOCAL INFILE 
    '{$GLOBALS['root_dir']}/resources/data_files/expenses_brasstaxes_category_ids.tsv' 
        INTO TABLE 
            expenses_bt_category_ids 
        LINES TERMINATED BY '\r\n' 
        IGNORE 1 LINES";

    $result = mysqli_query($GLOBALS['db'], $sql);        

    $error = mysqli_error($GLOBALS['db']);

    echo "<br><br>MYSQL LOAD BT CATEGORIES<br>";

    if ($error != "")
    {
        echo "ERROR: $error";
    }
}
?>