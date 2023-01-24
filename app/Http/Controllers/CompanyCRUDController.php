<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyCRUDController extends Controller
{ 
    // สร้างindex
    public function index(){
        $data['companies'] = Company::orderBy('id','desc')->paginate(5);
        return view('companies.index',$data);
    }

    //หน้าcreate ข้อมูล
    public function create (){
        return view('companies.create');
    }

    //เก็บข้อมูล post data
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company created');
    }

    // หน้า edit 
    public function edit(Company $company){
        return view('companies.edit',compact('company'));
    }

    //การ update
    public function update(Request $request,$id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company updated');
    }

    //การdelete
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted');
    }
}
