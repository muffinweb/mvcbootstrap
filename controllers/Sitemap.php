<?php 

/** Sitemap footerprint for SEO */


class Sitemap extends Controller
{
	public function index()
	{
		
		//EXAMPLE
		header('Content-type: application/xml; charset=utf-8');

		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
		<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

		$posts =  $this->medoo->select("posts", [
			'id',
			'slug',
			'created_at'
		], [
			"ORDER" => [
				"id" => "DESC"
			]
		]);

		$address = 'http://www.muffinweb.tk/post/';

		foreach ($posts as $key => $url) {
			$sitemap .= '<url><loc>' . $address. $url['slug'] . '</loc><lastmod>' . substr($url['created_at'], 0, 10) . '</lastmod><changefreq>daily</changefreq></url>';
		}

		$sitemap .= '</urlset>';

		echo $sitemap;

	}
}

?>