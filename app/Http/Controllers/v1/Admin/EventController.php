<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    //

    public function index() {
        return response()->json(Event::all());
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            DB::commit();

            Event::create([
                'name' => $request->name,
                'content' => $request->content,
                'category_id' => $request->category_id
            ]);

            return response()->json(['message' => 'New event successfully added.']);

        }catch(\Throwable $th) {
            return response()->json($th);
        }
    }

    public function update(Request $request, $id) {
        $event = Event::find($id);
        $event->name = $request->name;
        $event->content = $request->content;
        $event->category_id = $request->category_id;
        $event->save();
        return response()->json(['message' => 'Event successfully deleted.']);
    }

    public function destroy($id) {
        Event::destroy($id);
        return response()->json(['message' => 'Event successfully deleted.']);

    }
}
