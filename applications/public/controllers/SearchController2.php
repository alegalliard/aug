
    <?php

	class SearchController2 extends Controller{
		
		private $get;
		private $views;
		
		public function init(){
			$this->get = Request::get();
			
			$this->views = new Views(new Template('public', 'novo/searching.phtml'));
			$this->views->data = new stdClass;
		}
		
		public function search(){
			$query = str_replace('?q=', '', $this->get->search_query);
			$this->views->data->query = $query;
			
			//----------- Gatos
			$m = Model::Factory('cats');
			$m->where("name LIKE '%{$query}%' OR full_description LIKE '% {$query} %'");
			$this->views->data->cats = $m->all();
			
			//----------- Páginas
			$m = Model::Factory('pages');
			$m->where("name LIKE '%{$query}%' OR content LIKE '% {$query} %'");
			$this->views->data->pages = $m->all();
			
			$this->views->display('novo/search_results.phtml');
		}
	

        public function cats_search(){
            function vals($str){}
                
                $qu = (explode("&", $this->get->search_query));
//            echo '<pre>';
                $q = preg_replace("/[^a-zA-Z0-9\=]+/", "", $qu);
                $query = '';
                foreach($q as $key=>$val){
                    $v = explode("=", $val);

                    if($v[1] > 0){
                        if($key < (count($q)) && $key > 0){
                            $query .=  ' AND ' ;
                        }
                        $query .= ' '. $v[0]." LIKE '%".$v[1]."%' ";                    
                    }

                    if($v[0] == 'gender' && $v[1] != ''){
                         $query .= ' AND '. $v[0]." LIKE '%".$v[1]."%' ";
                    }
                }
                
//            var_dump($query);
//            echo '</pre>';

                //----------- Gatos
                $m = Model::Factory('cats');
                $m->where($query. ' AND id > 6000');
                $this->views->data->cats = $m->all();
                
                $this->views->display('novo/search_cats_results.phtml');
            }
        }