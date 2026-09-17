<?= view('partials/header', ['title' => 'Customer Accounts']) ?>
<div class="eyebrow">Accounts</div>
<h2>Customer Accounts</h2>
<div class="count"><?= count($customers) ?> sample customers</div>
<div class="table-wrap">
    <table>
        <thead><tr><th>Full name</th><th>Email</th><th>Phone</th></tr></thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= view('partials/footer') ?>