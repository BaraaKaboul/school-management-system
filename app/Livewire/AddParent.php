<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    //مشان نغضر نضيف ملفات او صور لازم نحط هاي ونعملو امبورت فوق اجباري
    use WithFileUploads;
    //عملناها فاضية successMessage لانو اول ماتفوت رح تكون فاضية طبعا
    //وبصفحة add-parents حطينا شرط ازا كانت مو فاضية اعرضلي قيمتا وحطينا مضمون قيمتا تحت
    //عطينا $show_table = true يعني اول ما افوت عالصفحة بتعرضلي التيبل تبع الاولياء وبتخفيلي فورم اضافة الاولياء
    public $successMessage = '', $catchError, $updateMode = false, $photos, $show_table = true;
    public $currentStep = 1,

    // Father_INPUTS
$Email, $Password,
$Name_Father, $Name_Father_en,
$National_ID_Father, $Passport_ID_Father,
$Phone_Father, $Job_Father, $Job_Father_en,
$Nationality_Father_id, $Blood_Type_Father_id,
$Address_Father, $Religion_Father_id,

    // Mother_INPUTS
$Name_Mother, $Name_Mother_en,
$National_ID_Mother, $Passport_ID_Mother,
$Phone_Mother, $Job_Mother, $Job_Mother_en,
$Nationality_Mother_id, $Blood_Type_Mother_id,
$Address_Mother, $Religion_Mother_id,

$Parent_id;


    //لعمل realtime validation لـ inputs محددة
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent',[

            'Nationalities'=>Nationality::all(),
            'Type_Bloods'=>BloodType::all(),
            'Religions'=>Religion::all(),
            'my_parents'=>MyParent::all(),
        ]);
    }

    //لعمل required لجميع الحقول تبع الأب قبل الانتقال ل form الام
    public function firstStepSubmit()
    {

        $this->validate([
            'Email' => 'required|unique:my_parents,Email,',//$this->id
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,nationality_Father_id,',//$this->id
            'Passport_ID_Father' => 'required|unique:my_parents,Passport_ID_Father,',//$this->id
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit(){

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,nationality_Mother_id,', //. $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,Passport_ID_Mother,', //. $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            //ال this بتمثل request بس بالlivewire
            //طبعا الها علاقة بتقنية oop
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->blood_type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->blood_type_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;
            $My_Parent->save();

            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }
            $this->successMessage = trans('parents_trans.success');
//            لازم نستدعي هون ميثود اسمو clearForm مشان ينشاف
            $this->clearForm();
            $this->currentStep = 1;
//يعني بعد ما اتخزنلي المعلومات رفرشلي الform كلن ورجعني لعند اول form تبع الاب وفاضي
        }

        catch (\Exception $e) {
            //الcatchError مجرد فاريابل عرفناه فوق بالبابليك
            $this->catchError = $e->getMessage();
        };

    }

//هاي الid جبناها من التيبل من زر التعديل
    public function edit($id)
    {
        //يس تكبس على تعديل اخفيلي التيبل, واعرضلي الفورم
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = MyParent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->blood_type_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->nationality_Father_id;
        $this->Blood_Type_Mother_id = $My_Parent->blood_type_Father_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->religion_Father_id;
    }


    public function firstStepSubmit_edit(){

        $this->updateMode = true;
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }


    public function submitForm_edit(){

        //الParent_id جبناها من فانكشن edit لانو طبعا نحنا منشتغل oop
        if ($this->Parent_id){
            $parent = MyParent::find($this->Parent_id);
            $parent->update([
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'National_ID_Father' => $this->National_ID_Father,
            ]);

        }

        return redirect()->to('/add-parents');
    }

    public function delete($id){

        $parent_id = ParentAttachment::where('parent_id','=',$id)->pluck('parent_id');
        if ($parent_id->count() == 0){

        MyParent::findOrFail($id)->delete();
        return redirect()->to('/add-parents');
        }
        else{
            toastr()->warning((trans('parents_trans.warning_att')));
            return redirect()->back();
        }
    }



    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }



    public function showformadd(){

        $this->show_table = false;
    }

    public function showTable(){

        $this->show_table = true;
    }


    //رح يرجع المتغير step بالقيمة لعاطي ياها بform الام و confirm
    public function back($step){

        $this->currentStep = $step;
    }
}
