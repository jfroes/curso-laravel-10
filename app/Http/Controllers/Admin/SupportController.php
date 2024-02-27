<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    ){}
    public function index(Request $request){

        $supports = $this ->service ->getAll($request ->filter);

        return view('admin/supports/index', compact('supports'));
    }

    public function show(string|int $id){
        //Como recuperar um dado, varias possibilidades
        //Support::find($id)
        //Support::where('id' coluna, '=' criterio de comparaçao, $id valor)->firts() -> passa a coluna e o valor
        if(!$support = $this ->service ->findOne($id)){
            return redirect() -> back();
        }
        return view('admin/supports/show', compact('support'));
        }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupportRequest $request, Support $support){
        $this -> service ->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect() ->route('supports.index');
    }

    public function edit(string $id){
        if(!$support = $this ->service ->findOne($id)){
            return redirect() -> back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(string|int $id, StoreUpdateSupportRequest $request, Support $support){

        $supoport = $this -> service ->new(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if(!$support){
            return redirect() -> back();
        }
        return redirect() ->route('supports.index');
    }

    public function destroy(string|int $id){
        $this ->service->delete($id);

        return redirect() -> route('supports.index');
    }
}
