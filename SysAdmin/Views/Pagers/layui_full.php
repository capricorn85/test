<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(3);
?>


<?php //dd($pager);?>
<div class="layui-box layui-laypage layui-laypage-molv">



    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getFirst() ?>"  aria-label="<?= lang('Pager.first') ?>" >
            首页
        </a>


    <?php endif ?>
    <?php foreach ($pager->links() as $link) : ?>
        <?php if ($link['active']):?>
            <span class="layui-laypage-curr"><em class="layui-laypage-em" style="background-color:#1E9FFF;"></em>
                <em> <?= $link['title'] ?></em>
            </span>

        <?php else:?>
            <a href="<?= $link['uri'] ?>" <?= $link['active'] ? 'class="active"' : '' ?>>
                <?= $link['title'] ?>
            </a>
        <?php endif;?>



    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>

        <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>"  class="layui-laypage-last">
          尾页
        </a>
    <?php endif ?>
    <span class="layui-laypage"><em class="layui-laypage-em" style="background-color:#1E9FFF;"></em>
                <em>共<?=$pager->getPageCount();?>页</em>
                <em>合计<?=$pager->getTotal();?>条</em>
            </span>


</div>
