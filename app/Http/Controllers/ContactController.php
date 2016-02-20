<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Pagination with 15 items
        $contacts = Contact::paginate(15);
        return view('contact.list')->with(['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validade($request->all());

        if ($validator->fails()) {
            return redirect('contact/create')->withErrors($validator)->withInput($request->all());
        }

        if ($this->createContact($request->all())) {
            return redirect('contact/create')->with(['success'=> 'Contato cadastrado com sucesso.']);
        } else {
            return redirect('contact/create')->withErrors('Houve um erro ao cadastrar o contato.');
        }
    }

    /**
     *
     * Validade all the values inside the request
     *
     * @param Array
     * @return Boolean
     *
     */

    private function validade(array $data) {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|unique:contacts'
        ]);
    }

    /**
     *
     * Validade all the values inside the request just for the update
     *
     * @param array $data
     * @param int $int
     * @return Boolean
     *
     */

    private function validadeUpdate(array $data, $id) {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|unique:contacts,email,'. $id
        ]);
    }

    /**
     *
     * Create new Contact
     *
     * @param array $data
     * @return Contact
     *
     */

    private function createContact(array $data) {

        return Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cpf' => $data['cpf'],
            'message' => $data['message']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return redirect('contact.index')->withErrors('Contato não encontrado.');
        }
        return view('contact.show')->with(['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return redirect('contact')->withErrors('Contato não encontrado.');
        }
        return view('contact.edit')->with(['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $contact = Contact::find($id);
        if (is_null($contact)) {
            return redirect('contact')->withErrors('Contato não encontrado.');
        }

        $validator = $this->validadeUpdate($request->all(), $id);
        if ($validator->fails()) {
            return redirect('contact/' . $id . '/edit')->withErrors($validator);
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->cpf = $request->cpf;
        $contact->message = $request->message;

        if ($contact->save()) {
            return redirect('contact')->with(['success' => 'Contato atualizado com sucesso.']);
        } else {
            return redirect('contact.edit')->withErrors('Erro ao atualizar o Contato.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contact = Contact::find($id);
        if (is_null($contact)) {
            return redirect('contact')->withErrors('Contato não encontrado.');
        }

        if (Contact::destroy($id)) {
            return redirect('contact')->with(['success' => 'Contato deletado com sucesso.']);
        } else {
            return redirect('contact')->withErrors('Erro ao deletar o contato');
        }
    }

    /**
     * Check if there is contact with the same email
     * Return false if find any
     *
     * @param $email
     * @return Boolean
     */

    public function validadeEmail($email) {
         $result = Validator::make(['email' => $email], [
            'email'=> 'unique:contacts'
         ])->passes();

        return response(['success' => $result]);
    }

    /**
     * Check if there is contact diferent from id with the same email
     * Return false if find any
     *
     * @param string $email
     * @param int $id
     * @return Boolean
     */

    public function validadeEmailUpdate($email, $id) {
        $result = Validator::make(['email' => $email], [
            'email' => 'required|unique:contacts,email,'. $id
        ])->passes();

        return response(['success' => $result]);
    }


}
