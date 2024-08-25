<?php

namespace App\Http\Controllers;

use App\Models\IPAddress;
use App\Repositories\Contracts\IPAddressRepository;
use App\Services\Contracts\IPAddressServiceInterface;
use App\Traits\FractalTransformer;
use App\Traits\ResponsesJson as TraitsResponsesJson;
use App\Transformers\IPAddress\FullInfoTransformer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class IPAddressController extends Controller
{
    private $service;
    private $repository;
    private $entity;

    use FractalTransformer, TraitsResponsesJson;

    public function __construct(IPAddressRepository $repository, IPAddressServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->entity = IPAddress::class;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->repository->get();

        $message = $data->count() === 0
            ? Lang::get('info.no.results.found')
            : '';

        return $this->successfulResponse(
            $this->collection($data, FullInfoTransformer::class),
            $message
        );
    }

    public function store(Request $request)
    {
        $data = $this->data($request);

        try {
            $result = $this->service->store($data);
        } catch (Exception $e) {
            return $this->errorResponse(array(
                'store.failed' => Lang::get('error.save.failed')
            ));
        }

        return $this->successfulResponse([
            'data' => $this->item($result, FullInfoTransformer::class)
        ], Lang::get('success.created'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->data($request);

        try {
            $result = $this->service->update($data, $id);
        } catch (Exception $e) {
            return $this->errorResponse(array(
                'update.failed' => Lang::get('error.update.failed')
            ));
        }

        return $this->successfulResponse([
            'data' => $this->item($result, FullInfoTransformer::class)
        ], Lang::get('success.updated'));
    }

    public function show($id)
    {
        $data = $this->repository->find($id);

        if (!$data) {
            return $this->errorResponse(array(
                'show.failed' => Lang::get('error.show.failed')
            ));
        }

        return $this->successfulResponse([
            'data' => $this->item($data, FullInfoTransformer::class)
        ]);
    }

    private function data(Request $request)
    {
        return $request->only(
            'ip_address',
            'label'
        );
    }
}
