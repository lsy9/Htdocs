<!-- 悬浮窗 -->
<div class="fixed">
    <div class="right">
        <a href="./shopcar.php">
            <span>车
                <?php if(isset($_SESSION['shopcar']) && !empty($_SESSION['shopcar'])){ ?>
                <sup style="color:red;position:absolute;right: 3px;top: -5px;"><?php echo count($_SESSION['shopcar']); ?></sup>
                <?php } ?>
            </span>
        </a>
        <a href="#">爱心</a>
        <a href="#">历史</a>
        <a href="#">留言</a>
        <a href="#">回</a>
    </div>
    <div class="backTop">
        <a href="#">^</a>
        <a href="#">写</a>
    </div>
</div>