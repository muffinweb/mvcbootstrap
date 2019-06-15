<?php 

class News extends Controller implements IAuth
{

	public function index()
	{
		$newsItems = ['name' => 'Ugur', 'surname' => 'Cengiz', 'age' => 25, 'job' => 'IT'];
		$this->view('news', $newsItems, true);
	}

	public function username($u){
		return $u;
	}

	public function password($p){
		return $p;
	}
}

?>