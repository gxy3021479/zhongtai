<meta charset="UTF-8">
<?php
    class database
    {
        public $pdo;
        public function __construct()
        {
            $db = array(
                'dsn' => 'mysql:host=localhost;dbname=toutiao;port=3306;charset=utf8',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            );
            $options = array(
                //默认是PDO::ERRMODE_SILENT, 0, (忽略错误模式)
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // 默认是PDO::FETCH_BOTH, 4
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );
            try {
                $this->pdo = new PDO($db['dsn'], $db['username'], $db['password'], $options);
            } catch (PDOException $e) {
                die('数据库连接失败:' . $e->getMessage());
            }
        }
    }
    class  index extends database{
            public function indexs(){
                include './admin.html';
        }
    }

    class news extends database{
        public function delete(){
            $cont = $this->pdo->query('delete from news where id='.$_GET['id']);

        }
        public function insert(){
            $a=$this->pdo->query("insert into news (title,dsc,content) values ('{$_GET["title"]}','{$_GET["dsc"]}','{$_GET["content"]}')");

        }
        public function update(){
            $this->pdo->query("update news set {$_GET['k']}='{$_GET['v']}' where id=".$_GET['id']);
        }
        public function index(){
            $a = $this->pdo->query('select * from news');
            $rows = $a->fetchAll();
            include './admin_news.html';
        }
    }

    class category extends database
    {
        public function index(){
            include './admin_category.html';
        }
    }

//c=类   m=方法

    if(isset($_GET['c'])){
        $class_name = $_GET['c'];
    }else{
        $class_name = 'index';
    }

    if(isset($_GET['m'])){
        $mehtod = $_GET['m'];
    }else{
        $mehtod = 'indexs';
    }
$o = new $class_name;
$o -> $mehtod();

