<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\NoticeBoard;
use App\Queries\NoticeBoardDataTable;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeBoardController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new NoticeBoardDataTable())->get())->make(true);
        }

        return view('employees.notice_boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $noticeBoard = NoticeBoard::findOrFail($id);

        return view('employees.notice_boards.show')->with('noticeBoard', $noticeBoard);
    }
}
