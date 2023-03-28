<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Attachment;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Requests\Dashboard\Attachment\AttachmentStoreRequest;
use App\Http\Requests\Dashboard\Attachment\AttachmentUpdateRequest;

class AttachmentController extends Controller
{
    public function index()
    {
        $allattachments = Attachment::all();
        return response()->json([
            'message' => 'Ok',
            'status' => Response::HTTP_OK,
            'data' => AttachmentResource::collection($allattachments)
        ]);
    }

    public function store(AttachmentStoreRequest $request)
    {
        $attachment =  Attachment::create($request->all());
        return response()->json([
            'message' => 'Created Successfully',
            'status' => Response::HTTP_CREATED,
            'data' => new AttachmentResource($attachment)
        ]);
    }

    public function show($id)
    {
        $attachment = Attachment::whereId($id)->first();
        if ($attachment) {
            return response()->json([
                'message' => 'ok',
                'status' => Response::HTTP_OK,
                'data' => new AttachmentResource($attachment)
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    }

    public function update(AttachmentUpdateRequest $request, $id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->update($request->all());
        return response()->json([
            'message' => 'Update',
            'status' => Response::HTTP_NO_CONTENT
        ]);
    }

    public function destory($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();
        return response()->json([
            'message' => 'Delete',
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }
}
