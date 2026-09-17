<?= view('partials/header', ['title' => 'User Accounts']) ?>
<div class="eyebrow">Team access</div>
<h2>User Accounts</h2>
<div class="count"><?= count($users) ?> sample staff accounts</div>
<div class="table-wrap">
    <table>
        <thead><tr><th>Username</th><th>Full name</th><th>Role</th></tr></thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['role']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= view('partials/footer') ?>