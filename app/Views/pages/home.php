<?= view('partials/header', ['title' => 'Home']) ?>
<div class="eyebrow">Point-of-sale management</div>
<h1>Keep every sale moving.</h1>
<p>Outlast POS gives your team one clear place to manage customers, staff accounts, and the daily rhythm of your store.</p>
<div class="actions">
    <a class="button" href="<?= site_url('customers') ?>">View customers</a>
    <a class="button secondary" href="<?= site_url('users') ?>">View staff accounts</a>
</div>
<?= view('partials/footer') ?>