<select name="lang" id="lang">
    <option value="<?= $this->activeLanguage['code'] ?>"><?= $this->activeLanguage['title'] ?></option>
    <?php foreach ($this->languages as $k => $v): ?>
        <?php if ($this->activeLanguage['code'] != $k): ?>
            <option value="<?= $k ?>"><?= $v['title'] ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>