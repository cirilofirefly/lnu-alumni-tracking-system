<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{

    //

    public function index() {
        return response()->json(Event::with('category')->get());
    }

    public function show($slug) {
        return response()->json(Event::with('category')->where('slug', $slug)->first());
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        DB::beginTransaction();

        try {

            Event::create([
                'name' => $request->name,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'slug' => Str::slug($request->name . '-' . Carbon::now())
            ]);

            DB::commit();
            return response()->json(['message' => 'New event successfully added.']);

        }catch(\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th], 500);
        }
    }

    public function update(Request $request, $id) {

        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

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
