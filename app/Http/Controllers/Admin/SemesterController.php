<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SemesterDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SemesterCreate;
use App\Http\Requests\SemesterEdit;
use App\Models\Semester;
use App\Models\Setting;
use App\Traits\SemesterTrait;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    use SemesterTrait;
    /**
     * Display a listing of the resource.
     *
     * @param SemesterDatatable $page
     * @return void
     */
    public function semesters(SemesterDatatable $page)
    {
        return $page->render('admin.semesters.index');
    }

    public function semesterCreate()
    {
        return view('admin.semesters.create' );
    }

    public function semesterStore(SemesterCreate $request)
    {
        $this->createNewSemester($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.semesters'));
    }


    public function semesterEdit($id)
    {
        $model = Semester::findOrFail($id);
        return view('admin.semesters.edit', compact('model'));
    }
    public function semesterUpdate(SemesterEdit $request, $id)
    {
        $request['semester_id']=$id;
        $this->editSemester($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.semesters'));
    }



    public function semesterDisabled($id)
    {
        $page = Semester::find($id);

        // check data deleted or not
        if ($page != null) {
            $page->status = 0;
            $page->save();

            $success = true;
            $message = trans('admin.disabled_success');
        } else {
            $success = true;
            $message = trans('admin.disabled_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function semesterActivated($id)
    {
        $page = Semester::find($id);

        // check data deleted or not
        if ($page != null) {
            $page->status = 1;
            $page->save();

            $success = true;
            $message = trans('admin.activated_success');
        } else {
            $success = true;
            $message = trans('admin.activated_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }


    public function semesterDelete($id)
    {
        $delete = Semester::where('id', $id)->delete();
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = trans('company.delete_success');
        } else {
            $success = true;
            $message = trans('company.delete_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
