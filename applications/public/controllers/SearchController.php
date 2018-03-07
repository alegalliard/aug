
    <?php

	class SearchController extends Controller{
		
		private $get;
		private $views;
		
		public function init(){
			$this->get = Request::get();
			
			$this->views = new Views(new Template('public', 'searching.phtml'));
			$this->views->data = new stdClass;
		}
		
		public function search(){
			$query = str_replace('?q=', '', $this->get->search_query);
			$this->views->data->query = $query;
			
			//----------- Gatos
			$m = Model::Factory('cats');
			$m->where("status LIKE '0' AND section LIKE '1' AND inactive LIKE '0' AND (name LIKE '%{$query}%' OR full_description LIKE '% {$query} %')");
			$this->views->data->cats = $m->all();
			
			//----------- Páginas
			$m = Model::Factory('pages');
			$m->where("name LIKE '%{$query}%' OR content LIKE '% {$query} %'");
			$this->views->data->pages = $m->all();
			
			$this->views->display('search_results.phtml');
		}
	

        public function cats_search(){
                
                $qu = (explode("&", $this->get->search_query));
            

//            echo '<pre>';
                $q = preg_replace("/[^a-zA-Z0-9\=]+/", "", $qu);
                $query = '';
                $query2 = '';
            
                
                foreach($q as $key=>$val){
                    $v = explode("=", $val);
                    
                    switch($v[0]){
                        case 'gender':
                            if(strlen($v[1]) == 1){
                                $query2 .= $v[0]." LIKE '%".$v[1]."%' AND "; 
                            } else if (strlen($v[1]) == 2){
                                $p1 = (substr($v[1], 0, 1));
                                $p2 = (substr($v[1], 1, 2));
                                $query2 .= " (".$v[0]." LIKE '%".$p1."%' OR ".$v[0]." LIKE '%".$p2."%') AND "; 
                            }
                        break;
                        default: 
                            if($v[1] != "0"){
                               $query2 .=  $v[0]." LIKE '%".$v[1]."%' AND "; 
                            }
                    }
                }
            $query = $query2 . " (status LIKE '0' AND section LIKE '1' AND inactive LIKE '0')";


                //----------- Gatos
                $m = Model::Factory('cats');
                $m->where($query. ' AND id > 3000');
                $this->views->data->cats = $m->all();
                
                $this->views->display('search_cats_results.phtml');
            }
        }