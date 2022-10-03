<?php

namespace App\Http\Controllers\Levels;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Models\ClassRoom;
use Flasher\Toastr\Prime\ToastrFactory;

class LevelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $levels = Level::all();
    return view('pages.levels.levels', compact('levels'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(LevelRequest $request, ToastrFactory $toastr)
  {
    // if (Level::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {
    //   return redirect()->back()->withErrors(trans('levels_trans.level_name_exists'));
    // }

    try {
      $validated = $request->validated();
      $level = new Level();
      $level->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
      $level->notes = $request->notes;
      $level->save();
      $toastr->addSuccess(trans('messages.success'));
      return redirect()->route('levels.index');
    } catch (\Exception $e) {
      $toastr->addError(trans('messages.save_fail'));
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(LevelRequest $request, ToastrFactory $toastr)
  {
    try {
      $validated = $request->validated();
      $level = Level::findOrFail($request->id);
      $level->update([
        $level->name = ['en' => $request->name_en, 'ar' => $request->name_ar],
        $level->notes = $request->notes
      ]);
      $toastr->addSuccess(trans('messages.update'));
      return redirect()->route('levels.index');
    } catch (\Exception $e) {
      $toastr->addError(trans('messages.update_fail'));
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, ToastrFactory $toastr)
  {
    $classes = ClassRoom::where('level_id', $request->id)->pluck('level_id');
    if ($classes->count() == 0) {
      $level = Level::findOrFail($request->id)->delete();
      $toastr->addSuccess(trans('messages.delete'));
      return redirect()->route('levels.index');
    } else {
      $toastr->addError(trans('levels_trans.delete_fail'));
      return redirect()->route('levels.index');
    }
  }
}
