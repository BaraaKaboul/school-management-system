<?php

namespace App\Http\Traits;

use App\Models\OnlineClass;
use Illuminate\Support\Facades\DB;
use MacsiDigital\Zoom\Facades\Zoom;

trait ZoomMeetingTrait
{
    public function createMeeting($request)// هاد الكود مو شغال ومو مفعل لأنو مازبط ال zoom integration, بس عملتو انو يخزنلي يدوي يعني يعمل مييت على حسابو على زوومويحط البيانات على الداتابيز, مشان يقدر كذا استاذ يعمب مييت خاص بكل واحد او بدو حساب زوم بريميوم
    {
            $meeting = Zoom::meeting()->make([
                'topic' => $request->topic,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_time' => $request->start_time,
                'timezone' => config('zoom.timezone')// بهاي الحالة رح ياخد الtimezone يلي موجود في حساب zoom
                // 'timezone' => 'Africa/Cairo' // او هون اذا بدي احطو بشكل يدوي ياخد timezone اي بلد بدي ياه بغض النظر عن الي موجود بحساب zoom
            ]);

            // هون عبارة عن الاعدادات مثلا ماحدا بيفوت قبل الي عمل المييتينغ ويساويلي غرفة للانتظار قبل المييت واي حدا بيفوت بعد مايبلش المييت بيكون ميوت وهكذا
            $meeting->settings()->make([
                'join_before_host' => false,
                'host_video' => false,
                'participant_video' => false,
                'mute_upon_entry' => true,
                'waiting_room' => true,
                'approval_type' => config('zoom.approval_type'),// هدول الاعدادات التلاتة كمان طبقلي ياهن حسب مو محطوط باعدادات الحساب
                'audio' => config('zoom.audio'),
                'auto_recording' => config('zoom.auto_recording')
            ]);
//            $user->meetings()->save($meeting); // لحد هلأ كلو تخزين بالحساب zoom
        return $meeting->save();
    }
}
