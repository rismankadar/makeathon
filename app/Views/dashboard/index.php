<?= $this->extend('templates/templates') ?>

<?= $this->section('content') ?>
    <?= $this->include('templates/sidebar'); ?>
    <?= $this->include('templates/header'); ?>

    <?= $this->include('dashboard/main'); ?>
    
    <?= $this->include('templates/footer'); ?>
<?= $this->endSection() ?>