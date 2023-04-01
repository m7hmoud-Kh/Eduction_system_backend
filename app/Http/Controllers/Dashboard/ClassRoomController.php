<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ClassRoom;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassRoomResource;
use App\Http\Requests\Dashboard\ClassRoom\ClassRoomStoreRequest;
use App\Http\Requests\Dashboard\ClassRoom\ClassRoomUpdateRequest;

class ClassRoomController extends Controller
{
    public function index()
    {
        $allClassRooms = ClassRoom::all();
        return response()->json([
            'message' => 'Ok',
            'status' => Response::HTTP_OK,
            'data' => ClassRoomResource::collection($allClassRooms)
        ]);
    }

    public function getClassroomsByBranchId($branchId)
    {
        $classRooms = ClassRoom::with('branch')->where('branch_id', $branchId)->get();

        if ($classRooms) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => ClassRoomResource::collection($classRooms)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }
    public function getClassroomsByTeacherId($teacherId)
    {
        $classRooms = ClassRoom::with('teacher')->where('teacher_id', $teacherId)->get();

        if ($classRooms) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => ClassRoomResource::collection($classRooms)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function getClassroomsBySubjectId($subjectId)
    {
        $classRooms = ClassRoom::with('subject')->where('subject_id', $subjectId)->get();

        if ($classRooms) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' =>  ClassRoomResource::collection($classRooms)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function store(ClassRoomStoreRequest $request)
    {
        $classRoom =  ClassRoom::create($request->all());
        return response()->json([
            'message' => 'Created Successfully',
            'status' => Response::HTTP_CREATED,
            'data' => new ClassRoomResource($classRoom)
        ]);
    }

    public function show($id)
    {
        $classRoom = ClassRoom::whereId($id)->first();
        if ($classRoom) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => new ClassRoomResource($classRoom)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function update(ClassRoomUpdateRequest $request, $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->update($request->all());
        return response()->json([
            'message' => 'Update',
            'status' => Response::HTTP_NO_CONTENT
        ]);
    }

    public function destory($id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->delete();
        return response()->json([
            'message' => 'Delete',
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }
}
