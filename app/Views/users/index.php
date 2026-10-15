<?= view('partials/header', ['title' => 'User Accounts']) ?>
<div class="eyebrow">Team access</div>
<h2>User Accounts</h2>
<div class="actions"><a class="button" href="<?= site_url('users/new') ?>">Add user</a></div>
<?php if (session('success')): ?>
    <div class="alert success" role="status"><?= esc(session('success')) ?></div>
<?php endif; ?>
<div class="count"><?= count($users) ?> user accounts</div>
<div class="table-wrap">
    <table>
        <thead><tr><th>Avatar</th><th>Username</th><th>Full name</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <?php
            $avatar = basename((string) ($user['avatar'] ?? ''));
            $hasAvatar = $avatar !== '' && is_file(FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $avatar);
            $avatarUrl = $hasAvatar
                ? base_url('uploads/avatars/' . rawurlencode($avatar))
                : base_url('images/avatar-placeholder.svg');
            ?>
            <tr>
                <td><img class="avatar" src="<?= esc($avatarUrl) ?>" alt="<?= esc($user['full_name']) ?> profile picture"></td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        <?php if ($users === []): ?>
            <tr><td colspan="4">No user accounts yet.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?= view('partials/footer') ?>
