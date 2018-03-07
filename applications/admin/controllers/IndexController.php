<?php

class IndexController extends Controller {

    private $views;
    private $session;
    private $post;
    

    public function init()
    {
        $this->post = Request::post();
        $this->session = new Session;
        
        define("PERMISSIONS", $this->session->user->level);

    }

    public function index()
    {
        
        if($this->session->logged_in !== true)
                Request::redirect(HOST.'adm/login');
        

        $this->views = new Views(new Template("admin"));
        
        $this->views->display("home.phtml");
    }

    public function login()
    {
        $this->views = new Views(new Template("admin", "login.phtml"));
        $this->views->display();
    }

    public function logout()
    {
        $this->session->logged_in = false;
        Request::redirect(HOST . 'adm/login');
    }

    public function process_login()
    {
        $m = Model::Factory('users');
        $m->where("login='{$this->post->username}' AND password = MD5('{$this->post->password}')");
        $data = $m->get();

        if($data)
        {
            //$this->backup_tables('mysql02.adoteumgatinho.com.br','adoteumgatinho1','palito1976','adoteumgatinho1');

            $this->session->logged_in = true;
            $this->session->user = $data;
            Request::redirect(HOST . 'adm');
        }
        else
        {
            Request::redirect(HOST . 'adm/login');
        }
    }

    /* backup the db OR just a table */
    public function backup_tables($host,$user,$pass,$name,$tables = '*')
    {

            $link = mysql_connect($host,$user,$pass);
            mysql_select_db($name,$link);

            //get all of the tables
            if($tables == '*')
            {
                    $tables = array();
                    $result = mysql_query('SHOW TABLES');
                    while($row = mysql_fetch_row($result))
                    {
                            $tables[] = $row[0];
                    }
            }
            else
            {
                    $tables = is_array($tables) ? $tables : explode(',',$tables);
            }

            //cycle through
            foreach($tables as $table)
            {
                    $result = mysql_query('SELECT * FROM '.$table);
                    $num_fields = mysql_num_fields($result);

                    $return.= 'DROP TABLE '.$table.';';
                    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
                    $return.= "\n\n".$row2[1].";\n\n";

                    for ($i = 0; $i < $num_fields; $i++) 
                    {
                            while($row = mysql_fetch_row($result))
                            {
                                    $return.= 'INSERT INTO '.$table.' VALUES(';
                                    for($j=0; $j<$num_fields; $j++) 
                                    {
                                            $row[$j] = addslashes($row[$j]);
                                            $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                                            if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                                            if ($j<($num_fields-1)) { $return.= ','; }
                                    }
                                    $return.= ");\n";
                            }
                    }
                    $return.="\n\n\n";
            }

            //save file
            $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
            fwrite($handle,$return);
            fclose($handle);
    }

}
