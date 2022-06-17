<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ServiceResource;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\ServiceStoreRequest;

class ProviderController extends BaseController
{

    public function index()
    {
        $providers = Service::with(['user:id,name,email', 'category:id,title'])->filter(request('category'))->get();

        $data['providers'] = ServiceResource::collection($providers);

        $message = 'مقدمي الخدمات';

        return $this->success($message, $data);
    }

    public function register(UserStoreRequest $userStoreRequest, ServiceStoreRequest $serviceStoreRequest)
    {
        $user = User::create($userStoreRequest->validated());

        $service = $serviceStoreRequest->validated();
        $service['user_id'] = $user->id;
        $service['image'] = request()->file('image')->store('providers', 'public');

        Service::create($service);

        $message = 'تم ارسال طلبك بنجاح، ستتم مراجعة بياناتك ومن ثم يمكنك تسجيل الدخول';

        return $this->success($message);
    }

    public function profile()
    {
        $data['profile'] = Service::with(['user','category'])->where('user_id', auth()->id())->first();
        $message = 'بيانات مزود الخدمة';

        return $this->success($message, $data);
    }

    public function updateProfile(UserUpdateRequest $userUpdateRequest, ServiceUpdateRequest $serviceUpdateRequest)
    {
        $user = auth()->user();

        $user->update($userUpdateRequest->validated());

        $service = $serviceUpdateRequest->validated();

        if($service['image'] ?? false){
            if(Storage::disk('public')->exists($user->service->image)){
                Storage::disk('public')->delete($user->service->image);
            }

            $service['image'] = request()->file('image')->store('providers', 'public');
        }

        $user->service()->update($service);

        $data['provider'] = new ServiceResource(Service::with(['user:id,name,email', 'category:id,title'])->find($user->service->id));

        $message = 'تم تعديل بيانات حسابك بنجاح';

        return $this->success($message, $data);
    }

}
