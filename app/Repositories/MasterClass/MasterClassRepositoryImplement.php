<?php

namespace App\Repositories\MasterClass;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MasterClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MasterClassRepositoryImplement extends Eloquent implements MasterClassRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(MasterClass $model)
    {
        $this->model = $model;
    }

    public function getAll($request = null)
    {

        if(empty($request['paginate'])){
            return $this->model->getEvent($request['event_id'] ?? null)->with('event', 'class')->orderBy('created_at', 'desc')->get();
        }

        $get = $this->model->getEvent($request['event_id'] ?? null)
        ->getDashboard($request['active_dashboard'] ?? null)->getName($request['name'] ?? null)->getSortBy($request['sortBy'] ?? null, $request['sortType'] ?? null)
        ->withCount('class')->with('event', 'class')->paginate($request['paginate'] ?? 9);

        $param = [
            'active_dashboard' => $request['active_dashboard'] ?? false,
            'paginate' => $request['paginate'],
            'name' => $request['name'] ?? null,
            'event_id' => $request['event_id'] ?? null,
            'sortBy' => $request['sortBy'] ?? null,
            'sortType' => $request['sortType'] ?? null
        ];

        return $get->appends($param);
    }

    public function store($request)
    {
        $insert = $this->model->create($request);

        return $insert;
    }

    public function find($id)
    {
        return $this->model->withCount(['mentee', 'class', 'cart' => function($cart){
            $cart->where('id', Auth::user()->id);
        }, 'wishlist' => function($wishlist){
            $wishlist->where('id', Auth::user()->id);
        }])->with(['class' => function($q){
            $q->whereHas('mentee', function($mentee){
                $mentee->where('id', Auth::user()->id);
            });
        }, 'event'])->find($id);
    }

    public function update($id, $data)
    {
        $update = $this->model->find($id);

        $update->update($data);

        return $update;
    }

    public function delete($id)
    {
        $data = $this->model->find($id);

        return $data->delete() ? ['status' => 'success', 'msg' => $data->name . ' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name . ' Gagal Dihapus'];
    }

    public function getUpcoming($request)
    {
        $data = $this->model->whereHas('class', function ($query) {
            $query->where('start_time', '>=', Carbon::now());
        })->whereHas('event');

        if($request['paginate']){
            $data = $data->paginate($request['paginate']);

            return $data;
        }

        $data = $data->get();

        return $data;
    }
}
