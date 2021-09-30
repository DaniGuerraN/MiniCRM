<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Mail\CompanyCreated;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->successResponse(Company::Paginate(10));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Company\CompanyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        try {



            $imageName = time() . '-' . $request->name .'.' . $request->image->extension();
            
            $request->image->move(public_path('storage/images'),$imageName);

            $requestData = $request->validated();

            $requestData['image'] = asset('storage/images/'. $imageName);

            $company = Company::create($requestData);
            
            if($request->notification_email != null){
                Mail::to($request->notification_email)
                ->send(new CompanyCreated($company,__('subjectMessage')));
            }
            
            return $this->successResponse($company);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        try {

            return $this->successResponse($company);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Company\CompanyUpdateRequest  $request
     * @param  App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        try {
            if($request->hasFile('image')){
                Storage::delete(public_path('storage/images/'),$company->image);

                $imageName = time() . '-' . $request->name .'.' . $request->image->extension();
            
                $request->image->move(public_path('storage/images'),$imageName);
    
                $requestData = $request->validated();
    
                $requestData['image'] = asset('storage/images/'. $imageName);
    
                $company->fill($requestData)->save();
            }else{
                $company->fill($request->validated())->save();
            }
            
            
            return $this->successResponse($company);
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            return $this->successResponse($company->delete());
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
