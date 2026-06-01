<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ContactRequest;
use App\DataTables\ContactDataTable;

class ContactController extends Controller
{

    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('dashboard.contacts.index');
    }


    public function create()
    {
        return view('dashboard.contacts.create');
    }


    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->getSanitized());
        session()->flash('message', 'Contact Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.contacts.edit', $contact);
    }


    public function show(Contact $contact)
    {
        //
    }


    public function edit(Contact $contact)
    {
        return view('dashboard.contacts.edit', compact('contact'));
    }


    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->getSanitized());
        session()->flash('message', 'Contact Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([
            'message' => 'Contact Deleted Successfully!'
        ]);
    }
}
