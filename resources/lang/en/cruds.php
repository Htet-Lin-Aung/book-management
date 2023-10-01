<?php

    return [
        'user_management' => [
            'title' => 'User Management',
        ],
        'user'  => [
            'title' => 'Users',
            'title_singular' => 'User',
            'fields'=> [
                'name'  =>  'Name',
                'email' =>  'Email',
                'role'  =>  'Role',
                'password' => 'Password',
                'confirm_password' => 'Confirm Password',
            ]
        ],
        'customer' => [
            'title' => 'Customers',
            'title_singular' => 'Customer'
        ],
        'category' => [
            'title' => 'Categories',
            'title_singular' => 'Category'
        ],
        'book' => [
            'title' => 'Books',
            'title_singular' => 'Book',
            'author' => 'Author',
            'price' => 'Price',
        ],
        'sale' => [
            'title' => 'Sold Books',
            'title_singular' => 'Sold Book',
            'quantity' => 'Quantity',
            'discount' => 'Discount',
            'total' => 'Total',
            'paid' => 'Paid',
            'due' => 'Due'
        ],
        'report' => [
            'title' => 'Reports',
            'title_singular' => 'Report'
        ],
        'role'  => [
            'title' => 'Roles',
            'title_singular' => 'Role',
            'fields'=> [
                'name'  =>  'Name',
            ]
        ],
        'permission'  => [
            'title' => 'Permissions',
            'title_singular' => 'Permission',
        ],
    ];
