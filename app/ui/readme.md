网页文件夹说明:

此文件夹的路径可用{{@UI}}设定, 参见setup.cfg

css/	存放自制css的文件夹

js/		存放自制js的文件夹

images/	存放自制的图片

lib/	存放bootstrap3 框架

网页说明:
index.html 	主页, 显示名称为{{@title}}, 显示是否登录, 若未登录, 显示登录连接; 若已登录, 显示姓名
判定是否登录的变量是{{@login}}(true表示已登录), 若登录, 姓名的变量为{{@name}}

login.html 登录页面, 显示名称{{@title}}, 错误为{{@error_login}}, 如果登录失败, 则error_login=true.
获取的用户名为uname, 密码为upasswd, (默认的)采用post方式.