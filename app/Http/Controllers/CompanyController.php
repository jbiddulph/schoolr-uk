<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    //
    public function index($id, Company $company){
        return view('company.index', compact('company'));
    }

    public function create() {
        return view('company.create');
    }

    public function store() {
//        $this->validate($request,[
//            'address'=>'required',
//            'phone_number'=>'required|min:10|numeric',
//        ]);

        $user_id = auth()->user()->id;
        Company::where('user_id', $user_id)->update([
            'address'=>request('address'),
            'telephone'=>request('telephone'),
            'website'=>request('website'),
            'slogan'=>request('slogan'),
            'description'=>request('description')
        ]);

        return redirect()->back()->with('message','Company Successfully Updated!');
    }

    public function coverPhoto(Request $request) {
        $user_id = auth()->user()->id;
        if($request->hasFile('cover_photo')){
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/coverphoto/', $filename);
            Company::where('user_id',$user_id)->update([
                'cover_photo'=>$filename
            ]);
        }
        return redirect()->back()->with('message','Cover Photo Successfully Updated!');
    }

    public function companyLogo(Request $request) {
        $user_id = auth()->user()->id;
        Log::info('FILE: '.$user_id);
        if($request->hasFile('company_logo')){
            $file = $request->file('company_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/logo/', $filename);
            Company::where('user_id',$user_id)->update([
                'logo'=>$filename
            ]);

        }
        return redirect()->back()->with('message','Logo Successfully Updated!');
    }
}
