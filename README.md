# PHP-Light
the basic php mvc  frame
Route Reg：{{rootUrl}}/r=Home【模块名】/Index【控制器名】/index【方法名】

框架目录结构

目录结构（根目录）
├─index.php 入口文件
├─composer.json composer.json
├─README.md README文件
├─Application 应用目录
├─Cache 缓存文件目录
├─vendor composer安装插件
├─Resource 资源文件目录
└─Light 框架目录

其中框架目录Light的结构如下

├─Light 框架系统目录
│ ├─Common 核心公共文件目录
│ │ ├─Define.php 核心常量配置文件
│ │ ├─Functions.php 核心公共函数文件
│ ├─Conf 核心配置目录
│ │ ├─Config.php 核心配置文件
│ ├─Lib 第三方扩展类目录
│ ├─Core 框架类库目录
│ │ ├─Config.php 配置类
│ │ ├─Controller.php 控制器类
│ │ ├─Model.php 模型类
│ │ ├─MyException.php 异常类
│ │ ├─Route.php 路由类
│ └─Base.php 框架入口文件
