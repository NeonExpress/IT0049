<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin.juana', 'full_name' => 'Juana Lim', 'role' => 'Administrator'],
            ['username' => 'cashier.mario', 'full_name' => 'Mario Cruz', 'role' => 'Cashier'],
            ['username' => 'cashier.liza', 'full_name' => 'Liza Tan', 'role' => 'Cashier'],
            ['username' => 'manager.ramon', 'full_name' => 'Ramon Flores', 'role' => 'Manager'],
            ['username' => 'stock.ella', 'full_name' => 'Ella Navarro', 'role' => 'Inventory Staff'],
        ];

        return view('users/index', ['users' => $users]);
    }
}