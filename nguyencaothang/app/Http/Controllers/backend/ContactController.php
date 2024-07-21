<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $list = Contact::where('status', '!=', 0)
            ->select('contact.id', 'contact.user_id', 'contact.name', 'contact.email','contact.phone','contact.title','contact.content','contact.replay_id')
            ->orderBy('contact.created_at', 'desc')
            ->get();

        // Lấy ID và tên User
        $users = User::select('user.id', 'user.name')->get();
        return view("backend.contact.index", compact("list", "users"));   
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $contact = new Contact();
        $contact->user_id = $request->user_id;
        $contact->name = $request->name;
        $contact->email = $request ->email;
        $contact->phone = $request->phone;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->status = $request->status;
        $contact->updated_at = now(); // Sử dụng hàm now() để lấy thời gian hiện user
        $contact->save();

        return redirect()->route('admin.contact.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        $users  = User::where('status', '!=', 0)
            ->select('user.id', 'user.name' )
            ->get();
        if($contact == null)
        {
            session()->flash('error', 'Dữ liệu id của danh mục không tồn tại!');
            return view("backend.contact.index");
        }
        $list = Contact::where('contact.status', '!=', 0)
            ->select('contact.id', 'contact.name', 'contact.email', 'contact.phone', 'contact.content', 'contact.replay_id')
            ->orderBy('contact.created_at', 'desc')
            ->get();
            $htmlusers = "";
            foreach ($users as $item) {
                if($contact->user_id == $item->id){
                    $htmlusers .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
                }
                else{
                    $htmlusers .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
                }
            }
   
        return view("backend.contact.edit", compact("contact", "htmlusers"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::find($id);
        if($contact==null){
            //chuyen trang va bao loi
        }
        $contact->user_id = $request->user_id;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->replay_id = $request->replay_id;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1;
        $contact->status = $request->status;
       
        $contact->save();
    
        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
