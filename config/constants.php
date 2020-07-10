<?php

if (!defined('ACC_STATUS')) {
    define('ACC_STATUS', [
        '0' => 'Nhân viên',
        '1' => 'Admin',
        '2' => 'Khách hàng',
    ]);
}
if (!defined('BILL_STATUS')) {
    define('BILL_STATUS', [
        0 => 'Đang chờ làm',
        1 => 'Đã hoàn thành',
        2 => 'Đã hủy',
        3 => 'Đã thanh toán',
    ]);
}
if (!defined('TABLE_STATUS')) {
    define('TABLE_STATUS', [
        '0' => 'Trống',
        '1' => 'Đang có khách'
    ]);
}
if (!defined('VOUCHER_STATUS')) {
    define('VOUCHER_STATUS', [
        '0' => 'Đã sử dụng',
        '1' => 'Chưa sử dụng'
    ]);
}
if (!defined('FOOD_STATUS')) {
    define('FOOD_STATUS', [
        '0' => 'Đang hoạt động',
        '1' => 'Ko hoạt động',
    ]);
}
if (!defined('FOOD_COOKING_STATUS')) {
    define('FOOD_COOKING_STATUS', [
        '0' => 'Đang làm',
        '1' => 'Đã xong',
    ]);
}