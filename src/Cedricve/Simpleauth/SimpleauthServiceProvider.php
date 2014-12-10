<?php namespace Cedricve\Simpleauth;

use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;

class SimpleauthServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('cedricverst/simpleauth');

		Auth::extend('simple', function()
		{
		    return new Guard(new SimpleauthUserProvider, $this->app['session.store']);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
}
