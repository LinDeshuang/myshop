<?php
header("Content-type:text/html; charset=utf-8");
$con=new PDO("mysql:host=localhost;","root","root");
$result=$con->query("create database shop14131 charset utf8"); 
if($result)
{
  echo "创建数据库成功</br>";
}
else
{
  echo "创建数据库失败</br>";
}
$con->query("use shop14131");
$con->query('set names utf8');
$sql="create table merchandise
(
merID smallint unsigned auto_increment not null primary key,
name varchar(40) not null comment '球衣名称',
team varchar(20) not null comment '球衣所属队伍',
price decimal(7,2) unsigned not null,
discount decimal(3,2) unsigned not null,
cover  varchar(50)  comment '商品图片的URL',
year   varchar(20) not null comment '球衣被使用的年份',
type varchar(20) not null comment '球衣的款式',
introduction varchar(300) comment '球衣简介',
inventory smallint not null comment '库存'
)charset=utf8;";
$result=$con->query($sql);
if($result)
{
  echo "创建商品表成功</br>";
}
else
{
  echo "创建商品表失败</br>";
}
$sql="insert into merchandise values(null, '湖人队科比24号球衣', '湖人队', '299.00', '0.89', 'images/merchandise/2017061005062747.jpg', '2007', 'v型领背心', '湖人队巨星科比经典的24号球衣，材质为纯棉，颜色有紫色，白色，黄色。', 1000),
(null, '最新骑士队詹姆斯23号球衣', '骑士队', '349.00', '0.78', 'images/merchandise/2017061006060084.jpg', '2016', 'V领短袖型', '骑士队詹姆斯2016夺冠球衣，纯棉材质，最新短袖设计，轻薄吸汗，目前只有黑色款式。', 1000),
(null, '公牛队乔丹经典球衣', '公牛队', '439.00', '0.85', 'images/merchandise/2017061105064759.jpg', '1993', '圆领背心', '经典的乔丹红色公牛战袍，圆领背心，混合材质，轻薄吸汗，宽松舒适。', 1000),
(null, '火箭队麦迪1号球衣', '火箭队', '299.00', '0.88', 'images/merchandise/2017061105068338.jpg', '2007', 'V领背心', '火箭队麦迪1号球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，麦迪35秒13分神迹战袍。', 1000),
(null, '火箭队中国赛12号球衣', '火箭队', '399.00', '0.95', 'images/merchandise/2017061105063271.jpg', '2017', 'V领短袖型', '火箭队中国赛纪念版12号球衣,V领短袖型,混合材质，轻薄吸汗，宽松舒适。', 999),
(null, '火箭队哈登13号复古版球衣', '火箭队', '259.00', '0.89', 'images/merchandise/2017061105062355.jpg', '2017', 'V领背心', '火箭队哈登13号复古版球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，火箭队核心领袖哈登的复古战袍。', 999),
(null, '火箭队姚明11号球衣', '火箭队', '459.00', '0.87', 'images/merchandise/2017061105069109.jpg', '2008', '圆领背心', '火箭队姚明11号球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，小巨人姚明经典战袍。', 999),
(null, '马刺队邓肯21号最新球衣', '马刺队', '399.00', '0.88', 'images/merchandise/2017061105066322.jpg', '2017', 'V领背心', '马刺队邓肯21号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，石佛邓肯的灰色战袍。', 1000),
(null, '小牛队诺维茨基41号球衣', '小牛队', '389.00', '0.78', 'images/merchandise/2017061105069422.jpg', '2010', 'V领背心', '小牛队诺维茨基41号球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，德国战车的经典战袍。', 999),
(null, '凯尔特人加内特5号经典球衣', '凯尔特人', '299.00', '0.98', 'images/merchandise/2017061105062172.jpg', '2008', '圆领背心', '凯尔特人加内特5号经典球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，老狼王的凯尔特人冠军球衣。', 998),
(null, '76人队传奇巨星艾佛森3号球衣', '76人', '599.00', '0.87', 'images/merchandise/2017061105069948.jpg', '2001', 'V领背心', '76人队传奇巨星艾佛森3号球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，传奇巨星答案的3号战袍。', 1000),
(null, '雷霆队杜兰特最新款深蓝35号球衣', '雷霆队', '359.00', '0.77', 'images/merchandise/2017061105061196.jpg', '2015', '圆领背心', '雷霆队杜兰特最新款深蓝35号球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，雷霆当家巨星杜兰特的35号战袍。', 1000),
(null, '快船队保罗3号球衣', '快船队', '399.00', '0.89', 'images/merchandise/2017061105067781.jpg', '2015', 'V领背心', '快船队保罗3号球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，快船队核心人物保罗的3号战袍。', 1000),
(null, '勇士队库里30号最新球衣', '勇士队', '399.00', '0.78', 'images/merchandise/2017061111062400.jpg', '2017', 'V领背心', '勇士队库里30号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，库里主场白色战袍。', 999),
(null, '马刺队邓肯21号最新球衣', '马刺队', '344.00', '0.90', 'images/merchandise/2017061312064098.jpg', '2014', 'V领背心', '马刺队邓肯21号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，石佛邓肯的灰色战袍。', 991),
(null, '湖人队科比24号球衣', '湖人队', '455.00', '0.89', 'images/merchandise/2017061305066653.jpg', '2011', 'V领背心', '湖人队巨星科比经典的24号球衣，材质为纯棉，颜色有紫色，白色，黄色。', 997)";
$result=$con->exec($sql);
if($result)
{
  echo "商品表插入数据成功</br>";
}
else
{
  echo "商品表插入数据失败</br>";
}

$sql="create table category
   (
cateID smallint unsigned auto_increment not null primary key,
category varchar(30) not null,
parentID smallint unsigned not null
)charset=utf8;";
$result=$con->query($sql);
if($result)
{
  echo "创建分类表成功</br>";
}
else
{
  echo "创建分类表失败</br>";
}
//插入分类记录
$sql="insert into category values(1, '球队', 0),
(2, '湖人队', 1),
(3, '马刺队', 1),
(4, '年份', 0),
(5, '1995', 4),
(6, '1993', 4),
(8, '退役球衣', 0),
(9, '乔丹退役球衣', 8),
(10, '骑士队', 1),
(11, '勇士队', 1),
(12, '快船队', 1),
(13, '雷霆队', 1),
(14, '火箭队', 1),
(23, '爵士队', 1),
(25, '雄鹿队', 1),
(26, '太阳队', 1),
(27, '国王队', 1),
(28, '76人队', 1),
(29, '凯尔特人队', 1),
(30, '森林狼队', 1),
(31, '奇才队', 1),
(32, '小牛队', 1),
(33, '球星球衣', 0),
(34, '乔丹', 33),
(35, '科比', 33),
(36, '詹姆斯', 33),
(37, '艾佛森', 33),
(38, '麦迪', 33),
(39, '姚明', 33),
(40, '库里', 33),
(41, '邓肯', 33),
(42, '韦德', 33),
(43, '哈登', 33),
(44, '保罗.乔治', 33),
(45, '莱昂那德', 33),
(46, '全明星球衣', 0),
(47, '2001年西部全明星', 46),
(48, '2001年东部全明星', 46),
(49, '2017年西部全明星', 46),
(50, '2017年东部全明星', 46),
(51, '姚明退役球衣', 8),
(52, '奥尼尔退役球衣', 8),
(53, '1998', 4),
(54, '1999', 4),
(55, '2017', 4)";
$result=$con->exec($sql);
if($result)
{
  echo "分类表插入数据成功</br>";
}
else
{
  echo "分类表插入数据失败</br>";
}

$sql="create table admin
   (
adminID smallint unsigned auto_increment not null primary key,
admin varchar(20) not null,
pwd varchar(200) not null
   )charset=utf8;";
  $result = $con->query($sql);
  if($result)
{
  echo "创建管理员表成功</br>";
}
else
{
  echo "创建管理员表失败</br>";
}

   //添加默认管理员
   $admin='admin';
   $pwd='123456';
   $pwd=md5($pwd);
   $sql="insert into admin values(null,'{$admin}','{$pwd}')";
   $result=$con->exec($sql);
  if($result)
{
  echo "创建默认管理员成功</br>";
}
else
{
  echo "创建默认管理员失败</br>";
}

$sql="create table user
   (
userID smallint unsigned auto_increment not null primary key,
user varchar(20) not null,
pwd varchar(200) not null,
phone char(11) not null,
address   varchar(40) not null
   )charset=utf8;";
$result=$con->query($sql);
  if($result)
{
  echo "创建用户表成功</br>";
}
else
{
  echo "创建用户表失败</br>";
}
$sql="create table cart
(
  ID int unsigned auto_increment not null primary key,
  merID smallint unsigned,
  user varchar(20) not null,
  count  smallint not null,
  createTime datetime not null,
  foreign key(merID) references merchandise(merID) on delete cascade on update cascade
  )charset=utf8;";
$result= $con->query($sql);
  if($result)
{
  echo "创建购物车表成功</br>";
}
else
{
  echo "创建购物车表失败</br>";
}

$sql="create table orders
(
orderID int unsigned auto_increment not null primary key,
userID smallint unsigned not null,
address varchar(40) not null,
total decimal(8,2) not null,
deliverMode  varchar(25) not null,
paymentMode varchar(25) not null,  
createTime datetime not null,
orderState varchar(10) not null default '待审核',
foreign key(userID) references user(userID) on delete cascade on update cascade
)charset=utf8;";
$result=$con->query($sql);
  if($result)
{
  echo "创建订单表成功</br>";
}
else
{
  echo "创建订单表失败</br>";
}
$sql="create table suborders
(
suborderID int unsigned auto_increment not null primary key,
merID smallint not null,
count  smallint not null,
orderID int unsigned not null,
foreign key(orderID) references orders(orderID) on delete cascade on update cascade
)charset=utf8;";
$result=$con->query($sql);
  if($result)
{
  echo "创建子订单表成功</br>";
}
else
{
  echo "创建子订单表失败</br>";
}
?>
