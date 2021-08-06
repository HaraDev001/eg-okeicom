<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Manage\StoreRequest;
use App\Http\Requests\Api\Manage\UpdateRequest;
use App\Http\Resources\ManageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageController extends Controller
{
    /**
     * 管理者一覧
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $manages = $query = Manage::all();
        return ManageResource::collection($manages);
    }

    /**
     * 管理者の登録
     *
     * @param StoreRequest $request
     * @return SuccessResource
     */
    public function store(StoreRequest $request)
    {
        $manage = new Manage();
        $manage->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->save();
        return new SuccessResource(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ManageResource
     */
    public function show(int $id)
    {
        $manage = Manage::query()->find($id);
        return new ManageResource($manage);
    }

    /**
     * 管理者の更新
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return SuccessResource
     */
    public function update(UpdateRequest $request, int $id)
    {
        $manage = Manage::query()->find($id);
        $manage->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->save();
        return new SuccessResource(null);
    }

    /**
     * 管理者の削除
     *
     * @param  int  $id
     * @return SuccessResource
     */
    public function destroy(int $id)
    {
        Manage::query()->find($id)->delete();
        return new SuccessResource(null);
    }
}
