<?php
$isEdit = is_array($customer);
$errors = session('errors') ?? [];
$action = $isEdit ? site_url('customers/' . $customer['id']) : site_url('customers');
?>
<?= view('partials/header', ['title' => $title]) ?>
<div class="eyebrow">Customer accounts</div>
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

<form action="<?= $action ?>" method="post" class="account-form">
    <?= csrf_field() ?>

    <label for="full_name">Full name <span aria-hidden="true">*</span></label>
    <input id="full_name" name="full_name" type="text" maxlength="100" required
           value="<?= old('full_name', $customer['full_name'] ?? '') ?>">

    <label for="email">Email <span aria-hidden="true">*</span></label>
    <input id="email" name="email" type="email" maxlength="100" required
           value="<?= old('email', $customer['email'] ?? '') ?>">

    <label for="phone">Phone</label>
    <input id="phone" name="phone" type="tel" maxlength="20"
           value="<?= old('phone', $customer['phone'] ?? '') ?>">

    <div class="form-actions">
        <button class="button" type="submit"><?= $isEdit ? 'Update customer' : 'Create customer' ?></button>
        <a href="<?= site_url('customers') ?>">Cancel</a>
    </div>
</form>
<?= view('partials/footer') ?>
