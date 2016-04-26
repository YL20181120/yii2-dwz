<?php
namespace jasmine2\dwz\helpers;
/**
 * Created by Jasmine2.
 * FileName: Html.php
 * Date: 2016-4-25
 * Time: 09:16
 */
class Html extends \yii\helpers\Html
{
	public static function divider(){
		return static::tag('div','',['class' => 'divider']);
	}

	public static function submitButton($content = '', $options = []){
		echo '</div><div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>';
	}
}