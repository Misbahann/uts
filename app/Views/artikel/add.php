<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>
<form action="<?= base_url('/admin/artikel/add'); ?>" method="post" enctype="multipart/form-data">
    <p>
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" required>
    </p>
    <p>
        <label for="isi">Isi</label>
        <textarea name="isi" id="isi" required></textarea>
    </p>
    <p>
        <label for="gambar">Gambar</label>
        <input type="file" name="gambar" id="gambar" required>
    </p>
    <p>
        <label for="status">Status</label>
        <input type="radio" name="status" value="0" checked> Draft
        <input type="radio" name="status" value="1"> Publish
    </p>
    <p><button type="submit">Submit</button></p>
</form>
<?= $this->include('template/admin_footer'); ?>