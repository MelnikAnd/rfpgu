<?php

namespace Modules\Page\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Page\Entities\Page;
use Modules\Page\Events\PageIsCreating;
use Modules\Page\Events\PageIsUpdating;
use Modules\Page\Events\PageWasCreated;
use Modules\Page\Events\PageWasDeleted;
use Modules\Page\Events\PageWasUpdated;
use Modules\Page\Repositories\PageRepository;

class EloquentPageRepository extends EloquentBaseRepository implements PageRepository
{
    /**
     * @inheritdoc
     */
    public function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->paginate($perPage);
        }

        return $this->model->paginate($perPage);
    }

    /**
     * Find the page set as homepage
     * @return object
     */
    public function findHomepage()
    {
        return $this->model->where('is_home', 1)->first();
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * @param  mixed  $data
     * @return object
     */
    public function create($data)
    {
        if (array_get($data, 'is_home') === '1') {
            $this->removeOtherHomepage();
        }

        event($event = new PageIsCreating($data));
        $page = $this->model->create($event->getAttributes());

        event(new PageWasCreated($page, $data));

        $page->setTags(array_get($data, 'tags', []));

        return $page;
    }

    /**
     * @param $model
     * @param  array  $data
     * @return object
     */
    public function update($model, $data)
    {
        if (array_get($data, 'is_home') === '1') {
            $this->removeOtherHomepage($model->id);
        }

        event($event = new PageIsUpdating($model, $data));
        $model->update($event->getAttributes());

        event(new PageWasUpdated($model, $data));

        $model->setTags(array_get($data, 'tags', []));

        return $model;
    }

    public function destroy($page)
    {
        $page->untag();

        event(new PageWasDeleted($page));

        return $page->delete();
    }

    /**
     * @param $slug
     * @param $locale
     * @return object
     */
    public function findBySlugInLocale($slug, $locale)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug, $locale) {
                $q->where('slug', $slug);
                $q->where('locale', $locale);
            })->with('translations')->first();
        }

        return $this->model->where('slug', $slug)->where('locale', $locale)->first();
    }

    /**
     * Set the current page set as homepage to 0
     * @param null $pageId
     */
    private function removeOtherHomepage($pageId = null)
    {
        $homepage = $this->findHomepage();
        if ($homepage === null) {
            return;
        }
        if ($pageId === $homepage->id) {
            return;
        }

        $homepage->is_home = 0;
        $homepage->save();
    }

    /**
     * Paginating, ordering and searching through pages for server side index table
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $pages = $this->allWithBuilder();

        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $pages->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->orWhere('slug', 'LIKE', "%{$term}%");
            })
                ->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';

            if (str_contains($request->get('order_by'), '.')) {
                $fields = explode('.', $request->get('order_by'));

                $pages->with('translations')->join('page__page_translations as t', function ($join) {
                    $join->on('page__pages.id', '=', 't.page_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('page__pages.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($request->get('order_by'), $order);
            }
        }
        //dd($pages->toSql());

//        $pages->with('translations')->join('page__page_translations as t', function ($join) {
//            $join->on('page__pages.id', '=', 't.page_id');
//        })->where('t.locale', locale())
//            ->groupBy('page__pages.id')->orderBy("t.title", 'desc');
        return $pages->paginate($request->get('per_page', 10));
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOnlineInAllLocales(Page $page)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 1];
        }

        return $this->update($page, $data);
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function markAsOfflineInAllLocales(Page $page)
    {
        $data = [];
        foreach (app(LaravelLocalization::class)->getSupportedLocales() as $locale => $supportedLocale) {
            $data[$locale] = ['status' => 0];
        }

        return $this->update($page, $data);
    }

    /**
     * @param array $pageIds [int]
     * @return mixed
     */
    public function markMultipleAsOnlineInAllLocales(array $pageIds)
    {
        foreach ($pageIds as $pageId) {
            $this->markAsOnlineInAllLocales($this->find($pageId));
        }
    }

    /**
     * @param array $pageIds [int]
     * @return mixed
     */
    public function markMultipleAsOfflineInAllLocales(array $pageIds)
    {
        foreach ($pageIds as $pageId) {
            $this->markAsOfflineInAllLocales($this->find($pageId));
        }
    }


    /**
     * Standard Api Method
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {
        /*== initialize query ==*/
        $query = $this->model->query();



        /*== FILTERS ==*/
        if (isset($params->filter)) {
            $filter = $params->filter;//Short filter
            if (isset($filter->categories) && !empty($filter->categories)) {

                $categories = is_array($filter->categories) ? $filter->categories : [$filter->categories];
                $query->whereHas('categories', function ($q) use ($categories) {
                    $q->whereIn('category_id', $categories);
                });
            }

            if (isset($filter->users) && !empty($filter->users)) {
                $users = is_array($filter->users) ? $filter->users : [$filter->users];
                $query->whereIn('user_id', $users);
            }

            if (isset($filter->include) && !empty($filter->include)) {
                $include = is_array($filter->include) ? $filter->include : [$filter->include];
                $query->whereIn('id', $include);
            }
            if (isset($filter->exclude) && !empty($filter->exclude)) {
                $exclude = is_array($filter->exclude) ? $filter->exclude : [$filter->exclude];
                $query->whereNotIn('id', $exclude);
            }

            if (isset($filter->exclude_categories) && !empty($filter->exclude_categories)) {

                $exclude_categories = is_array($filter->exclude_categories) ? $filter->exclude_categories : [$filter->exclude_categories];
                $query->whereHas('categories', function ($q) use ($exclude_categories) {
                    $q->whereNotIn('category_id', $exclude_categories);
                });
            }

            if (isset($filter->exclude_users) && !empty($filter->exclude_users)) {
                $exclude_users = is_array($filter->exclude_users) ? $filter->exclude_users : [$filter->exclude_users];
                $query->whereNotIn('user_id', $exclude_users);
            }

            if (isset($filter->tag) && !empty($filter->tag)) {

                $query->whereTag($filter->tag);
            }


            if (isset($filter->search) && !empty($filter->search)) { //si hay que filtrar por rango de precio
                $criterion = $filter->search;

                $query->whereHas('translations', function (Builder $q) use ($criterion) {
                    $q->where('title', 'like', "%{$criterion}%");
                });
            }

            //Filter by date
            if (isset($filter->date) && !empty($filter->date)) {
                $date = $filter->date;//Short filter date
                $date->field = $date->field ?? 'created_at';
                if (isset($date->from))//From a date
                    $query->whereDate($date->field, '>=', $date->from);
                if (isset($date->to))//to a date
                    $query->whereDate($date->field, '<=', $date->to);
            }
            if (is_module_enabled('Marketplace')) {
                if (isset($filter->store) && !empty($filter->store)) {
                    $query->where('store_id', $filter->store);
                }
            }

            //Order by
            if (isset($filter->order) && !empty($filter->order)) {
                $orderByField = $filter->order->field ?? 'created_at';//Default field
                $orderWay = $filter->order->way ?? 'desc';//Default way
                $query->orderBy($orderByField, $orderWay);//Add order to query
            }

            if (isset($filter->status) && !empty($filter->status)) {
                $query->whereStatus($filter->status);
            }

        }

        /*== FIELDS ==*/
        if (isset($params->fields) && count($params->fields))
            $query->select($params->fields);
        /*== REQUEST ==*/
        if (isset($params->page) && $params->page) {
            return $query->paginate($params->take);
        } else {
            if (isset($params->skip) && !empty($params->skip)) {
                $query->skip($params->skip);
            };

            $params->take ? $query->take($params->take) : false;//Take

            return $query->get();
        }
    }


}
