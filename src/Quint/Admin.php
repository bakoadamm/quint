<?php


namespace Quint\Quint;


class Admin {
    const MENU = [];

    public static function addMenu($menu) {
        self::MENU[] = $menu;
    }
}
