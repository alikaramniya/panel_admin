<section class="panel">
    <header class="panel-heading">
        Advanced Table
    
    </header>
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <td>عنوان</td>
                <th>آدرس</th>
                <td>سرگروه</td>
                <th>وضعیت</th>
                <td>ترتیب</td>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>

            <?php
                if ($total > 0):
                    foreach ($listMenu as $value) :
            ?>

                <tr>
                    <td><?php echo $value->title; ?></td>
                    <td><?php echo $value->url; ?></td>
                    <td>
                        <?php
                            $chId = $value->chid;
                            switch (true) {
                                case $chId == 0:
                                    echo "ندارد";
                                    break;
                                case $parent = $menu->showEdit($chId):
                                    echo $parent->title;
                                    break;
                                default:
                                    echo "سرگروه حذف شده است";
                                    break;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            $status = $value->status;
                            $state = "<a href='index.php?c=menu&a=list&id=$value->id&active=no'><i class='btn btn-danger'>غیر فعال</i></a>";
                            if ($status == '1')
                                $state = "<a href='index.php?c=menu&a=list&id=$value->id&active=yes'><i class='btn btn-success'>فعال</i>";
                            echo $state;
                        ?>
                    </td>
                    <td><?php echo $value->sort; ?></td>
                    <td>
                        <a href="index.php?c=menu&a=edit&id=<?php echo $value->id; ?>">
                            <button class="btn btn-primary btn-xs"><i class="icon-edit"></i></button>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?c=menu&a=delete&id=<?php echo $value->id; ?>">
                            <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                        </a>
                    </td>
                </tr>

            <?php
                    endforeach;
                endif;
            ?>

        </tbody>
    </table>
</section>