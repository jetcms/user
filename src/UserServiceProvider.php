<?php namespace JetCMS\User;

use JetCMS\Core\CoreServiceProvider;
use JetCMS\Core\Admin;

use JetCMS\Page\Admin\PageConfig;
use JetCMS\Sitemap\Admin\SitemapConfig;
use JetCMS\Core\AdminRoute;

class UserServiceProvider extends CoreServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [];

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->publishConfig(__DIR__,'user');
		
		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		$this->loadViewsFrom(__DIR__.'/../views', 'jetcms.user');
		include __DIR__.'/../routes.php';
	}

}