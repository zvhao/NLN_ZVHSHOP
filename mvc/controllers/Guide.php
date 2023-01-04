<?php

class Guide extends Controller
{
	private $categories;
	function __construct()
	{
		 $this->categories = $this->model('CategoryModel');
	}
	function index()
	{
		$categories = $this->categories->getAllCl();

		return $this->view("client", [
			'page' => 'guide',
			'title' => 'Hướng dẫn',
			'css' => ['base', 'main'],
			'js' => ['main'],
			'categories' => $categories,


		]);
	}
}
