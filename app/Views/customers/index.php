<?= view('partials/header', ['title' => 'Customer Accounts']) ?>
<div class="eyebrow">Accounts</div>
<h2>Customer Accounts</h2>
<div class="actions"><a class="button" href="<?= site_url('customers/new') ?>">Add customer</a></div>
<?php if (session('success')): ?>
    <div class="alert success" role="status"><?= esc(session('success')) ?></div>
<?php endif; ?>
<div class="count"><?= count($customers) ?> customers</div>
<div class="table-wrap">
    <table>
        <thead><tr><th>Full name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
                <td><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        <?php if ($customers === []): ?>
            <tr><td colspan="4">No customer accounts yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?= view('partials/footer') ?>
