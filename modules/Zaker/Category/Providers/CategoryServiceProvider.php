<?php

namespace Zaker\Category\Providers;

use Illuminate\Support\ServiceProvider;
use Zaker\Category\Models\Category;
use Zaker\Category\Repositories\CategoryInterface;
use Zaker\Category\Repositories\Elequent\ElequentCategoryRepo;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerBindings();
        $this->loadRoutesFrom(__DIR__.'/../Routes/category_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/','Categories');
        $this->loadMigrationsFrom(__DIR__.'/../Databases/Migrations');
    }

    private function registerBindings()
    {
        $this->app->bind(CategoryInterface::class,function (){
            return new ElequentCategoryRepo(new Category);
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.categories', [
            "icon" => "i-categories",
            "title" => "دسته بندی ها",
            "url" => route('categories.index')
        ]);
    }
}
