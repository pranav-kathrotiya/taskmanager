<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderByDesc('created_at')->get();
        return response()->json(['status' => 1, 'data' => $tasks]);
    }

    public function store(Request $request)
    {
        try {
            if ($request->title == "") {
                return response()->json(['status' => 0, 'message' => 'Title is required!']);
            }
            if ($request->description == "") {
                return response()->json(['status' => 0, 'message' => 'Description is required!']);
            }
            if ($request->due_date == "") {
                return response()->json(['status' => 0, 'message' => 'Due date is required!']);
            }

            $data = new Task();
            $data->title = $request->title;
            $data->description = $request->description;
            $data->due_date = $request->due_date;
            $data->save();
            return response()->json(['status' => 1, 'message' => 'Task Added Successfully', 'data' => $data]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function edit(Request $request)
    {
        $tasks = Task::where('id', $request->id)->first();
        return response()->json(['status' => 1, 'data' => $tasks]);
    }

    public function update(Request $request)
    {
        try {
            if ($request->title == "") {
                return response()->json(['status' => 0, 'message' => 'Title is required!']);
            }
            if ($request->description == "") {
                return response()->json(['status' => 0, 'message' => 'Description is required!']);
            }
            if ($request->due_date == "") {
                return response()->json(['status' => 0, 'message' => 'Due date is required!']);
            }

            $data = Task::where('id', $request->id)->first();
            if (!empty($data)) {
                $data->title = $request->title;
                $data->description = $request->description;
                $data->due_date = $request->due_date;
                $data->save();
                return response()->json(['status' => 1, 'message' => 'Task Updated Successfully', 'data' => $data]);
            }
            return response()->json(['status' => 0, 'message' => 'Task Is Not Found !']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function status(Request $request)
    {
        try {
            $data = Task::where('id', $request->id)->first();
            if (!empty($data)) {
                if ($data->status == 1) {
                    $data->status = 2;
                    $data->save();
                    return response()->json(['status' => 1, 'message' => 'Task Completed Successfully']);
                } else {
                    $data->status = 1;
                    $data->save();
                    return response()->json(['status' => 0, 'message' => 'Task is pending']);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Task Is Not Found !']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Task::where('id', $request->id)->first();
            if (!empty($data)) {
                $data->delete();
                return response()->json(['status' => 1, 'message' => 'Task Deleted Successfully']);
            }
            return response()->json(['status' => 0, 'message' => 'Task Is Not Found !']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
