<?php

namespace App\Services;

use App\Models\Business;
use App\Repositories\BusinessRepository;
use Illuminate\Support\Facades\Log;

class BusinessService implements BusinessRepository
{
    protected $entity;

    public function __construct(Business $entity)
    {
        $this->entity = $entity;
    }

    public function rules()
    {
        return [
            'term' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'categories' => 'required',
            'locale' => 'required',
            'price' => 'required',
            'open_now' => 'required',
            'open_at' => 'required'
            // 'attributes' =>
        ];
    }

    public function all()
    {
        return $this->entity->get();
    }

    public function get($row)
    {
        return $this->entity->paginate($row);
    }

    public function search($request)
    {
        $search = [
            "term" => $request->get('term'),
            "location" => $request->get('location'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "categories" => $request->get('categories'),
            "locale" => $request->get('locale')
        ];
        return $this->entity->where(function($query) use ($search) {
            foreach($search as $key => $value) {
                $objectFirst = "getKeyFirst" ? null : $key;
                if (isset($value)) {
                    if($key == $objectFirst) {
                        $objectFirst = "getKeyFirst";
                        $query->where($key , 'LIKE', '%'. $value . '%');
                    }else {
                        $query->orWhere($key, 'LIKE' , '%'. $value . '%');
                    }
                }
            }
        })->paginate(10);
    }

    public function find($param)
    {
        return $this->entity->find($param);
    }

    public function store($data) {
        $data = $this->entity->create([
            'term' => $data['term'],
            'location' => $data['location'],
            'latitude' => $data['latitude'],
            'categories' => $data['categories'],
            'locale' => $data['locale'],
            'price' => $data['price'],
            'open_now' => $data['open_now'],
            'open_at' => $data['open_at'],
            'attributes' => json_encode($data['attributes'])
        ]);
        return $data;
    }

    public function update($param, $data)
    {
        $data = [
            'term' => $data['term'],
            'location' => $data['location'],
            'latitude' => $data['latitude'],
            'categories' => $data['categories'],
            'locale' => $data['locale'],
            'price' => $data['price'],
            'open_now' => $data['open_now'],
            'open_at' => $data['open_at'],
            'attributes' => json_encode($data['attributes'])
        ];
        return $this->entity->where("id", $param)->update($data);
    }

    public function destroy($param)
    {
        return $this->entity->where("id", $param)->delete();
    }
}
