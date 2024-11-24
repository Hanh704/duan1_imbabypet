<?php

class DashboardController {
    public function index() {
        session_start();
        if (!isset($_SESSION['MaQuyen']) || $_SESSION['MaQuyen'] != 1) {
            header("Location: ?act=admin/loginForm");
            exit;
        }
        
        require_once './views/dashboard.php';
    }
}