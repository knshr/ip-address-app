<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Repositories\Contracts\AuditLogRepository;
use App\Traits\FractalTransformer;
use App\Traits\ResponsesJson;
use App\Transformers\AuditLog\FullInfoTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AuditLogController extends Controller
{
    private $repository;
    private $entity;
    
    use FractalTransformer, ResponsesJson;

    public function __construct(AuditLogRepository $repository)
    {
        $this->repository = $repository;
        $this->entity = AuditLog::class;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->repository->orderBy('created_at','desc')->get();

        $message = $data->count() === 0
            ? Lang::get('info.no.results.found')
            : '';

        return $this->successfulResponse(
            $this->collection($data, FullInfoTransformer::class),
            $message
        );
    }

    public function ipAddresses($id) {
        $data = $this->repository->findManyIpAddress($id);

        $message = $data->count() === 0
            ? Lang::get('info.no.results.found')
            : '';

        return $this->successfulResponse(
            $this->collection($data, FullInfoTransformer::class),
            $message
        );
    }
}
