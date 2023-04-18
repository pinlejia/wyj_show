<?php

namespace App\Modules\Controllers\Brands;


use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Modules\Repositories\Brands\BrandRepository;
use App\Modules\Validators\Brands\BrandValidator;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class BrandsController.
 *
 * @package namespace App\Modules\Controllers;
 */
class BrandsController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $repository;

    /**
     * @var BrandValidator
     */
    protected $validator;

    /**
     * BrandsController constructor.
     *
     * @param BrandRepository $repository
     * @param BrandValidator $validator
     */
    public function __construct(BrandRepository $repository, BrandValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws RepositoryException
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $brands = $this->repository->all();
        return response()->json([
            'data' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BrandCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $brand = $this->repository->create($request->all());

            $response = [
                'message' => 'Brand created.',
                'data'    => $brand->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $brand = $this->repository->find($id);

        return response()->json([
            'data' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BrandUpdateRequest $request
     * @param  string            $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $brand = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Brand updated.',
                'data'    => $brand->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'Brand deleted.',
            'deleted' => $deleted,
        ]);
    }
}
