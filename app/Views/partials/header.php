<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | Outlast POS</title>
    <style>
        * { box-sizing: border-box; }
        body { color: #000; font-family: Arial, sans-serif; margin: 0; }
        header { border-bottom: 1px solid #000; padding: 1rem; }
        .brand { color: #000; font-weight: bold; margin-right: 2rem; text-decoration: none; }
        nav { display: inline; }
        nav a { color: #000; margin-right: 1rem; }
        main { margin: 0 auto; max-width: 900px; padding: 2rem 1rem; }
        h1 { font-size: 2rem; margin: 0 0 1rem; }
        h2 { font-size: 1.5rem; }
        p { line-height: 1.5; max-width: 650px; }
        .eyebrow { font-weight: bold; margin-bottom: 1rem; }
        .actions { margin-top: 1rem; }
        .button { color: #000; display: inline-block; margin-right: 1rem; }
        .table-wrap { overflow-x: auto; }
        table { border-collapse: collapse; min-width: 600px; width: 100%; }
        th, td { border: 1px solid #000; padding: .6rem; text-align: left; }
        th { font-weight: bold; }
        .count { margin-bottom: 1rem; }
        footer { border-top: 1px solid #000; margin: 0 auto; max-width: 900px; padding: 1rem; }
    </style>
</head>
<body>
<header>
    <a class="brand" href="<?= site_url('/') ?>">Outlast POS</a>
    <nav aria-label="Main navigation">
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
    </nav>
</header>
<main>