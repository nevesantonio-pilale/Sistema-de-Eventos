<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\user;

class EventController extends Controller {
    
    public function index () {
        
        $search = request('search');

        if ($search) {

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']

            ])-> get();
                

        }else{

            $events = Event::all();

        }


    return view('welcome', ['events'=> $events, 'search'=> $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        
        $event = new Event;

        $event-> title = $request-> title;
        $event-> date = $request-> date;
        $event-> city = $request-> city;
        $event-> private = $request-> private;
        $event-> description = $request-> description;
        $event->items = $request-> items;

        /* carregamento de imagens no banco */
        if($request->hasfile('image') && $request->file('image')->isvalid()) {

            $requestImage = $request-> image;
            $extension = $requestImage-> extension();

            $imageName = md5($request->image->getClientOriginalName().strtotime('now')).".".$extension;

            $requestImage->move(public_path('/img/events'), $imageName);
            $event->image = $imageName;

        }

        $user = auth() -> user();
        $event-> user_id = $user->id;

        $event-> save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $eventOwner = user::where('id', $event->user_id)-> first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);

    }


    public function dashboard() {

        $user = auth() -> user();
        $events = $user->events;

        $eventsAsParticipant = $user-> eventsAsParticipant;

        return view('events.dashboard',
            ['events'=>$events, 'eventsAsparticipant'=> $eventsAsParticipant]);

    }


    public function destroy($id) {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento Excluído com sucesso!');

    }


    public function edit($id) {

        $event = Event::findOrfail($id);

        return view('events.edit', ['event' => $event]);

    }


    public function update(Request $request) {

        $data = $request->all();

        /* carregamento de imagens no banco */
        if($request->hasfile('image') && $request->file('image')->isvalid()) {

            $requestImage = $request-> image;
            $extension = $requestImage-> extension();

            $imageName = md5($request->image->getClientOriginalName().strtotime('now')).".".$extension;

            $requestImage->move(public_path('/img/events'), $imageName);
            $data['image'] = $imageName;

        }

        Event::findOrFail($request-> id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso!');

    }


    public function joinEvent($id) {

        $user = auth() -> user();

        $user-> eventsAsParticipant()-> attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'A sua precensa esta confirmada no evento de'.$event-> title);

    }
}
