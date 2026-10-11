<?php
$isEdit = is_array($user);
$errors = session('errors') ?? [];
$action = $isEdit ? site_url('users/' . $user['id']) : site_url('users');
?>
<?= view('partials/header', ['title' => $title]) ?>
<div class="eyebrow">User accounts</div>
<h2><?= esc($title) ?></h2>

<?php if ($errors !== []): ?>
    <div class="alert error" role="alert">
        <strong>Please correct the following:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= $action ?>" method="post" enctype="multipart/form-data" class="account-form">
    <?= csrf_field() ?>

    <label for="username">Username <span aria-hidden="true">*</span></label>
    <input id="username" name="username" type="text" maxlength="50" required
           value="<?= old('username', $user['username'] ?? '') ?>">

    <label for="full_name">Full name <span aria-hidden="true">*</span></label>
    <input id="full_name" name="full_name" type="text" maxlength="100" required
           value="<?= old('full_name', $user['full_name'] ?? '') ?>">

    <?php if ($isEdit): ?>
        <?php
        $currentAvatar = basename((string) ($user['avatar'] ?? ''));
        $hasCurrentAvatar = $currentAvatar !== '' && is_file(FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $currentAvatar);
        $currentAvatarUrl = $hasCurrentAvatar
            ? base_url('uploads/avatars/' . rawurlencode($currentAvatar))
            : base_url('images/avatar-placeholder.svg');
        ?>
        <label for="avatar">Profile picture</label>
        <img class="avatar-preview" src="<?= esc($currentAvatarUrl) ?>" alt="Current profile picture">
        <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
        <small>JPG or PNG, maximum 2MB. The image will be cropped to a 300&times;300 thumbnail.</small>
    <?php endif; ?>

    <div class="form-actions">
        <button class="button" type="submit"><?= $isEdit ? 'Update user' : 'Create user' ?></button>
        <a href="<?= site_url('users') ?>">Cancel</a>
    </div>
</form>
<?= view('partials/footer') ?>
