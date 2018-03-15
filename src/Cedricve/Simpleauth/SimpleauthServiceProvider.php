<?php namespace Cedricve\Simpleauth;

use Illuminate\Support\ServiceProvider;

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
        if ($this->app->runningInConsole()) {
            if (!str_contains($this->app->version(), 'Lumen')) {
                $this->publishes([
                    __DIR__ . '/../config/simpleauth.php' => config_path('simpleauth.php'),
                ], 'config');
            }
        }
        \Auth::provider('simple', function($app, array $config)
        {
            return new SimpleauthUserProvider();
        });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(__DIR__ . '/../config/simpleauth.php', 'simpleauth');
	}

}
