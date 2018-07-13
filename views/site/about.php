<?php
use yii\helpers\Url;
?>

<section id="content">
    <div class="ui container">
        <div class="conts">
            <div class="ui stackable four column grid">
                <div class="eleven wide column">
                    <h4 class="ui dividing header">
                        关于我
                    </h4>
                    <div class="ui hidden divider"></div>
                    <div class="ui yellow message">
                        <i class="star icon"></i>
                        <i class="close icon"></i>
                        如果有意见或建议可以 <em><a href="<?= Url::to(['site/contact'])?>">点击此处</a></em> 联系我们，万分感谢。
                    </div>
                    <div class="ui hidden divider"></div>
                    <h4 class="ui header">页面字体 (Page Font)</h4>
                    <p>站点可以自定义页面字体样式。</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel tincidunt eros, nec venenatis ipsum. Nulla hendrerit urna ex, id sagittis mi scelerisque vitae. Vestibulum posuere rutrum interdum. Sed ut ullamcorper odio, non pharetra eros. Aenean sed lacus sed enim ornare vestibulum quis a felis. Sed cursus nunc sit amet mauris sodales tempus. Nullam mattis, dolor non posuere commodo, sapien ligula hendrerit orci, non placerat erat felis vel dui. Cras vulputate ligula ut ex tincidunt tincidunt. Maecenas eget gravida lorem. Nunc nec facilisis risus. Mauris congue elit sit amet elit varius mattis. Praesent convallis placerat magna, a bibendum nibh lacinia non.</p>
                    <p>Fusce mollis sagittis elit ut maximus. Nullam blandit lacus sit amet luctus euismod. Duis luctus leo vel consectetur consequat. Phasellus ex ligula, pellentesque et neque vitae, elementum placerat eros. Proin eleifend odio nec velit lacinia suscipit. Morbi mollis ante nec dapibus gravida. In tincidunt augue eu elit porta, vel condimentum purus posuere. Maecenas tincidunt, erat sed elementum sagittis, tortor erat faucibus tellus, nec molestie mi purus sit amet tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris a tincidunt metus. Fusce congue metus aliquam ex auctor eleifend.</p>
                    <p>Ut imperdiet dignissim feugiat. Phasellus tristique odio eu justo dapibus, nec rutrum ipsum luctus. Ut posuere nec tortor eu ullamcorper. Etiam pellentesque tincidunt tortor, non sagittis nibh pretium sit amet. Sed neque dolor, blandit eu ornare vel, lacinia porttitor nisi. Vestibulum sit amet diam rhoncus, consectetur enim sit amet, interdum mauris. Praesent feugiat finibus quam, porttitor varius est egestas id.</p>

                    <div class="ui hidden divider"></div>

                </div>
                <div class="five wide column">
                    <!--右边栏-->
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$str = <<<JS
    //关闭提示信息
    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
    });
JS;
$this->registerJs($str);
?>