$(document).ready(function() {
	$('#score-form').submit(function() {
		var flag = true;
		var _form = $(this);

		var _radio = _form.find("input[type=radio]");

		var _name = [];

		_radio.map(function(k, v) {
			var name = $(v).attr('name');
			for (i = 0; i < _name.length; i++) {
				if (name == _name[i])
					return;
			}
			_name.push($(v).attr('name'));
		})
		_name.map(function(k, v) {

			if (flag) {
				var _radio = $("input[name='" + k + "']:checked");
				if (!_radio.val())
					flag = false;
				if (!flag)
					hm.alert({
						noTitle : true, // 是否显示标题
						text : '请选择对应的评分,谢谢', // 内容文
						height : 'auto', // 高度字
						width : 220,// 宽度
						confirm : '确定'
					})
			}
		})
		return flag;
	})
})