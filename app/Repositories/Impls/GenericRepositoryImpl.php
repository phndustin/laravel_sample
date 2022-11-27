<?php

namespace App\Repositories\Impls;

use App\Repositories\GenericRepository;
use Arr;
use Str;

class GenericRepositoryImpl implements GenericRepository {
    protected $model;

    public function getModel() {
        return $this->model;
    }

    public function findById($id) {
        return $this->model->where('id', $id)->first();
    }

    private function dynamicCount($method, $parameters)
    {
        $finder = substr($method, 7);
        $segments = preg_split('/(And|Or)(?=[A-Z])/', $finder, -1);
        $conditionCount = count($segments);
        $conditionParams = array_splice($parameters, 0, $conditionCount);
        $model = $this->getModel();
        $whereMethod = 'where'.$finder;
        $query = call_user_func_array([$model, $whereMethod], $conditionParams);

        return $query->count();
    }

    private function dynamicFind($method, $parameters)
    {
        $finder = substr($method, 6);
        $segments = preg_split('/(And|Or)(?=[A-Z])/', $finder, -1);
        $conditionCount = count($segments);
        $conditionParams = array_splice($parameters, 0, $conditionCount);
        $model = $this->getModel();
        $whereMethod = 'where'.$finder;
        $query = call_user_func_array([$model, $whereMethod], $conditionParams);

        $order = Arr::get($parameters, 0);
        $direction = Arr::get($parameters, 1);
        if (isset($order) && isset($direction)) {
            return $query->orderBy($order, $direction)->get();
        }

        return $query->get();
    }

    private function dynamicFindOne($method, $parameters)
    {
        $finder = substr($method, 9);
        $segments = preg_split('/(And|Or)(?=[A-Z])/', $finder, -1);
        $conditionCount = count($segments);
        $conditionParams = array_splice($parameters, 0, $conditionCount);
        $model = $this->getModel();
        $whereMethod = 'where'.$finder;
        $query = call_user_func_array([$model, $whereMethod], $conditionParams);

        return $query->first();
    }

    private function dynamicDelete($method, $parameters)
    {
        $finder = substr($method, 8);
        $segments = preg_split('/(And|Or)(?=[A-Z])/', $finder, -1);
        $conditionCount = count($segments);
        $conditionParams = array_splice($parameters, 0, $conditionCount);
        $model = $this->getModel();
        $whereMethod = 'where'.$finder;
        $query = call_user_func_array([$model, $whereMethod], $conditionParams);

        return $query->delete();
    }

    public function __call($method, $parameters) {
        if (Str::startsWith($method, 'countBy')) {
            return $this->dynamicCount($method, $parameters);
        }

        if (Str::startsWith($method, 'findBy')) {
            return $this->dynamicFind($method, $parameters);
        }

        if (Str::startsWith($method, 'findOneBy')) {
            return $this->dynamicFindOne($method, $parameters);
        }

        if (Str::startsWith($method, 'deleteBy')) {
            return $this->dynamicDelete($method, $parameters);
        }
        return call_user_func_array([$this->getModel(), $method], $parameters);
    }
}
