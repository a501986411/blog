/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : blogdemo2db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-03-16 18:34:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adminuser
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `password` varchar(128) CHARACTER SET latin1 NOT NULL,
  `email` varchar(128) CHARACTER SET latin1 NOT NULL,
  `profile` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES ('1', 'admin', '噢,我想多了', 'chenhailong', '501986411@qq.com', 'ssdsdsddssdds');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '这篇文章写得不错，加油！！', '1', '2017', '1', '501986411@qq.com', 'www.baidu.com', '1');

-- ----------------------------
-- Table structure for commentstatus
-- ----------------------------
DROP TABLE IF EXISTS `commentstatus`;
CREATE TABLE `commentstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of commentstatus
-- ----------------------------
INSERT INTO `commentstatus` VALUES ('1', '审核中', '0');
INSERT INTO `commentstatus` VALUES ('2', '已审核', '0');
INSERT INTO `commentstatus` VALUES ('3', '已删除', '0');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(80) NOT NULL,
  `apply_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '文章描述信息',
  `content` text NOT NULL,
  `tags` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `author_id` int(11) NOT NULL COMMENT '作者id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文章记录表';

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', '《华夏志．蜀志．六班群英传》 ', '初，光育谓春曰：“国虽太平，实则危机之时也！美利坚、日帝国、印度阿三窥视我中土神洲久矣！\r\n国之昌盛，在于人才。今有举人九十有七于此修习强国富民之道，特托汝以教之，汝可小心在意，万不可毁国未来之基石。”永春领命受之，\r\n上特赐番号为“高2011级06班”。\r\n三载时光群英荟萃。大浪淘沙留精华，三载磨练、三载艰难，临别分散之际，特作此文以记之，谓之《群英传》。', '初，光育谓春曰：“国虽太平，实则危机之时也！美利坚、日帝国、印度阿三窥视我中土神洲久矣！国之昌盛，在于人才。今有举人九十有七于此修习强国富民之道，特托汝以教之，汝可小心在意，万不可毁国未来之基石。”永春领命受之，上特赐番号为“高2011级06班”。三载时光群英荟萃。大浪淘沙留精华，三载磨练、三载艰难，临别分散之际，特作此文以记之，谓之《群英传》。\r\n有一人者名锦雄，祖姓唐，别字狗熊。天星火车站人也。狗熊少时好斗、为游侠儿，多于铁道间嬉戏，其父难管之，遂流放至宕渠二中，今其有狗熊之名、无狗熊之实，身体单薄、有污狗熊之名矣！\r\n有一人心慕李小龙，少时拜师习武，若端AK-47则有万夫不挡之势。生得虎背熊腰。生性平和，谓之周恩明是也！时人称之为“二狗”。\r\n杨立胖者、本名杨立胜，因某次笔误，遂作杨立胖，喜食“蛋”、吾上课多与之。\r\n有一人三载苦读、苦不自信，友人皆称有入学太庙之能，然则其不自与，是谓杨炳。\r\n伍龙飞者，视Boss为无物，多次与之抗衡，众人皆钦其魄，因左臂胎记而得名。谓之“乌疤子”。\r\n曾有一人三日转徙于球场网吧之间，然则粒米未进，亦或通宵达旦于网吧一月有余，遂成“大仙”之名。张林林之能，恐空前绝后矣！\r\n科桥者，善于吟诗作对、笔墨书画无不精也！夫子亦称其能。\r\n易亮为Boss左膀，善理团队锁事。\r\n董芳是Boss右臂，长于稳定军心。\r\n张能军者、督管一应环卫，莫不称帝意，多受上嘉奖。\r\n杨海燕者，总领部队文书，官兵皆称能、亦得众表彰。\r\n斯文小青年，非建军莫属。\r\n狂暴大嗓门，是海洋雅称。\r\n行军参谋是范恋，多提携众人搏政治职称，上拜为团部支书。\r\n有一女性者、海拔甚高，且研讨学术之心未有及者。李霖娟是也、时人多以“胖妹”呼之。\r\n陈嘉佳者，性单纯可爱，与胖妹交好，常共执辔出入。\r\n有一人者，雅号众多，女性呼之“全宇”、实为“拳雨”，一“猪”喊遍神州。吾呼其为“蚊子”。此子虽为女流，甚为狂暴，吾亦深受其害，书卷多被其毁之、肌肤多被其伤之。此子者、文全宇也！\r\n王雪威者、钻于学术过度，身体孱弱，上常不忍其瓠溯。\r\n罗端生于端午，因名之端。生性开朗，喜结志士，时常浅笑扬嘴边。\r\n乖巧可爱者莫如陈欢欢，声音甜美、时人多以“欢欢妹”谓之。\r\n熊海涛者，有人以三弟谓之，此缘由非核心人士莫能知也！\r\n有一喜慕诸多火器及作战器械者，长于算术，吾揣其有研发制造新式火器之志也！“周住”李雕，吾专等捷报已矣！\r\n寥峰者，其父为餐饮巨头、于宕渠经济有推波助澜之功，世皆谓峰将从其父业，峰则不然，峰以人皆有披荆斩棘创立之志否定之。\r\n孙爽者，体格健硕，喜击篮球，上多以此事论之。\r\n有一人者、行路占地极广，友人常以此恶之，常以挑逗“二狗”称快。雷丘山是也！时人唤之“丘包”。\r\n黄明敏与黄俊为同胞兄弟，黄俊曾修习书画、誓成绘画大师，今持“名画专院”入场券半张；明敏之志与其兄反，愿以文字、符号行遍天下。事在人为，此兄弟之心，日月可鉴也！\r\n黄天雷者、憨厚老实，众人皆愿深交之。\r\n赵亮者，三载修习于第三载发力，付其诚心、略有小成，愿其六月堪平其志也！\r\n张超者，因不知美利坚国土列于环球之四，被人加以“单蠢”之称。然操精于算术，假以时日，必成国之栋梁。\r\n刘寒为皇亲，然其未以之自傲也，曾痴迷于网游、然今于网游甚远之。\r\n彭川旧时亦曾校居，不拘言笑、偶尔冷幽默。\r\n张宁者，性乐观、旧与吾校居同室时，常搏众乐，为众开心果。今悔其旧时懒惰、加倍努力ing\r\n陈非凡者，传为男儿中体重最轻，吾未曾考证，然观其体格，或为实也！\r\n龙洪波者，能言善辩。苦陷网游天龙，吾叹其才浪费矣！\r\n刘杰航者、亦曾多次夜逃居室、奔袭网吧，上甚恶之，可知其今有无变动乎？\r\n于芳芳清心寡欲，王显清寡语少言。\r\n张座前擅于现代生物、疾恶扬善，李王爷委以重任；陈海龙长于古今算术、见贤思齐，刘长老授之难题；李芯杰工于东西物理、刻苦钻研，夫子何托以重担；\r\n蒋劲雷见长环球洋文、取长补短，帝室刘嘱之努力。此四子者，谓之团队“四个代表”。\r\n王振林喜览青年文摘，亦或读者；此类书籍堆积成山，然其亦为学术搏矣！\r\n艾旭东者，人称“东瓜”，加之姓氏为“矮东瓜”然其海拔甚高，亦开口常笑邪！\r\n糜云龙者，击篮之心甚于孙爽，上曾谓之“为篮不顾性命矣！”。\r\n杨未林性行淑均，晓畅NBA之事，若以此事讨问之，可娓娓道来。\r\n有一人称“歌王”者，彭辛荻是也，行路摇摆跳跃、岂非活力四射乎？\r\n伍桂林者，旧时身体薄如蝉翼，亦有海拔，遂成标准“竹竿”，喜今有脂裹身，望之不弱矣！\r\n唐志昆极有天资，常电子小说手握、然其学术，众之不及也！吾喜唤之“自抠”。\r\n据传唐强为唐伯虎之后，吾亦为曾考证。然强三载于学术矢志不渝之心，能及者少有！\r\n陈治霖者，亦为小说狂人，然今其亦于小说之余专功学术，可喜可贺。\r\n有一人者、万千男儿钦羡其体魄，浑身美肌动人心神、此子者，苏容飞也！\r\n史鹏程力大，虽无移山撼岳之能、亦有力能扛鼎之功。郑小川志坚，即无摸天填海之势、也有愚公移山之效。\r\n有一人者，居于渠城北门，然其三载寒暑步行进校、同窗皆异之，其谓众人曰：“此为强身健体之良方也！”。此子者，蒋杉也！\r\n寥芸攀狂暴甚于蚊子，吾之手臂被其毁作惨不忍睹之状，发怒时震惊三界，鬼神不敢近其身也！然其心静平息之时，略有淑女之状。本为吾邻座，吾因难忍盛夏酷署，离之。\r\n陈利华者，仗义疏财，乐于助人，数次援大仙于生命垂危之时。然其过于幼稚可爱，不谙世俗之事。吾于此诫之应放眼世俗，切忌被学堂纯洁美好之事蒙蔽双眼，于前程之事受阻。\r\n有一人者小鸟依人，曾颖也，通晓音律，上拜为皇家音律教习委员长。\r\n张春燕者，亦为“名画专院”记名学员。留之于人印象为：足下蹑丝履，头上玳瑁光，腰若流纨素，耳着明月铛。指如削葱根，口如含朱丹，纤纤作细步，精妙世无双。愿其能以书画之才平此生壮志！\r\n兰糜者，生性多动，常于课间追逐打闹搏乐，然于完结学业之既，亦将精力付于书卷矣。\r\n周慧者，与董芳交好。且二者有七分相似之处，若望之背影，有以假乱真之效。\r\n叶彩燕者，吾喜呼其为“野菜”，此女初进团队，默默无闻，时隔三年，于学术处于霸主之位。野菜于某端午佳节在家逍遥之时，不慎损一芳齿。吾虽知其因，不便言也，如有好奇者。可问其本人。吾将野菜等同亲妹视之，今后彼若有难，吾必诚心助之。\r\n有一心慕林俊杰者，于俊杰如痴如狂，然俊杰之能亦不负段炼赤心矣！\r\n岳春玲除研讨学术之外，别无所好。天亦不负其诚。\r\n贾芳芳开朗大方，与罗端交好异甚，谓此二人义结金兰，亦不为过。\r\n糜凤毅顽、杨娜志艰。此二人者皆有鸿鹄冲天之志，若付之不懈努力，假以时日，必为人中龙凤。\r\n罗丹者，展露出喜事不断之象，然其空间说说常是心烦意乱之言，彼有难言心事乎？吾难揣也。\r\n陈檑桦终日与手机作伴，机在人在，机毁人亡！\r\n熊森林之板寸名闻天下，森林者，因观之我天朝今体育之风盛行，遂并入体育特战军，今有望迁升至名校也！\r\n余东静者，虽为男儿身，然其性平和，有大家闺秀之状，不易动怒，于此修习三年，未生大事。\r\n吴海波自闽南迁入，此子素重江湖义气，然其嗜烟过甚，称“烟枪”亦不为过。\r\n谭丽，张丽为团队两丽，二人互为邻座，皆不喜多言。\r\n江婷，万姗常成双出入，因不喜亲临团队，上甚恶之，愿其而今多作改观、挫上锐气。\r\n有一人者不可不言，此子名为李解，然众喜呼之“改改”，其又谓众人云“吾乃野人”，曾有一头乌黑亮丽长发，然今刈之，可惜甚矣！吾观之习性，赠彼只言：“为人母则良，为人妻则贤”。\r\n李江波居于沙石码，此子善良老实，亦常有关爱友人之心，善矣！\r\n熊友腿长，喜长途跋涉，亦重煅炼筋骨，时人称之为“柴油机”。\r\n于涛虽于学术甚强，然上甚不喜之，缘何如此？涛视Boss为犬粪也，公然于之抗衡，时人皆称快。\r\n杨淋岚者，好“魔兽”，然而今唯一之志为升迁高校，吾祝其成功矣！\r\n吾之名姓，吴炯也！修习三载碌碌无为，于一雷雨交加之夜不慎留一伤疤，同窗皆以此戏之。谓之“砍疤”“刀疤”，悲夫，吾之清名毁矣！亦有豪杰以名音译为“蜈蚣”，以吾陋见，“吴公”更为悦耳。三载相聚分散在即，每思至此，多感伤矣！\r\n\r\n\r\n三载艰险，中道亦有离者，然亦本为吾团体一员，均为吾弟兄，必等同视之！胡文斌者，感学术无用，离去，转而习厨艺，现为国际通用掌勺大厨，就职于新疆。陈哲者，叹世事无常，离去，转而求学技艺，现求学于富渝，前景可观。候舜宴者，听家族忠告，离去，修习设立楼阁之术，现事于苏杭，小有资产。张鹏者，因慕古今将士，离去，现投身军伍，保国安民。卢文均者，因不满Boss无德，离去，现亦于苏杭谋事。候敏者，不满教习方式，离去，现求学于宕渠一中。\r\n\r\n英豪齐聚六班，因缘也！愿此情谊永生不望，亦愿今后各展其才，各获其成矣！\r\n\r\n\r\n\r\n『PS：面临毕业，难舍三年同学情谊，所以作此聊以纪念，排名不分先后、文字不论多少，用词不当处，望各位同学海涵！』\r\n\r\n              -------二零一一年五月十一日，吴炯记', '华夏志/六班群英传', '1', '123123123', '123123', '1');

-- ----------------------------
-- Table structure for poststatus
-- ----------------------------
DROP TABLE IF EXISTS `poststatus`;
CREATE TABLE `poststatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of poststatus
-- ----------------------------
INSERT INTO `poststatus` VALUES ('1', '草稿', null);
INSERT INTO `poststatus` VALUES ('2', '已发布', null);
INSERT INTO `poststatus` VALUES ('3', '已归档', null);

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '哦，我想多了', '', '', '', '', '0', '0', '0');
