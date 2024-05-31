<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachmentFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachmentFilesTrait;
    public function index(){

        // نحنا بجدول الsettings استخدمنا طريقة جديدة لنخزن البيانات وهي key, value. يعني بدال ما اعمل حقل باسم كل شي بدي استجلو فبحقلين وفرتا
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {// الflatMap بتسنحلي انو تجمعلي كل key مع value تبعا ضمن array واحد بدال ما كان كل ريكورد عبارة عن array لحالو
            return [$collection->key => $collection->value];
        });
        return view('pages.settings.index', $setting);
    }

    public function update(Request $request){

        try{
            $info = $request->except('_token', '_method', 'logo');// يعني عم قلو شايف الريكويست يلي جاي شلي منو هدول الشغلات مابدي ياهن
            foreach ($info as $key => $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

//            $key = array_keys($info);
//            $value = array_values($info);          // هاي طريقة كمان بس بال for
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }

            if($request->hasFile('logo')) {
                $existingLogo = Setting::where('key', 'logo')->value('value');
                if (!empty($existingLogo)) {
                    $this->deleteFile($existingLogo, 'logo');
                }
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $this->uploadFile($request,'logo','logo');
//                $request->file('logo')->storeAs('attachments/logo/',$logo_name,'upload-attachments');

            }

            toastr()->info(trans('messages.Update'));
            return back();
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
