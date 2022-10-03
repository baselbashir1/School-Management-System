<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\Level;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomRequest;
use Exception;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\RedirectResponse;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassRoom::all();
        $levels = Level::all();
        return view('pages.classes.classes', compact('classes', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRoomRequest $request, ToastrFactory $toastr)
    {
        $listClasses = $request->listClasses;
        try {
            // $listClasses = $request->listClasses;
            $validated = $request->validated();
            foreach ($listClasses as $listClass) {
                $classes = new ClassRoom();
                $classes->name = ['en' => $listClass['class_name_en'], 'ar' => $listClass['class_name_ar']];
                $classes->level_id = $listClass['level_id'];
                $classes->save();
            }
            $toastr->addSuccess(trans('messages.success'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $toastr->addError(trans('messages.save_fail'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToastrFactory $toastr)
    {
        try {
            $classes = ClassRoom::findOrFail($request->id);
            $classes->update([
                $classes->name = ['ar' => $request->name_ar, 'en' => $request->name_en],
                $classes->level_id  = $request->level_id,
            ]);
            $toastr->addSuccess(trans('messages.update'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            $toastr->addError(trans('messages.update_fail'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ToastrFactory $toastr)
    {
        $classes = ClassRoom::findOrFail($request->id)->delete();
        $toastr->addSuccess(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_all_checked(Request $request, ToastrFactory $toastr)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
        $classes = ClassRoom::whereIn('id', $delete_all_id)->delete();
        $toastr->addSuccess(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }
}
