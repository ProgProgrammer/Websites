<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function submit(ContactRequest $req)
    {
        $contact = new Contact();
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();

        return redirect()->route('home')->with('success', 'Сообщение было доставлено.');
    }

    public function updateMessageSubmit($id, ContactRequest $req)
    {
        $contact = Contact::find($id);
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();

        return redirect()->route('contact-data-one', $id)->with('success', 'Сообщение было обновлено.');
    }

    public function allData()
    {
        $contact = new Contact;
        // ['data' => $contact -> orderBy('id', 'desc') -> skip(1) -> take(2) -> get()] - orderBy(сортировка по id по убыванию); skip - пропуск определенного количества строк в БД; take - ограничение на вывод определенного количества строк из БД;
        // get - получить информацию из БД
        //return view('messages', ['data' => $contact -> where('subject', '<>', 'Greetings') -> get()]);  // where - необходима для выборки данных из таблицы; '<>' - это != (выбирает все строки, в которых столбец subject не равен 'Greetings')
        return view('messages', ['data' => $contact -> orderBy('id', 'desc') -> get()]);
    }

    public function showOneMessage($id)
    {
        $contact = new Contact;
        return view('one-message', ['data' => $contact -> find($id)]);
    }

    public function updateMessage($id)
    {
        $contact = new Contact;
        return view('update-message', ['data' => $contact -> find($id)]);
    }

    public function deleteMessage($id)
    {
        Contact::find($id) -> delete();
        return redirect()->route('contact-data')->with('success', 'Сообщение было удалено.');
    }
}
