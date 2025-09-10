<?php

class Performance_Monitor {
    private $start_time;
    private $sql_queries = 0;
    private $sql_total_time = 0;
    private $buffer_started = false;

    public function __construct() {
        add_action('wp_loaded', array($this, 'start_timer'));
        add_filter('query', array($this, 'start_query_timer'));
        add_action('db_query_executed', array($this, 'end_query_timer'), 10, 2);
        
        // Ранний старт буферизации
        add_action('template_redirect', array($this, 'start_buffer'), -999);
        add_action('shutdown', array($this, 'output_stats'), 999);
    }

    public function start_buffer() {
        $this->buffer_started = true;
        ob_start();
    }

    public function start_timer() {
        $this->start_time = microtime(true);
    }

    public function start_query_timer($query) {
        if (defined('SAVEQUERIES') && SAVEQUERIES) {
            global $wpdb;
            $wpdb->timer_start();
        }
        return $query;
    }

    public function end_query_timer($query, $time) {
        if (defined('SAVEQUERIES') && SAVEQUERIES) {
            $this->sql_queries++;
            $this->sql_total_time += $time;
        }
    }

    public function output_stats() {
        if (!$this->buffer_started || !current_user_can('manage_options')) return;

        $total_time = microtime(true) - $this->start_time;
        $php_time = $total_time - $this->sql_total_time;
        
        // Безопасное получение контента
        $content = '';
        while (ob_get_level() > 0) {
            $content .= ob_get_clean();
        }

        $original_size = strlen($content);
        $compressed_size = function_exists('gzencode') ? strlen(gzencode($content, 9)) : $original_size;

        // Восстанавливаем контент
        echo $content;

        // Вывод статистики
        echo '<div class="performance-info" style="padding:15px;background:#f5f5f5;border-top:2px solid #ddd;margin:20px 0;font-family:monospace;">';
        printf("Время генерации страницы: %.4f секунд<br>", $total_time);
        printf("Из них PHP: %.0f%%; SQL: %.0f%%; Число SQL-запросов: %d шт.<br>", 
            ($php_time/$total_time)*100, 
            ($this->sql_total_time/$total_time)*100, 
            $this->sql_queries);
        printf("Исходный размер: %d; Сжатая: %d", 
            $original_size, 
            $compressed_size);
        echo '</div>';
    }
}

//new Performance_Monitor();
?>
