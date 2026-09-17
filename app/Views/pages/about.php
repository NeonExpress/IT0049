<?= view('partials/header', ['title' => 'About']) ?>
<div class="eyebrow">About Outlast POS</div>
<h1>A practical foundation for your counter.</h1>
<p>This first version is a simple CodeIgniter 4 POS website. Customer and staff account records are currently provided by temporary PHP arrays so the core pages and navigation can be reviewed before a database is added.</p>
<div class="actions"><a class="button" href="<?= site_url('customers') ?>">Explore customer accounts</a></div>
<?= view('partials/footer') ?>