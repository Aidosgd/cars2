<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\City;
use App\Models\Offer;
use App\Models\OfferComment;
use App\Models\OfferViews;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Cookie;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index');
    }

    public function post(Requests\FeedbackPostRequest $request, Mailer $mailer)
    {
        $input = $request->all();

        $mailer->send('emails.feedback', [
            'input' => $input
        ],function (Message $message) use ($input){
            $message->from($input['email']);
            $message->to('aidosgd@gmail.com');
            $message->subject("Обратная связь");
        });
        $request->session()->flash('message', "Сообщение отправленно");

        return redirect('feedback');
    }
}
