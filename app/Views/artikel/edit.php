<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>
<form action="<?= base_url('/admin/artikel/edit/' . $artikel['id']); ?>" method="post">
    <p>
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="<?= $artikel['judul']; ?>">
    </p>
    <p>
        <label for="isi">Isi</label>
        <textarea name="isi"><?= $artikel['isi']; ?></textarea>
    </p>
    <p>
        <label for="gambar">Gambar</label>
        <input type="text" name="gambar" value="<?= $artikel['gambar']; ?>">
    </p>
    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
<?= $this->include('template/admin_footer'); ?>
