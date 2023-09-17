<section class="panel">
    <header class="panel-heading">
        ویرایش منوی <?php echo $edit->title; ?>
    </header>
    <div class="panel-body">
        <form role="form" action="index.php?c=menu&a=edit&id=<?php echo $edit->id; ?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">عنوان</label>
                <input type="text" class="form-control" value="<?php echo $edit->title; ?>" id="exampleInputEmail1" name="frm[title]" placeholder="عنوان">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">آدرس</label>
                <input type="text" class="form-control" value="<?php echo $edit->url; ?>" id="exampleInputPassword1" name="frm[url]" placeholder="ادرس را وارد کنید">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">سرگروه</label>
                <select class="form-control m-bot15" name="frm[chid]">
                    <option value="0">سرگروه</option>
                    <?php
                        if ($total > 0):
                            foreach ($listChid as $value):
                    ?>
                                <option value="<?php echo $value->id; ?>"
                                    <?php
                                        if ($value->id == $edit->chid)
                                            echo "selected";
                                    ?>
                                ><?php echo $value->title; ?></option>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </select>
            </div>
            <div>
                <label for="exampleInputFile">وضعیت</label>
                <div>
                    <label class="radio">
                        <input type="radio" name="frm[status]" id="optionsRadios2" value="1" checked>
                        فعال
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="frm[status]" <?php if ($edit->status == 0) echo "checked"; ?> id="optionsRadios2" value="0">
                        غیر فعال
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">ترتیب</label>
                <input type="text" class="form-control" name="frm[sort]" value="<?php echo $edit->sort; ?>" id="exampleInputPassword1" placeholder="ترتیب را وارد کنید">
            </div>
            <button type="submit" class="btn btn-info">افزودن</button>
        </form>

    </div>
</section>
