<?php

class Date_Post
{
    public static function init(): void
    {
        add_filter( 'the_title', array( __CLASS__, 'date_of_the_current_post' ) );
    }

    public static function plugin_activation(): void
    {
        if (version_compare(PHP_VERSION, DATE_POST_PHP_VERSION, '<')) {

            $message = __('The Plugin has been auto-deactivated. ') . sprintf(esc_html__('Date post plugin requires PHP %s or higher.'), DATE_POST_PHP_VERSION) . sprintf(__(' You have PHP version ' . PHP_VERSION . '. Please <a href="%1$s">upgrade PHP</a> to a necessary version. '), 'https://www.php.net/downloads');

            echo "<p>$message</p>";
            exit();
        }
    }

    public static function plugin_deactivation(): void
    {
        file_put_contents(DATE_POST_DIR . 'logs.txt', "Plugin was deactivating\n", FILE_APPEND);
    }

    public static function date_of_the_current_post($title): string
    {
        return $title . " " . get_the_date();
    }
}
