<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>
<?= $this->include('template/sidebar') ?>
<?= $this->include('template/header') ?>
<?= $this->include('test/main') ?>
<?= $this->include('template/footer') ?>

<?= $this->endSection() ?>