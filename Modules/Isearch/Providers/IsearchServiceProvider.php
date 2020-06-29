<?php

namespace Modules\Isearch\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Iblog\Entities\Post;
use Modules\Isearch\Repositories\Cache\CacheSearchDecorator;
use Modules\Isearch\Repositories\Eloquent\EloquentSearchRepository;
use Modules\Isearch\Repositories\SearchRepository;


class IsearchServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    public function boot()
    {
        $this->publishConfig('isearch', 'permissions');
        $this->publishConfig('isearch', 'config');
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

    private function registerBindings()
    {

       /* $this->app->bind(SearchRepository::class, function () {
            $repository = new EloquentSearchRepository(new Post());

            if (config('app.cache') === false) {
                return $repository;
            }

            return new CacheSearchDecorator($repository);
        });
*/
    }
}
