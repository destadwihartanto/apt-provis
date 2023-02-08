<select name="<?=$type?>" id="<?=$type?>" class="form-control js-example-basic-single" style="width: 100%;" required>
    <option value="">-- Pilih --</option>
    <?php foreach ($query as $key => $row): ?>
        <option value="<?=$row['id'] ?>"><?= $row['technician_name'] ?> (<?= $row['telepon'] ?>)</option>
    <?php endforeach; ?>
</select>