<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subject;
use App\Http\Requests\Dashboard\Subject\SubjectStoreRequest;
use App\Http\Requests\Dashboard\Subject\SubjectUpdateRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectResource;


class SubjectController extends Controller
{
    public function index()
    {
        $allSubjects = Subject::all();
        return response()->json([
            'message' => 'Ok',
            'status' => Response::HTTP_OK,
            'data' => SubjectResource::collection($allSubjects)
        ]);
    }

    public function store(SubjectStoreRequest $request)
    {
        $subject =  Subject::create($request->all());
        return response()->json([
            'message' => 'Created Successfully',
            'status' => Response::HTTP_CREATED,
            'data' => new SubjectResource($subject)
        ]);
    }

    public function show($id)
    {
        $subject = Subject::whereId($id)->first();
        if ($subject) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => new SubjectResource($subject)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function update(SubjectUpdateRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        return response()->json([
            'message' => 'Update',
            'status' => Response::HTTP_NO_CONTENT
        ]);
    }

    public function destory($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return response()->json([
            'message' => 'Delete',
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }
}
