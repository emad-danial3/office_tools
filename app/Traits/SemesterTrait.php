<?php

namespace App\Traits;

use App\Models\Semester;
use Illuminate\Support\Facades\DB;

trait SemesterTrait
{
    public function createNewSemester($request)
    {
        DB::beginTransaction();
        $page = new Semester();
        $page->name = $request['name'] ??null;
        $page->from_date = $request['from_date'] ??null;
        $page->to_date = $request['to_date'] ??null;
        $page->status = $request['status'] ??null;
        $page->save();
        DB::commit();
        $page = Semester::find($page->id);
        return $page;
    }

    public function editSemester($request)
    {
        DB::beginTransaction();
        $page = Semester::findOrFail($request['semester_id']);
        $page->name = $request['name'] ??null;
        $page->from_date = $request['from_date'] ??null;
        $page->to_date = $request['to_date'] ??null;
        $page->status = $request['status'] ??null;
        $page->save();
        DB::commit();
        $page = Semester::find($page->id);
        return $page;
    }
}
